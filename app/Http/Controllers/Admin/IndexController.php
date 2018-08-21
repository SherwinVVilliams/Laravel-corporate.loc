<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Gate;
use Auth;
class IndexController extends AdminController
{
    public function __construct(){
    	parent::__construct();
    	$this->template = env('THEME').'.admin.index';
    	if(Auth::check()){
    		if(Gate::denies('VIEW_ADMIN')){
    			abort(403);
    		}
    	}	
    }

    public function index(){
    	$this->checkAccess();
    	$this->title = 'Панель Администратора';
    	//$this->content(env('THEME').'.admin.')

    	return $this->renderOutput();
    }

    public function checkAccess(){
    	if(Auth::check()){
    		if(Gate::denies('VIEW_ADMIN')){
    			abort(403);
    		}
    	}	
    }
}
