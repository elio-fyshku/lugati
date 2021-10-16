<?php

namespace App\Database\PostTypes;

use App\Base\Database\PostType;

class Industries
{
    public function create()
    {
        return PostType::create()
            ->slug('industries')
            ->name(__('Industries', 'taxsolutions'))
            ->menu_icon('dashicons-products')
            ->register();
    }
}