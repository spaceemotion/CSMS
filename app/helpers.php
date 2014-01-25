<?php

// Add image link helper
HTML::macro('image_link', function($url = '', $img = '', $alt = '', $linkParams = array(), $imgParams = array(), $active = true, $ssl = false)
{
    $url	= $ssl ? URL::to_secure($url) : URL::to($url);
    $img 	= HTML::image($img, $alt, $imgParams);
    $link 	= $active ? HTML::link($url, '::replace::', $linkParams) : $img;
    return str_replace('::replace::', $img, $link);
});