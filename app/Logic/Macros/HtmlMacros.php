<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;

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
html()->macro('image_link', function ($url = '', $img = '', $alt = '', $link_name = '', $param = [], $active = true, $ssl = false) {
    $url = URL::to($url, [], $ssl === true);
    $imageHtml = (string) html()->img($img, $alt);
    $imageHtml .= $link_name;

    if ($active !== true) {
        return new HtmlString($imageHtml);
    }

    $link = html()->a($url)->html($imageHtml);

    if (is_array($param) && ! empty($param)) {
        $link = $link->attributes($param);
    }

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
html()->macro('icon_link', function ($url = '', $icon = '', $link_name = '', $param = [], $active = true, $ssl = false) {
    $url = URL::to($url, [], $ssl === true);
    $iconHtml = '<i class="'.$icon.'" aria-hidden="true"></i>'.$link_name;

    if ($active !== true) {
        return new HtmlString($iconHtml);
    }

    $link = html()->a($url)->html($iconHtml);

    if (is_array($param) && ! empty($param)) {
        $link = $link->attributes($param);
    }

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
html()->macro('icon_btn', function ($url = '', $icon = '', $link_name = '', $param = [], $active = true, $ssl = false) {
    $url = URL::to($url, [], $ssl === true);
    $iconHtml = $link_name.' <i class="'.$icon.'" aria-hidden="true"></i>';

    if ($active !== true) {
        return new HtmlString($iconHtml);
    }

    $link = html()->a($url)->html($iconHtml);

    if (is_array($param) && ! empty($param)) {
        $link = $link->attributes($param);
    }

    return $link;
});

/*
 * Show Username.
 *
 * @return string
 */
html()->macro('show_username', function () {
    $the_username = (Auth::user()->name === Auth::user()->email) ? ((is_null(Auth::user()->first_name)) ? (Auth::user()->name) : (Auth::user()->first_name)) : ((is_null(Auth::user()->name)) ? (Auth::user()->email) : (Auth::user()->name));

    return $the_username;
});
