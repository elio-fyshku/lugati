<?php
namespace App\Theme;

use App\Base\Singleton;

class Header extends Singleton
{
    protected function __construct()
    {
        add_filter(app_prefix() . '_js_initial_data', function ($data) {
            $data['foo'] = 'bra';
            return $data;
        });
    }
}
