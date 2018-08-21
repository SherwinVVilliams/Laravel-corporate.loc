<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;

use Corp\Repositories\MenusRepository;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;

use Auth;
use Gate;

class MenusController extends AdminController
{
   protected $menu_rep = false;

    public function __construct(MenusRepository $m_rep, ArticlesRepository $a_rep, PortfoliosRepository $p_rep){

        if(Auth::check()){
            if(Gate::denies('VIEW_ADMIN_MENU')){
                abort(403);
            }
        }
        parent::__construct();
        $this->menu_rep = $m_rep;
        $this->article_rep = $a_rep;
        $this->portfolio_rep = $p_rep;

        $this->template = env('THEME').'.admin.index';
    }


    public function index()
    {
        $menu = $this->getMenus();
        $getChild = $this->menu_rep->getChildMenu();
        $paddingLeft = '';
        //dd($getChild);
        //$getChild);
        

        $this->content = view(env('THEME').'.admin.menu_content', ['menu'=> $menu, 'childMenus' => $getChild,  ])->render();
        $this->title = 'Menu List';

        return $this->renderOutput();
    }

    public function getMenus(){

        $result = $this->menu_rep->get();

        if($result->isEmpty()){
            return false;
        }

        return $result;
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
