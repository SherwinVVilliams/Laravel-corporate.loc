<?php

namespace Corp\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Corp\Permission;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \Corp\Article::class => \Corp\Policies\ArticlePolicy::class,
        Permission::class => \Corp\Policies\PermissionPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {


        Gate::define('VIEW_ADMIN', function($user){
            return $user->canDo('VIEW_ADMIN');// в якості другого параметру ми передаємо true тільки в тому випадку якщо нам потрібно щоб у користувача були права на всіх превілегії
        });

        Gate::define('VIEW_ADMIN_ARTICLES', function($user){
            return $user->canDo('VIEW_ADMIN_ARTICLES');
        });

        Gate::define('EDIT_USERS', function($user){
            return $user->canDo('EDIT_USERS');
        });

         Gate::define('VIEW_ADMIN_MENU', function($user){
            return $user->canDo('VIEW_ADMIN_MENU', FALSE);
        });

        $this->registerPolicies();
        //
    }
}
