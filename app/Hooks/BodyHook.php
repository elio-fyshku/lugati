<?php

namespace App\Hooks;

use App\Base\Singleton;


class BodyHook extends Singleton
{
    protected function __construct()
    {
        add_filter('body_class', [$this, 'body_classes']);
    }

    /**
     * Adds custom classes to the array of body classes.
     *
     * @param array $classes Classes for the body element.
     * @return array
     */
    public function body_classes($classes)
    {
        return $classes;
    }
}
