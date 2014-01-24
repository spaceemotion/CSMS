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
Route::resource('api/user', 'UserController');
Route::resource('api/server', 'ServerController');
Route::resource('api/map', 'MapController');

/**
 * Admin Controllers
 */
Route::get('/admin', "Admin@index");

Route::post('/admin/blog/post/{id}', "Admin\BlogController@post");
Route::get('/admin/blog/delete/{id}', "Admin\BlogController@remove");
Route::get('/admin/blog/edit/{id}', "Admin\BlogController@edit");
Route::get('/admin/blog/{page}', "Admin\BlogController@index");

Route::post('/admin/servers/update/{id}', "Admin\ServersController@update");
Route::get('/admin/servers/delete/{id}', "Admin\ServersController@remove");
Route::get('/admin/servers/edit/{id}', "Admin\ServersController@edit");
Route::get('/admin/servers/{page}', "Admin\ServersController@index");

Route::post('/admin/maps/update/{id}', "Admin\MapsController@update");
Route::get('/admin/maps/delete/{id}', "Admin\MapsController@remove");
Route::get('/admin/maps/edit/{id}', "Admin\MapsController@edit");
Route::get('/admin/maps/{page}', "Admin\MapsController@index");

Route::get('/admin/users/new', "Admin\UsersController@create_page");
Route::post('/admin/users/new', "Admin\UsersController@create");
Route::post('/admin/users/edit', "Admin\UsersController@edit");
Route::post('/admin/users/update', "Admin\UsersController@update");
Route::post('/admin/users/delete', "Admin\UsersController@remove");
Route::get('/admin/users/{page}', "Admin\UsersController@index");

Route::get('/admin/logout', "Admin\Controller@logout");
Route::post('/admin/login', "Admin\Controller@login");