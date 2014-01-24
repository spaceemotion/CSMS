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

Route::get('/blog/article/{id}', "Blog@article");
Route::get('/blog/{page}', "Blog@index");

Route::get('/servers', 'Server::index');
Route::get('/server/{id}', 'Server::show');
Route::get('/server/{id}/edit', "Server::edit");

Route::get('/maps', "Map@index");
Route::get('/map/{id}', "Map@show");
Route::get('/map/{id}/edit', "Map@edit");

Route::get('/user/login', 'User@login_page');
Route::get('/user/logout', 'User@logout');
Route::post('/user/login', 'User@login');
Route::post('/user/register', 'User::register');
Route::get('/user/{id}', 'User::index');

Route::get('/help', "Help::index");
Route::get('/help/{page}');
Route::get('/develop', "Develop::index");

Route::post("/api/server/update", "Server::API_update");
Route::post("/api/server/auth", "Server::API_auth");
Route::post("/api/server/list", "Server::API_list");
Route::post("/api/server/get", "Server::API_get");

Route::post("/api/map/update", "Map::API_update");
Route::post("/api/map/list", "Map::API_list");
Route::post("/api/map/get", "Map::API_get");

Route::post("/api/user/auth", "User::API_auth");
Route::post("/api/user/friends", "User::API_friends");
Route::post("/api/user/messages", "User::API_messages");

Route::get('/admin', "Admin::index");

Route::post('/admin/blog/post/:id', "Admin_Blog::post");
Route::get('/admin/blog/delete/:id', "Admin_Blog::remove");
Route::get('/admin/blog/edit/:id', "Admin_Blog::edit");
Route::get('/admin/blog/:page', "Admin_Blog::index");

Route::post('/admin/servers/update/:id', "Admin_Servers::update");
Route::get('/admin/servers/delete/:id', "Admin_Servers::remove");
Route::get('/admin/servers/edit/:id', "Admin_Servers::edit");
Route::get('/admin/servers/:page', "Admin_Servers::index");

Route::post('/admin/maps/update/:id', "Admin_Maps::update");
Route::get('/admin/maps/delete/:id', "Admin_Maps::remove");
Route::get('/admin/maps/edit/:id', "Admin_Maps::edit");
Route::get('/admin/maps/:page', "Admin_Maps::index");

Route::get('/admin/users/new', "Admin_Users::create_page");
Route::post('/admin/users/new', "Admin_Users::create");
Route::post('/admin/users/edit', "Admin_Users::edit");
Route::post('/admin/users/update', "Admin_Users::update");
Route::post('/admin/users/delete', "Admin_Users::remove");
Route::get('/admin/users/:page', "Admin_Users::index");

Route::get('/admin/logout', "Admin::logout");
Route::post('/admin/login', "Admin::login");