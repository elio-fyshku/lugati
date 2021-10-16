<?php

namespace App\Database\PostTypes;

use App\Base\Database\PostType;

class Slider
{
    public function create()
    {
        return PostType::create()
            ->slug('slider')
            ->name(__('Slider', 'yourtextdomain'))
            ->menu_icon('dashicons-slides')
            ->register();
    }
}