<?php

namespace App\Base\Bootstrap;

class RegisterTaxonomies extends RegisterClasses
{
    public $namespace = '\App\Database\Taxonomies';
    public $directory = 'app/Database/Taxonomies';

    protected function register($class)
    {
        $instance = (new $class())->create();
        if ($instance && (new \ReflectionClass($instance))->getShortName() === 'RegisterTaxonomy') {
            add_action('init', [$instance, 'register'], 20);
        }
    }
}
