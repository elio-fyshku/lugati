<?php

namespace App\Database\PostTypes;

use App\Base\Database\PostType;

class Team
{
    public function create()
    {
        return PostType::create()
            ->slug('team')
            ->name(__('Team', 'taxsolutions'))
            ->menu_icon('dashicons-products')
            ->register();
    }
}