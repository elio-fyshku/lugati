<?php

namespace App;

use App\Base\Support\Str;

class Site
{
    public static function logo_svg($attributes = [], \Closure $callback = null) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo_path = get_attached_file($custom_logo_id);

        if (Str::endsWith($logo_path, '.svg')) {
            return get_svg($logo_path, $attributes, $callback);
        }

        return '';
    }

    public static function logo_url() {
        if (!has_custom_logo()) {
            return '#';
        }
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        return $image[0];
    }
}
