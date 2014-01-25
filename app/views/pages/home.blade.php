@extends('layouts.main')

@section('content')
<div class="jumbotron">
    <div class="row">
        <div class="col-sm-8">
            <h1>CatacombSnatch</h1>
            <p>Community edition</p>
        </div>
        <div class="col-sm-4 hidden-xs clearfix">
            <div class="pull-right well well-sm">
                Download the game!<br>

                {{-- Somehow detect the OS here --}}
                {{ HTML::link('#', trans('general.download.mac'), ['class' => 'btn btn-success']) }}
                {{ HTML::link('#', trans('general.download.more'), ['class' => 'btn btn-default']) }}
            </div>
        </div>
    </div>
</div>

<div class="page-header"><h1>What is it?</h1></div>
<p>Catacomb Snatch is a 2D top-down shooter/RTS originally created by {{ HTML::link('http://www.mojang.com/', 'Mojang') }} for the {{ HTML::link('http://www.humblebundle.com/', 'Humble Bundle') }} Mojam charity event and was released open-source into the wild. This site represents the {{ HTML::link('https://github.com/Catacomb-Snatch/Catacomb-Snatch', 'open-source rewrite') }} of this game.</p>
<p>On the right you can download the latest versions of the game for all platforms. The development versions may contain bugs, but also can contain a lot of new features. Use at your own risk!</p>

<div class="page-header"><h1>Some Cool Features:</h1></div>
<div class="row">
        <div class="col-sm-6 media-item">
            <div class="media">
                {{ HTML::image_link('#', '//placehold.it/150x150', '...', ['class' => 'pull-left'], ['class' => 'media-object img-rounded'] ) }}

                <div class="media-body">
                    <h4 class="media-heading">Mouse functionality</h4>
                    <p>Use your mouse to aim and fire into the direction you are pointing at.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 media-item">
            <div class="media">
                {{ HTML::image_link('#', '//placehold.it/150x150', '...', ['class' => 'pull-left'], ['class' => 'media-object img-rounded'] ) }}

                <div class="media-body">
                    <h4 class="media-heading">Enhanced tower functions</h4>
                    <p>Towers now have a health bar and can be leveled up three times (level 3 shown). By leveling them up, their health will be also increased!</p>
                </div>
            </div>
        </div>
</div>
<div class="row">
        <div class="col-sm-6 media-item">
            <div class="media">
                {{ HTML::image_link('#', '//placehold.it/150x150', '...', ['class' => 'pull-left'], ['class' => 'media-object img-rounded'] ) }}

                <div class="media-body">
                    <h4 class="media-heading">Level selection</h4>
                    <p>Tons of new levels have been added to the game for a more enjoyable expirience. You can also add your own maps into the game. It even supports multi-player level sending for even more fun!</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 media-item">
            <div class="media">
                {{ HTML::image_link('#', '//placehold.it/150x150', '...', ['class' => 'pull-left'], ['class' => 'media-object img-rounded'] ) }}

                <div class="media-body">
                    <h4 class="media-heading">More game mechanics</h4>
                    <p>The game got a lot of new menu screens like the pause menu or a how-to-play screen. Configurable options &amp; Language support is also new.</p>
                </div>
            </div>
        </div>
</div>
@endsection