<?php

namespace App\Base\Bootstrap;

class RegisterPostTypes extends RegisterClasses
{
    public $namespace = '\App\Database\PostTypes';
    public $directory = 'app/Database/PostTypes';

    public function __construct()
    {
        $this->register_all();
    }

    public function register_all()
    {
        foreach ($this->findAll() as $key => $class) {
            $this->register($class);
        }
    }

    protected function register($class)
    {
        $instance = (new $class())->create();

        if ($instance && (new \ReflectionClass($instance))->getShortName() === 'RegisterPostType') {
            add_action('init', [$instance, 'register'], 20);
        }
    }
}
