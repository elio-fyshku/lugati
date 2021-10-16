# - Backend 

Custom filters
* `app_prefix() . '_js_initial_data'` args: $data
* `app_prefix() . '_register_sliders'` args: $sliders_config

Helpers
* `view` ex:  `view('header')` where header is in `resources/views` folder
* `logo_url` and `logo_svg`
* `config` get config values from config folder
* `get_asset_handle` get handler string for specific asset registered in config file.

## Create a Post Type

1. create new file in  `app/Database/PostTypes` folder.  
    Example: `Slider.php`.  
    Note: File must be named in CamelCase Style.

2. Create class with same name as file. Example `Slider`    

```php
<?php

namespace App\Database\PostTypes;

use App\Base\Database\PostType;

class Slider {
    public function create() {
        return PostType::create()
            ->slug('slider')
            ->name(__('Slider', 'taxsolutions'))
            ->menu_icon('dashicons-slides')
            ->register();
    }
}
```

---

## Create a Taxonomy

1. create new file in  `app/Database/Taxonomies` folder.   
    Example: `ProductCategory.php`.     
    Note: File must be named in CamelCase Style.

2. Create class with same name as file. Example `ProductCategory`   

```php
<?php

namespace App\Database\Taxonomies;

use App\Base\Database\Taxonomy;

class ProductCategory {
    public function create() {
        return Taxonomy::create()
            ->set_object_type(['product'])
            ->slug('product_category')
            ->name(__('Product Category', 'taxsolutions'))
            ->register();
    }
}
```

---

## Create Hooks ( *filters or actions* )

1. create new file in  `app/Hooks` folder.   
    Example: `BodyHook.php`.     
    Note: File must be named in CamelCase Style.

2. Create class with same name as file. Example `BodyHook`  

```php
<?php

namespace App\Hooks;

use App\Base\Singleton;


class BodyHook extends Singleton
{
    protected function __construct()
    {
        add_filter( 'body_class', [$this, 'body_classes'] );
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

```
3. Load Hook in `Init` class in `app` folder    

```php
<?php

namespace App;

use App\Base\Singleton;
// more code here

use App\Hooks\BodyHook;


class Init extends Singleton
{

    protected function __construct()
    {
        // more code here
        BodyHook::init();
    }
}
```

---

## Create General Classes

1. create new file in  `app` folder.
    Example: `Site.php`.     
    Note: File must be named in CamelCase Style.

2. Create class with same name as file. Example `Site`  

```php
<?php

namespace App;

class Site
{
    public static function logo() {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );

        if (!$image) {
            return false;
        }

        return [
            'url' => $image[0],
            'width' => $image[1],
            'height' => $image[2],
            'is_intermediate' => $image[3],
        ];
    }

    public static function logo_img() {
        $logo = static::logo();
        ?>
        <?php if ($logo) : ?>
            <img
                src="<?php echo $logo['url'] ?>"
                width="<?php echo $logo['width'] ?>"
                height="<?php echo $logo['height'] ?>"
                alt="<?php bloginfo('name'); ?>" />
        <?php else :
            bloginfo('name');
        endif; ?>
        <?php
    }

}
```
3. (*optional*) Initialize in `Init` class if you need

---

## Config Your Site

1. open `config/app.php`
2. change for you needs 

```php
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

```

### - Add more config files
    * create new file in `config` folder
```php
// site.php
<?php
    return [
        'name' => 'taxsolutions',
    ];
```
* use if with `config` helper
```php
    <?php
        $name = config('site.name', 'Default Value');
        dd($name);
```

## Register assets in pages you need ##
```php
<?php
    // Template Name: Contact
    $key = 'google-maps';
    wp_enqueue_script(get_asset_handle($key));

```

# - Frontend

## Install/Compile your assets
```console
dev-taxsolutions:taxsolutions-theme fitim$ cd /path/to/theme
dev-taxsolutions:taxsolutions-theme fitim$ npm install
dev-taxsolutions:taxsolutions-theme fitim$ npm install --save-dev <package> to install new package
dev-taxsolutions:taxsolutions-theme fitim$ npm run dev // use when developing
dev-taxsolutions:taxsolutions-theme fitim$ npm run prod // use when deploying to production
```
```
// all commands
npm run dev // alias of development
npm run development
npm run watch
npm run watch-poll
npm run hot
npm run prod // alias of production
npm run production
```


# - CONSOLE
```console
dev-taxsolutions:taxsolutions-theme fitim$ wp please
usage: wp please theme:change <command>
   or: wp please theme:make <command>

See 'wp help please <command>' for more information on a specific command.

```


# - WORDPRESS CLI INSTALLATION

all url downloads [https://bitbucket.org/fitimvata/taxsolutions-starter-theme/downloads/?tab=tags](https://bitbucket.org/fitimvata/taxsolutions-starter-theme/downloads/?tab=tags)
```console
mkdir your-project
mysql -u yourusername -p
create database yourdbname
wp config create --dbname="yourdbname" --dbuser="root" --dbpass=""
wp core install --url="" --title="" --admin_user="admin" --admin_password="admin" --admin_email="dev@newmedia.al"

wp theme install "https://bitbucket.org/fitimvata/taxsolutions-starter-theme/get/v0.2.2.zip" # this might change in the future
cd wp-content/themes
rm -rf twenty* # remove default wp themes
mv fitimvata-taxsolutions-starter-theme-6d7b393963b6 yourthemename #rename downloaded theme folder. default theme folder may be differet
cd yourthemename
composer install
wp please theme:change text-domain yourtextdomain
# change other props in style.css
```

**NOT COMPLETE**