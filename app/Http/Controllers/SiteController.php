<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\MenusRepository;

class SiteController extends Controller
{
    protected $portfolio_rep;
    protected $slider_rep;
    protected $article_rep;
    protected $menu_rep;


    // 3 поля нижче відповідають за метатеги
    protected $keywords = false; 
    protected $meta_desc = false;
    protected $title = false;
    //ми їх переоприділяємо в дочірньому контроллері

    protected $template;
    protected $vars = array();

    protected $contentRightBar = false;
    protected $contentLeftBar = FALSE;
    protected $bar = 'no';// дефолтне значення, ми переоприділяємо його в IndexController

    public function __construct(MenusRepository $menu_rep){
    	$this->menu_rep = $menu_rep;
    } 

    //в данному методі оприділяються змінні які общі для усіх сторінок такі як footer navigation i тд
    protected function renderOutput(){
 
        $menu = $this->getMenu(); 
        $child_menu = $this->getChildMenu($menu);

        //dd($child_menu);     
        $navigation = view(env('THEME').'.navigation', ['child_menu' => $child_menu, 'menu' => $menu])->render();//записуємо в переменну назву виду до якого будемо звертатись в шаблоні
         $footer = view(env('THEME').'.footer')->render();


        if($this->contentRightBar){
            $rightBar = view(env('THEME').'.rightBar', ['content_rightBar' => $this->contentRightBar])->render();
            $this->vars = array_add($this->vars, 'sidebar', $rightBar);
        }// - виконуємо данну дію в надії на те що дочєрній контроллер має переоприділити $this->contentRightBar

        $this->vars = array_add($this->vars, 'bar', $this->bar);
        $this->vars = array_add($this->vars, 'navigation', $navigation);
        $this->vars = array_add($this->vars, 'footer' , $footer);
        $this->getMetaTags();

        return view($this->template)->with($this->vars);
    }

    public function getMenu(){
        $menu = $this->menu_rep->get();// метод get() - описаний в Repository і повертає всі значення з полів таблиці
        return $menu;
    }

    public function getChildMenu($menu){
        $child_menu = [];
        $i = 0;
        foreach($menu as $item){
            if($item->parent != 0){
                $child_menu[$i]['parent'] = $item->parent;
                $child_menu[$i]['title'] = $item->title;
                $child_menu[$i]['path'] = $item->path;
                ++$i;
            }
        }   
        return $child_menu;
    }

    private function getMetaTags(){
        $this->vars = array_add($this->vars, 'keywords', $this->keywords);
        $this->vars = array_add($this->vars, 'meta_desc', $this->meta_desc);
        $this->vars = array_add($this->vars, 'title', $this->title);
    }
}
