<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('layout/default', function()
{
	return view('layout.default');
});
Route::get('default1', function()
{
	return view('layout.default1');
});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => ['web']], function () 
{

    Route::get('managenews', ['uses' => 'NewsController@manageNews' ,'as' => 'manage.news']);
    Route::resource('news', 'NewsController');

    /*Route::get('news', ['uses' => 'NewsController@news' ,'as' => 'news']);
    Route::get('newsdetail', ['uses' => 'NewsController@newsDetail' ,'as' => 'news.detail']);
    Route::get('news/{id}', ['as' => 'news.show', 'uses' => 'NewsController@show' ]);

    Route::get('news/{id}/edit', ['uses' => 'NewsController@edit' ,'as' => 'news.edit']);*/

    Route::post('publishnews', ['uses' => 'NewsController@publishNews' ,'as' => 'publish.news']);
    Route::get('index',['uses' => 'NewsController@index']);
    Route::get('addnews', ['uses' => 'NewsController@addNews' ,'as' => 'add.news']);
   Route::get('register', ['uses' => 'UserController@register']);
   Route::get('login', ['as' => 'users.login', 'uses' => 'UserController@login']);
   Route::get('forget', ['uses' => 'UserController@forget']);
   Route::any('users/registersuccess', ['uses' => 'UserController@registersuccess']);
  Route::any('users/authenticate', ['uses' => 'UserController@authenticate']);


    Route::get('getData/{id?}', ['uses' => 'UserController@getData']);

    Route::group(['middleware' => ['guest']], function()
	{
	   Route::get('users/logout', ['uses' => 'UserController@logout']);

		Route::get('dashboard', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);
        Route::post('reset', [ 'uses' => 'UserController@reset', 'as' => 'password.reset']);
        Route::post('password/reset', 'Auth\PasswordController@postReset');

       // Route::post('password/reset', 'Auth\PasswordController@postReset');
	});

 	
    });
