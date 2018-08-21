<?php

namespace Corp\Http\Controllers\MyAuth;

use Corp\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Corp\Http\Controllers\SiteController;

class MyAuthController extends SiteController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers ;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {	
    	parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));
        $this->middleware('guest')->except('logout');
        $this->template =env('THEME').'.login';
    }


    public function showLoginForm()
    {
        $content = view(env('THEME').'.login_content')->render();

        $this->vars = array_add($this->vars, 'content', $content);
        $this->title = 'MyLogin';
        return $this->renderOutput();
    }


    public function username(){
        return 'name';
    }
}
