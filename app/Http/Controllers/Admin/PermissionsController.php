<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;

use Corp\Repositories\PermissionsRepository;
use Corp\Repositories\RolesRepository;

use Auth;
use Gate;
use Corp\Http\Requests\ArticleRequest;
class PermissionsController extends AdminController
{
    
    protected $perm_rep = false;
    protected $role_rep = false;

    public function __construct(PermissionsRepository $p_rep, RolesRepository $r_rep)
    {
        parent::__construct();

        if(Auth::check()){
            if(Gate::denies('EDIT_USERS')){
                abort(403);
            }
        }

        $this->perm_rep = $p_rep;
        $this->role_rep = $r_rep;

        $this->template = env('THEME').'.admin.permissions';
    }

    public function index()
    {
        $roles = $this->getRoles();
        $permissions = $this->getPermissions();

        $this->content = view(env('THEME').'.admin.permissions_content', ['roles' => $roles, 'permissions' => $permissions ])->render();
        $this->title = 'Permissions Manager';

        return $this->renderOutput();
    }

    public function getRoles()
    {
        $result = $this->role_rep->get();

        return $result;
    }

    public function getPermissions()
    {
        $result = $this->perm_rep->get();

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $result = $this->perm_rep->changePermissions($request);

        return back()->with($result);
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
