<?php
namespace Corp\Repositories;

use Corp\Article;
use Auth;
use Gate;
use Image;
use Config;

class ArticlesRepository extends Repository{

	public function __construct(Article $article){
		$this->model = $article;
	}

	public function one($alias, $attr=array()){
		$article = parent::one($alias, $attr);
		if($article&& !empty($attr)){
			$article->load('comments');
			$article->comments->load('user');
		}

		return $article;
	}

	public function addArticle($request){

		if(Auth::check()){
            if(Gate::denies('save', $this->model)){
                abort(403);
            }
        }

        $data = $request->except('_token', 'image');
        if(empty($data)){
        	return array('errors' => 'нет данных');
        }

        if(empty($data['alias'])){
        	$data['alias'] = $this->transliterate($data['title']);
        	// заміняємо пусте поле alias транслітерованними символами з title
        	//транслітирація - це коли ми заміняємо кірилічискі символи строки на латинські з учотом правил формування url тобто якщо поле title = Rooms for your або "Квартиры для вас"" то поле alias має = rooms-for-your або "kvartiry-dlya-vas"
        	//dd($data);
        }

        if($this->one($data['alias'], FALSE)){
        	$request->merge(array('alias' => $data['alias']));//обєднання массива який передається в 1 аргументі з інформацією яка зберігається в $request
        	$request->flash();//зберігаємо в сессію всі поля
        	return ['errors' => 'Данный псевдоним уже используеться'];
        }

        $str = str_random(8);
        $obj = new \stdClass;
        $obj->mini = $str.'_mini.jpg';
        $obj->max = $str.'_max.jpg';
        $obj->path = $str.'.jpg';

        if($this->uploadImage($request, $obj)){
            $data['img'] = json_encode($obj);
            //dd($data);
            $this->model->fill($data);
            if($request->user()->articles()->save($this->model)){
                return ['status' => 'Материал добавлен'];
            }
        }
        return ['errors' => 'Неудалось загрузить картинку'];  
	}

    //данний метод схожий з addArticle якщо шось неясно дивитись туди
    public function updateArticle($request, $article){
        
        if(Auth::check()){
            if(Gate::denies('save', $this->model)){
                abort(403);
            }
        }
        $data = $request->except('_token', 'image', '_method');
        //dd($data);
        if(empty($data)){
            return array('errors' => 'нет данных');
        }

        if(empty($data['alias'])){
            $data['alias'] = $this->transliterate($data['title']);
        }

        $result = $this->one($data['alias'], FALSE);

        if(isset($result->id) && ($result->id != $article->id)){
            $request->merge(array('alias' => $data['alias']));
            $request->flash();
            return ['errors' => 'Данный псевдоним уже используеться'];
        }

        $str = str_random(8);
        $obj = new \stdClass;
        $obj->mini = $str.'_mini.jpg';
        $obj->max = $str.'_max.jpg';
        $obj->path = $str.'.jpg';

        if($this->uploadImage($request, $obj)){

            $data['img'] = json_encode($obj);
            $article->fill($data);
            if($article->update()){
                return ['status' => 'Материал обновлен'];
            }
        }
        else{
            if(file_exists(public_path().'/'.env('THEME').'/images/articles/'.$data['old_image'])){
                $old = substr($data['old_image'], 0, -4);
                //dd($old);
                $obj->mini = $old.'_mini.jpg';
                $obj->max = $old.'_max.jpg';
                $obj->path = $old.'.jpg';
                $data['img'] = json_encode($obj);
                $article->fill($data);
                if($article->update()){
                    return ['status' => 'Материал обновлен'];
                }
            }
        }

        return ['errors' => 'Неудалось загрузить картинку'];
    }


    private function uploadImage($request, $obj, $oldImg = false){
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            //dd($image);
            if($image->isValid()){

                $img = Image::make($image);
                //dd($img);
                $this->fitImage($img, $obj);

                return true;
            }
        }
        return false;
    }

    private function fitImage($img, $obj){

        $img->fit(Config::get('settings.image')['widht'], Config::get('settings.image')['height'])->save(public_path().'/'.env('THEME').'/images/articles/'.$obj->path);

        $img->fit(Config::get('settings.articles_img')['max']['widht'],Config::get('settings.articles_img')['max']['height'])->save(public_path().'/'.env('THEME').'/images/articles/'.$obj->max);

        $img->fit(Config::get('settings.articles_img')['mini']['widht'], Config::get('settings.articles_img')['mini']['height'])->save(public_path().'/'.env('THEME').'/images/articles/'.$obj->mini);

    }


    public function deleteArticle($request){
        if(Auth::check()){
            if(Gate::denies('delete', $this->model)){
                abort(403);
            }
        }

        $data = $request->except('_token');
        $article = $this->model->where('alias', $data['article_alias'])->first();
        if($article){
            $article->comments()->delete();

            if($article->delete()){
                return true;
            }
            return false;
        }
        return false;
    }

}
?>