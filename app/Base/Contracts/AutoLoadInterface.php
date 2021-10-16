<?php

namespace App\Base\Contracts;

interface AutoLoadInterface {
    /**
     * @return static
     */
    public static function load();
}