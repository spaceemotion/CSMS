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

Route::get('/', ['as' => 'home', function()
{
  return View::make('pages.home');

}]);

Route::get('/game', 'MainController@game');
Route::get('/game/download', 'MainController@download');
Route::get('/game/license', 'MainController@license');

Route::get('/blog/article/{id}', "BlogController@article");
Route::get('/blog/{page?}', "BlogController@index");

/**
 * These are just templates for us to show to the client JS will get API data
 */
Route::get('/servers', "MainController@servers");
Route::get('/server/{id}', "MainController@server");
Route::get('/server/edit', "MainController@server_edit");

Route::get('/maps', "MainController@maps");
Route::get('/map/{id}', "MainController@map");
Route::get('/map/edit', "MainController@map_edit");

Route::get('/users', "UserController@index");
Route::get('/users/{id}', ['as' => 'user.profile', 'uses' => "UserController@show"]);

Route::group(['before' => 'auth'], function()
{
  Route::get('session/logout', 'SessionController@logout');

  Route::get('settings/profile', "MainController@settings_profile");
  Route::get('settings/account', "MainController@settings_account");
});

Route::group(['before' => 'guest'], function()
{
  Route::get('login', function()
  {
    return View::make('main.users.login');
  });

  Route::post('login', 'SessionController@login');
});

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
Route::group(array('prefix' => 'admin'), function() {
  Route::group(array('prefix' => 'blog'), function() {
    Route::post('post/{id}', "Admin\BlogController@post");
    Route::get('delete/{id}', "Admin\BlogController@remove");
    Route::get('edit/{id}', "Admin\BlogController@edit");
    Route::get('/{page?}', "Admin\BlogController@index");
  });

  Route::group(array('prefix' => 'servers'), function() {
    Route::get('edit/{id}', "Admin\ServersController@edit");
    Route::get('/{page?}', "Admin\ServersController@index");
  });

  Route::group(array('prefix' => 'maps'), function() {
    Route::get('edit/{id}', "Admin\MapsController@edit");
    Route::get('/{page?}', "Admin\MapsController@index");
  });

  Route::group(array('prefix' => 'users'), function() {
    Route::post('edit', "Admin\UsersController@edit");
    Route::get('/{page?}', "Admin\UsersController@index");
  });

  Route::get('/', "Admin@index");
  Route::get('/switch', "Admin\Controller@switch");
});