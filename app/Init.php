<?php

namespace App;

use App\Base\Singleton;
use App\Base\Application;

use App\Theme\Theme;
use App\Theme\Brand;
use App\Theme\Header;
use App\Theme\Language;

use App\Hooks\AllowSvgHook;
use App\Base\Bootstrap\RegisterPostTypes;
use App\Base\Bootstrap\RegisterTaxonomies;
use App\Base\Bootstrap\RegisterAjaxHooks;


use App\Hooks\BodyHook;
use App\Hooks\HeadHook;
use App\Console\RegisterCommands;

class Init extends Singleton
{

    protected function __construct()
    {
        Application::init();
        RegisterCommands::init();
        Theme::init();
        Brand::init();
        Header::init();
        Language::init();
        RegisterPostTypes::init();
        RegisterTaxonomies::init();
        RegisterAjaxHooks::init();
        /**
         * Start of hooks
         */
        HeadHook::init();
        BodyHook::init();
        AllowSvgHook::init();
    }
}