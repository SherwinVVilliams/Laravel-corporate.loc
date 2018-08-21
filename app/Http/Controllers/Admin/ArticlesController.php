<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Corp\Repositories\ArticlesRepository;
use Corp\Http\Requests\ArticleRequest;

use Gate;
use Auth;
use Corp\Category;
use Corp\Article;
use Response;

class ArticlesController extends AdminController
{
    public function __construct(ArticlesRepository $a_rep){
        parent::__construct();
        if(Auth::check()){
            if(Gate::denies('VIEW_ADMIN_ARTICLES')){
                abort(403);
            }
        }
        $this->article_rep = $a_rep;
        $this->template = env('THEME').'.admin.index';   
    }


    public function index()
    {
        $articles = $this->getArticles();

        $this->title = 'Article Manager';
        $this->content = view(env('THEME').'.admin.articles_content', ['articles' => $articles ])->render();

        return $this->renderOutput();
    }


    public function getArticles(){
        $articles = $this->article_rep->get();

        return $articles;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if(Auth::check()){
            if(Gate::denies('save', new \Corp\Article)){
                abort(403);
            }
        }

        $categories = Category::select(['title', 'alias', 'parent_id', 'id'])->get();

        $lists = $this->getChildCategory($categories);
        //dd($lists);

        $this->title = 'Article Create';

        $this->content = view(env('THEME').'.admin.articles_create_content', ['categories' => $categories, 'lists' =>$lists])->render();
        
        return $this->renderOutput();
    }


    private function getChildCategory($categories){

        $lists = array();

        foreach( $categories as $category){
            if($category->parent_id == 0){
                $lists[$category->title] = array();
            }
            else{
                $lists[$categories->where('id', $category->parent_id)->first()->title][$category->id] = $category->title;
            }
        }

        return $lists;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        //dd($request->all());
        $result = $this->article_rep->addArticle($request);
        //dd($result);

        return redirect()->route('adminIndex')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //dd($article);
        if(Gate::denies('edit', new Article)){
            abort(403);
        }

        $article->img = json_decode($article->img);
        
        $categories = Category::select(['title', 'alias', 'parent_id', 'id'])->get();

        $lists = $this->getChildCategory($categories);

        $this->title = "Article Edit - ".$article->title ;

        $this->content = view(env('THEME').'.admin.articles_create_content', ['categories' => $categories, 'lists' =>$lists, 'article' => $article])->render();
        
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $result = $this->article_rep->updateArticle($request, $article);
        
        return redirect()->route('adminIndex')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request){
        

        $result = $this->article_rep->deleteArticle($request);

        if($result){
            $articles =$this->getArticles();

            return Response::json(['articles' => $articles]);
        }

        exit();

    }
}
