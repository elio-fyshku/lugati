<?php

/**
 * 
 * 
 * Enter your helpers here
 * 
 * 
 */

if (!function_exists('logo_url')) {
    function logo_url()
    {
        return App\Site::logo_url();
    }
}

if (!function_exists('logo_svg')) {
    function logo_svg($attributes = [], \Closure $callback = null)
    {
        echo App\Site::logo_svg($attributes, $callback);
    }
}

if (!function_exists('get_asset_handle')) {
    /**
     * @param string $key
     * @param string $type
     * @return string
     */
    function get_asset_handle($key, $type = 'script')
    {
        return App\Theme\Theme::getInstance()->get_asset_handle($key, $type);
    }
}