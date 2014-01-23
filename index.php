<?php
  date_default_timezone_set("UTC"); // This is important for date information because PHP is stupid
  require_once('lib/limonade.php');
  
  // TODO: Add code for global config
  $config = Array(
    'site_name' => 'CatacombSnatch'
  );
  
  /* Web Pages */
  dispatch('/', "Main::index");
  dispatch('/game', 'Main::game');
  dispatch('/game/download', 'Main::download');
  dispatch('/game/license', 'Main::license');
  
  dispatch('/blog/article/:id', "Blog::article");
  dispatch('/blog/:page', "Blog::index");
  
  dispatch('/servers', 'Server::index');
  dispatch('/server/:id', 'Server::show');
  dispatch('/server/:id/edit', "Server::edit");
  
  dispatch('/maps', "Map::index");
  dispatch('/map/:id', "Map::show");
  dispatch('/map/:id/edit', "Map::edit");

  dispatch('/user/login', 'User::login_page');
  dispatch('/user/logout', 'User:logout');
  dispatch_post('/user/login', 'User::login');
  dispatch_post('/user/register', 'User::register');
  dispatch('/user/:id', 'User::index');
  
  /*dispatch('/help', "Help::index");
    dispatch('/help/:page');
    dispatch('/develop', "Develop::index");*/
  
  /* API */
  dispatch_post("/api/server/update", "Server::API_update");
  dispatch_post("/api/server/auth", "Server::API_auth");
  dispatch_post("/api/server/list", "Server::API_list");
  dispatch_post("/api/server/get", "Server::API_get");
  
  dispatch_post("/api/map/update", "Map::API_update");
  dispatch_post("/api/map/list", "Map::API_list");
  dispatch_post("/api/map/get", "Map::API_get");
  
  dispatch_post("/api/user/auth", "User::API_auth");
  dispatch_post("/api/user/friends", "User::API_friends");
  dispatch_post("/api/user/messages", "User::API_messages");
  
  /* Admin Pages */
  dispatch('/admin', "Admin::index");
  
  dispatch_post('/admin/blog/post/:id', "Admin_Blog::post");
  dispatch('/admin/blog/delete/:id', "Admin_Blog::remove");
  dispatch('/admin/blog/edit/:id', "Admin_Blog::edit");
  dispatch('/admin/blog/:page', "Admin_Blog::index");
  
  dispatch_post('/admin/servers/update/:id', "Admin_Servers::update");
  dispatch('/admin/servers/delete/:id', "Admin_Servers::remove");
  dispatch('/admin/servers/edit/:id', "Admin_Servers::edit");
  dispatch('/admin/servers/:page', "Admin_Servers::index");
  
  dispatch_post('/admin/maps/update/:id', "Admin_Maps::update");
  dispatch('/admin/maps/delete/:id', "Admin_Maps::remove");
  dispatch('/admin/maps/edit/:id', "Admin_Maps::edit");
  dispatch('/admin/maps/:page', "Admin_Maps::index");
  
  dispatch('/admin/users/new', "Admin_Users::create_page");
  dispatch_post('/admin/users/new', "Admin_Users::create");
  dispatch_post('/admin/users/edit', "Admin_Users::edit");
  dispatch_post('/admin/users/update', "Admin_Users::update");
  dispatch_post('/admin/users/delete', "Admin_Users::remove");
  dispatch('/admin/users/:page', "Admin_Users::index");
  
  dispatch('/admin/logout', "Admin::logout");
  dispatch_post('/admin/login', "Admin::login");
  
  run();
?>