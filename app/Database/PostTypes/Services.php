<?php

namespace App\Database\PostTypes;

use App\Base\Database\PostType;

class Services
{
    public function create()
    {
        return PostType::create()
            ->slug('services')
            ->name(__('Services', 'taxsolutions'))
            ->menu_icon('dashicons-products')
            ->register();
    }
}