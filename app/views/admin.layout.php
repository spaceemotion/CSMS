<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $vars["title"];?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css"/>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </head>
  <body>
    <?php if($vars["login"] != false):?>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/admin/">Admin</a>
      </div>
      <div class="collapse navbar-collapse" id="nav-collapse">
        <ul class="nav navbar-nav">
          <li<?php if($vars['active'] == "blog") { echo " class=\"active\""; }?>><a href="/admin/blog">Blog</a></li>
          <li<?php if($vars['active'] == "projects") { echo " class=\"active\""; }?>><a href="/admin/projects">Projects</a></li>
          <li<?php if($vars['active'] == "users") { echo " class=\"active\""; }?>><a href="/admin/users">Users</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <p class="navbar-text hidden-xs">Welcome, <?php echo $vars["login"]["full"];?>!</p>
          <li><a href="/admin/logout">Logout</a></li>
        </ul>
      </div>
    </nav>
    <?php endif;?>
    <section style="padding-top: 50px;">
      <?php echo $content; ?>
    </section>
  </body>
</html>