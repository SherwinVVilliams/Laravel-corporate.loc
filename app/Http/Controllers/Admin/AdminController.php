<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;

use Auth;

class AdminController extends Controller
{
    protected $portfolio_rep = false;
    protected $article_rep = false;
    protected $user = false;
    protected $template = false;
    protected $content = false;
    protected $title = false;
    protected $vars;
    protected $bar = 'no';

    public function __construct(){

    }

    public function renderOutput(){
    	$menu = $this->getMenu();

    	$navigation = view(env('THEME').'.admin.navigation', ['menu' => $menu])->render();
    	$footer = view(env('THEME').'.admin.footer')->render();
    	

    	
    	$this->vars = array_add($this->vars , 'content', $this->content);
    	$this->vars = array_add($this->vars, 'footer', $footer);
    	$this->vars = array_add($this->vars, 'title' , $this->title);
    	$this->vars = array_add($this->vars, 'navigation', $navigation);
    	$this->vars = array_add($this->vars, 'bar', $this->bar);
    	
    	return view($this->template)->with($this->vars);
    }

    public function getMenu(){
    	return [
    		['name' => 'Статьи', 'route' => route('admin.articles.index')],
    		['name' => 'Портфолио', 'route' => 'admin.articles.index'],
    		['name' => 'Меню', 'route' => route('admin.menus.index')],
    		['name' => 'Пользователи', 'route' => 'admin.articles.index'],
    		['name' => 'Привилегии', 'route' => route('admin.permissions.index')],
    	];
    }
}
