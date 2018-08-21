<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\SlidersRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\ArticlesRepository;
use Config;

class IndexController extends SiteController
{

    public function __construct(SlidersRepository $s_rep, PortfoliosRepository $p_rep, ArticlesRepository $a_rep){
      parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu)); //передаємо обьєкт створеного нами репозиторія і в самий репозиторій передаєм обьєкт моделі
      $this->bar = 'right';//це буде впливати на шаблон
      $this->template = env('THEME').'.index';

      $this->slider_rep = $s_rep;//оприділяємо slider_rep
      $this->portfolio_rep = $p_rep;
      $this->article_rep = $a_rep;
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//відображає весь контент главної сторніки
    {
        $portfolios = $this->getPortfolio();
        $sliderItems = $this->getSliders();
        $articles = $this->getArticles();
        //dd($articles);

        $this->contentRightBar = view(env('THEME').'.sidebar', ['articles' => $articles])->render();// оприділяємо свойство обьявленне в індекс контроллері
        $content = view(env('THEME').'.content', ['portfolios' => $portfolios])->render();
        $sliders = view(env('THEME').'.slider', ['sliderItems' => $sliderItems])->render();
        //dd($sliderItems);
        $this->vars = array_add($this->vars, 'sliders', $sliders);
        $this->vars = array_add($this->vars, 'content' , $content);
        $this->SetMetaTags();

        return $this->renderOutput();
    }

    private function SetMetaTags(){
        $this->keywords = 'Home Page';
        $this->meta_desc = 'Home Page';
        $this->title = 'Home Page';
    }

    protected function getPortfolio(){
        $portfolio = $this->portfolio_rep->get("*",Config::get('settings.home_port_count'));
        //dd($portfolio);
        return $portfolio;
    }


    public function getSliders(){
        $sliders = $this->slider_rep->get();//звертаючись до обєкта репозиторія вибираємо всі значення з таблички slider через метод get()
        if($sliders->isEmpty()){
            return FALSE;
        }

        $sliders->transform(function($item, $key){
            $item->img = Config::get('settings.slider_path').'/'.$item->img;// - меніяємо значення img дописуючи до нього імя папки яке зберігається в створеним нами файлі settings.php 
            return $item;//данна колбек функція має повертати значення
        });
        //dd($sliders);
        return $sliders;
    }


    public function getArticles(){
        $articles = $this->article_rep->get(['title', 'created_at', 'img' , 'alias', 'desc'], Config::get('settings.home_articles_count'));

        return $articles;
    }

}
