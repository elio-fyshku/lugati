<?php

return [
    "prefix" => "taxsolutions",

    "logs" => [
        /**
         * 
         * drivers: local
         * 
         */
        "driver" => "local",

        /**
         * 
         * name based on your project name
         * 
         */
        "logger_name" => "taxsolutions",
    ],

    "supports" => [
        "title-tag" => null,
        "post-thumbnails" => null,
        "post-formats" => ['gallery', 'video'],
        "custom-header" => null,
        "custom-logo" => null,
        "html5" => [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ],
    ],

    "admin_option_page" => [
        'page_title' => __('Options', 'taxsolutions'),
        'menu_title' => __('Options', 'taxsolutions'),
        'menu_slug' => 'options',
        'capability' => 'edit_posts',
        'redirect' => false,
        'icon_url' => 'dashicons-admin-generic',
    ],

    'nav_menus' => [
        'primary' => __('Primary Menu', 'taxsolutions'),
        'footer'  => __('Footer Menu', 'taxsolutions'),
    ],
    "sidebars" => [
        "sidebar" => [
            'name' => __('Sidebar', 'taxsolutions'),
            'description' => __('Default sidebar', 'taxsolutions'),
        ],
    ],

    "assets" => [
        "prefix" => "taxsolutions",
        "build_dir" => "build",
        "stylesheet_files" => [
            '/styles/app.css',
        ],
        "override_scripts" => [
        ],
        "scripts_files" => [
            '/scripts/app.js' => [
                'key' => 'app',
                'in_footer' => true,
                'deps' => ['jquery'],
                'include'=> true,
            ],
        ],
        "scripts_urls" => [
            'https://maps.googleapis.com/maps/api/js' => [
                'key' => 'google-maps',
                'params' => [
                    'v' => '3.exp',
                    'key' => '',
                ],
                'in_footer' => true,
                'include'=> false,
            ],
        ],
    ],
];
