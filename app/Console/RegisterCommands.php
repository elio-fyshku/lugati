<?php

namespace App\Console;

use WP_CLI;
use App\Base\Singleton;
use App\Console\Commands\MakeCommands;
use App\Console\Commands\ChangeCommands;

class RegisterCommands extends Singleton
{
    protected function __construct()
    {
        if ( defined( 'WP_CLI' ) && WP_CLI ) {
            WP_CLI::add_command('please theme:change', new ChangeCommands());
            WP_CLI::add_command('please theme:make', new MakeCommands());
        }
    }
}
