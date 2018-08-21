<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/home', 'IndexController', [ 'only' => ['index'], 'names' => ['index' => 'home']]);
Route::resource('/', 'IndexController', [ 'only' => ['index'], 'names' => ['index' => 'home']]);

Route::auth();

Route::get('mylogin', 'MyAuth\MyAuthController@showLoginForm');
Route::post('mylogin','MyAuth\MyAuthController@login');
Route::get('mylogout', 'MyAuth\MyAuthController@logout');

Route::resource('portfolios', "PortfolioController", [
	'parameters' => [
		'portfolios' => 'alias',
	]
]);

Route::resource('articles', "ArticleController", [
	'parameters' => [
	'articles' => 'alias',
	]
]);

Route::get('articles/cat/{cat_alias}', ['uses' => 'ArticleController@Index' , 'as' => 'articlesCat'])->where('cat_alias', "[a-zA-Z]+" );

Route::match(['get','post'],'/contacts',['uses' => 'ContactController@index','as' => 'contact']);

Route::resource('comment', 'CommentController',
 ['only' => ['store']]);//оприділяємо один єдинний метод який буде обрабатувати коменнтарі


Route::group(['prefix'=> 'admin', 'middleware' => 'auth'], function (){
	//corporate.loc/admin
	Route::get('/',['uses' => 'Admin\IndexController@index', 'as' => 'adminIndex']);
	Route::resource('/articles', 'Admin\ArticlesController', ['names' => [
		'index' => 'admin.articles.index',
		'store' => 'admin.articles.store',
		'create' => 'admin.articles.create',
		'destroy' => 'admin.articles.destroy',
		'update' => 'admin.articles.update',
		'show' => 'admin.articles.show',
		'edit' => 'admin.articles.edit'
		]]);
	Route::post('/articles/delete', 'Admin\ArticlesController@delete')->name('asyncDeleteArticle');
	Route::resource('premissions', 'Admin\PermissionsController',['names' => [
		'index' => 'admin.permissions.index',
		'store' => 'admin.permissions.store',
		'create' => 'admin.permissions.create',
		'destroy' => 'admin.permissions.destroy',
		'update' => 'admin.permissions.update',
		'show' => 'admin.permissions.show',
		'edit' => 'admin.permissions.edit'
		]]);

	Route::resource('menus', 'Admin\MenusController',['names' => [
		'index' => 'admin.menus.index',
		'store' => 'admin.menus.store',
		'create' => 'admin.menus.create',
		'destroy' => 'admin.menus.destroy',
		'update' => 'admin.menus.update',
		'show' => 'admin.menus.show',
		'edit' => 'admin.menus.edit'
		]]);

});
Route::get('home', 'HomeController@index')->name('home');

Auth::routes();

