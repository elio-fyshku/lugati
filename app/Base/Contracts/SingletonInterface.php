<?php

namespace App\Base\Contracts;

interface SingletonInterface {
    /**
     * @return static
     */
    public static function init();
}