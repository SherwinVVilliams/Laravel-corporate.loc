<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\CommentsRepository;

use Config;

use Corp\Category;

class ArticleController extends SiteController
{
    protected $comment_rep;

	public function __construct(PortfoliosRepository $p_rep,ArticlesRepository $a_rep, CommentsRepository $c_rep){

      parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu)); //передаємо обьєкт створеного нами репозиторія і в самий репозиторій передаєм обьєкт моделі
      $this->bar = 'right';//це буде впливати на шаблон
      $this->template = env('THEME').'.articles';
      
      $this->comment_rep = $c_rep;
      $this->portfolio_rep = $p_rep;
      $this->article_rep = $a_rep;
    } 


    public function index($alias = false){

    	$articles = $this->getArticles($alias);
        $comments = $this->getComments(Config::get('settings.articles_recent_comments'));
        $portfolios = $this->getPorfolios(Config::get('settings.articles_recent_portfolios'));
    	//dd($articles);

    	$content = view(env('THEME').'.articles_content', ['articles' => $articles])->render();
        $this->contentRightBar = view(env('THEME').'.articlesBar', ['comments' => $comments, 'portfolios' => $portfolios]);

    	$this->vars = array_add($this->vars, 'content', $content);

        $this->SetMetaTags();

        return $this->renderOutput();
    }


    public function show($alias){

        $article = $this->article_rep->one($alias,['comments' => true]);
        if($article){
            $article->img = json_decode($article->img);
        }
        
        //dd($article->comments->groupBy('parent_id'));
        //dd($article);
        $comments = $this->getComments(Config::get('settings.articles_recent_comments'));
        $portfolios = $this->getPorfolios(Config::get('settings.articles_recent_portfolios'));
        //dd($articles);

        $content = view(env('THEME').'.article_content', ['article' => $article ])->render();
        $this->contentRightBar = view(env('THEME').'.articlesBar', ['comments' => $comments, 'portfolios' => $portfolios]);


        $this->vars = array_add($this->vars, 'content', $content);

        $this->SetMetaTags();
        return $this->renderOutput();
    }


     public function getArticles($alias = false){

        $where = $this->getCategoryId($alias);

        $articles = $this->article_rep->get(['id','title', 'alias', 'created_at', 'img','desc', 'user_id' , 'category_id'],false, true, $where);
        if($articles){
            $articles->load('user', 'category', 'comments');//підгружаємо інформацію з інших моделей(жадна загрузка)
        }

        return $articles;
    }

    public function getComments($take){
        $comments = $this->comment_rep->get(['id','text', 'name', 'email', 'site',  'article_id', 'user_id'], $take);
        if($comments){
            $comments->load('user', 'article');//підгружаємо інформацію з інших моделей(жадна загрузка)
        }
        return $comments;
    }


    public function getPorfolios($take){
         $portfolios = $this->portfolio_rep->get("*", $take);
        return $portfolios;
    }

   

    public function getCategoryId($alias){

        if($alias){        
            $id = Category::select('id')->where('alias', $alias)->first()->id;
            
            //dd($id);
            if($id){
                $where = ['category_id', $id];

                return $where;
            }
        }

        return false;
    }


    private function SetMetaTags(){
        $this->keywords = 'Articles';
        $this->meta_desc = 'Articles';
        $this->title = 'Articles';
    }
}
