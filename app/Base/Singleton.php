<?php

namespace App\Base;
use App\Base\Contracts\SingletonInterface;

abstract class Singleton implements SingletonInterface
{
    private static $instances = [];
    protected function __construct() {}

    /**
     * @return $this
     */
    public static function init()
    {
        if (!isset(self::$instances[static::class])) {
            self::$instances[static::class] = new static();
        }
        return self::$instances[static::class];
    }

    /**
     * @return $this
     */
    public static function getInstance() {
        return static::init();
    }

    private function __clone() {}
    private function __wakeup() {}
} 