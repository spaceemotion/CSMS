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

Route::get('/servers', 'ServerController@index');
Route::get('/server/{id}', 'ServerController@show');
Route::get('/server/{id}/edit', "ServerController@edit");

Route::get('/maps', "MapController@index");
Route::get('/map/{id}', "MapController@show");
Route::get('/map/{id}/edit', "MapController@edit");

Route::get('/user/login', 'UserController@login_page');
Route::get('/user/logout', 'UserController@logout');
Route::post('/user/login', 'UserController@login');
Route::post('/user/register', 'UserController@register');
Route::get('/user/{id}', 'UserController@index');

/*
Route::get('/help', "HelpController@index");
Route::get('/help/{page}', "HelpController@page");

Route::get('/develop', "DevelopController@index");
*/

Route::post("/api/server/update", "ServerController@API_update");
Route::post("/api/server/auth", "ServerController@API_auth");
Route::post("/api/server/list", "ServerController@API_list");
Route::post("/api/server/get", "ServerController@API_get");

Route::post("/api/map/update", "MapController@API_update");
Route::post("/api/map/list", "MapController@API_list");
Route::post("/api/map/get", "MapController@API_get");

Route::post("/api/user/auth", "UserController@API_auth");
Route::post("/api/user/friends", "UserController@API_friends");
Route::post("/api/user/messages", "UserController@API_messages");

Route::get('/admin', "Admin@index");

Route::post('/admin/blog/post/{id}', "AdminBlogController@post");
Route::get('/admin/blog/delete/{id}', "AdminBlogController@remove");
Route::get('/admin/blog/edit/{id}', "AdminBlogController@edit");
Route::get('/admin/blog/{page}', "AdminBlogController@index");

Route::post('/admin/servers/update/{id}', "AdminServersController@update");
Route::get('/admin/servers/delete/{id}', "AdminServersController@remove");
Route::get('/admin/servers/edit/{id}', "AdminServersController@edit");
Route::get('/admin/servers/{page}', "AdminServersController@index");

Route::post('/admin/maps/update/{id}', "AdminMapsController@update");
Route::get('/admin/maps/delete/{id}', "AdminMapsController@remove");
Route::get('/admin/maps/edit/{id}', "AdminMapsController@edit");
Route::get('/admin/maps/{page}', "AdminMapsController@index");

Route::get('/admin/users/new', "AdminUsersController@create_page");
Route::post('/admin/users/new', "AdminUsersController@create");
Route::post('/admin/users/edit', "AdminUsersController@edit");
Route::post('/admin/users/update', "AdminUsersController@update");
Route::post('/admin/users/delete', "AdminUsersController@remove");
Route::get('/admin/users/{page}', "AdminUsersController@index");

Route::get('/admin/logout', "AdminController@logout");
Route::post('/admin/login', "AdminController@login");