<!DOCTYPE html>
<html lang="en">
  <head>
    <title>{{ $title or 'Catacomb Snatch' }}</title>

    <meta charset="utf-8">
    <meta name="description" content="The Catacomb Snatch Repository">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    {{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css') }}
    {{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css') }}
    {{ HTML::style('/css/main.css') }}
  </head>

  <body>
    <header>
      <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          {{ HTML::linkRoute('home', 'Catacomb Snatch') }}
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

          <ul class="nav navbar-nav navbar-right">
            @if(false)
            <p class="navbar-text hidden-xs">Signed in as <?= $login['name'];?></p>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/settings/profile">Profile</a></li>
                <li><a href="/settings/account">Account</a></li>
                <li class="divider"></li>
                <li><a href="/session/logout">Logout</a></li>
              </ul>
            </li>
            @else
            @endif
          </ul>
        </div>
      </nav>
    </header>
    <section>
      <div class="container">@yield('content')</div>
    </section>
    <footer>
      <div class="container">
        <? /* add more stuff here */ ?><br /><br />
        <div class="hidden-xs">
          <span>Connect with us:</span>
          <a class="btn btn-connect navbar-btn" id="connect-fb" target="_blank" href="//facebook.com/"><i class="fa fa-facebook"></i></a>
          <a class="btn btn-connect navbar-btn" id="connect-tw" target="_blank" href="//twitter.com/"><i class="fa fa-twitter"></i></a>
          <a class="btn btn-connect navbar-btn" id="connect-gp" target="_blank" href="//plus.google.com/"><i class="fa fa-google-plus"></i></a>
        </div>
  			<p style="font-size: 10px;">The original resources of the game are, and remain the property of <a href="http://www.mojang.com/">Mojang AB</a>. Given the lack of information provided by Mojang AB regarding the licensing of these resources, any use, dissemination or reproduction of them is done without any warranty regarding their legality. <a href="/game/licence">Click here for the full licence</a></p>
      </div>
      <? /* Place all scripts at bottom */ ?>
      <script type="text/javascript" src="//code.jquery.com/jquery-1.10.1.min.js"></script>
      <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="/js/main.js"></script>
    </footer>
  </body>
</html>