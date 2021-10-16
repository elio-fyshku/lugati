<?php

namespace App\Hooks;

use App\Base\Singleton;


class AllowSvgHook extends Singleton
{
    protected function __construct()
    {
        add_filter('upload_mimes', [ $this, 'allow_svg']);
    }

    public function allow_svg($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
}
