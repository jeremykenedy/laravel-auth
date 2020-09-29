<?php

/**
 * Render an image with an anchor tag around it.
 *
 * @var string url
 * @var string img
 * @var string alt
 * @var string link_name
 * @var string param
 * @var bool active
 * @var bool ssl
 *
 * @return string
 */
HTML::macro('image_link', function ($url = '', $img = '', $alt = '', $link_name = '', $param = '', $active = true, $ssl = false) {
    $url = $ssl === true ? URL::to_secure($url) : URL::to($url);
    $img = HTML::image($img, $alt);
    $img .= $link_name;
    $link = $active === true ? HTML::link($url, '#', $param) : $img;
    $link = str_replace('#', $img, $link);

    return $link;
});

/*
 * Render an icon with an anchor tag around it.
 *
 * @var string url
 * @var string icon
 * @var string link_name
 * @var string param
 * @var bool active
 * @var bool ssl
 *
 * @return string
 */
HTML::macro('icon_link', function ($url = '', $icon = '', $link_name = '', $param = '', $active = true, $ssl = false) {
    $url = $ssl === true ? URL::to_secure($url) : URL::to($url);
    $icon = '<i class="'.$icon.'" aria-hidden="true"></i>'.$link_name;
    $link = $active === true ? HTML::link($url, '#', $param) : $icon;
    $link = str_replace('#', $icon, $link);

    return $link;
});

/*
 * Render an button with an icon with an anchor tag around it.
 *
 * @var string url
 * @var string icon
 * @var string link_name
 * @var string param
 * @var bool active
 * @var bool ssl
 *
 * @return string
 */
HTML::macro('icon_btn', function ($url = '', $icon = '', $link_name = '', $param = '', $active = true, $ssl = false) {
    $url = $ssl === true ? URL::to_secure($url) : URL::to($url);
    $icon = $link_name.' <i class="'.$icon.'" aria-hidden="true"></i>';
    $link = $active === true ? HTML::link($url, '#', $param) : $icon;
    $link = str_replace('#', $icon, $link);

    return $link;
});

/*
 * Show Username.
 *
 * @return string
 */
HTML::macro('show_username', function () {
    $the_username = (Auth::user()->name === Auth::user()->email) ? ((is_null(Auth::user()->first_name)) ? (Auth::user()->name) : (Auth::user()->first_name)) : (((is_null(Auth::user()->name)) ? (Auth::user()->email) : (Auth::user()->name)));

    return $the_username;
});
