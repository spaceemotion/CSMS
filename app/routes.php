<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'MainController@index');
Route::get('/game', 'MainController@game');
Route::get('/game/download', 'MainController@download');
Route::get('/game/license', 'MainController@license');

Route::get('/blog/article/{id}', "BlogController@article");
Route::get('/blog/{page}', "BlogController@index");

Route::get('/session/login', 'SessionController@login_page');
Route::get('/session/logout', 'SessionController@logout');
Route::post('/session/login', 'SessionController@login');

/**
 * Resource Controllers
 */

// TODO: Implement api.* sub-domain
Route::resource('api/user', 'UserController');
Route::resource('api/server', 'ServerController');
Route::resource('api/map', 'MapController');

/**
 * Admin Controllers
 */
Route::group('admin', function() {
  Route::group('blog', function() {
    Route::post('post/{id}', "Admin\BlogController@post");
    Route::get('delete/{id}', "Admin\BlogController@remove");
    Route::get('edit/{id}', "Admin\BlogController@edit");
    Route::get('/{page}', "Admin\BlogController@index");
  }
  
  Route::group('servers', function() {
    Route::post('update/{id}', "Admin\ServersController@update");
    Route::get('delete/{id}', "Admin\ServersController@remove");
    Route::get('edit/{id}', "Admin\ServersController@edit");
    Route::get('/{page}', "Admin\ServersController@index");
  }
  
  Route::group('maps', function() {
    Route::post('update/{id}', "Admin\MapsController@update");
    Route::get('delete/{id}', "Admin\MapsController@remove");
    Route::get('edit/{id}', "Admin\MapsController@edit");
    Route::get('/{page}', "Admin\MapsController@index");
  }
  
  Route::group('users', function() {
    Route::get('new', "Admin\UsersController@create_page");
    Route::post('new', "Admin\UsersController@create");
    Route::post('edit', "Admin\UsersController@edit");
    Route::post('update', "Admin\UsersController@update");
    Route::post('delete', "Admin\UsersController@remove");
    Route::get('/{page}', "Admin\UsersController@index");
  }
  
  Route::get('/', "Admin@index");
  Route::get('/logout', "Admin\Controller@logout");
  Route::post('/login', "Admin\Controller@login");
}