<?php

namespace App\Theme;

use App\Base\Singleton;

class Theme extends Singleton
{

    /**
     * @var string
     */
    public $version;

    /**
     * @var string
     */
    public $resource_dir;

    /**
     * @var string
     */
    public $prefix;

    /**
     * @var array asset mix manifest
     */
    public $manifest = [];

    /**
     * @var array
     */
    public $stylesheet_files = [];

    /**
     * @var array
     */
    public $register_override_scripts = [];

    /**
     * @var array
     */
    public $scripts_files = [];

    /**
     * @var array
     */
    public $scripts_urls = [];

    protected function __construct()
    {
        $this->setup();
        $this->set_version();
        $this->set_mix_manifest();

        add_action('init', [$this, 'register_option_pages']);

        add_action('wp_head', [$this, 'js_vars']);
        add_action('widgets_init', [$this, 'sidebar']);

        add_action('after_setup_theme', [$this, 'setup_theme']);
        add_action('wp_enqueue_scripts', [$this, 'register_assets'], 1);
        add_action('wp_enqueue_scripts', [$this, 'load_assets'], 10);
    }

    private function setup() {
        $this->resource_dir = config('app.assets.build_dir');
        $this->prefix = config('app.assets.prefix', app_prefix());
        $this->stylesheet_files = config('app.assets.stylesheet_files');
        $this->scripts_files = config('app.assets.scripts_files');
        $this->scripts_urls = config('app.assets.scripts_urls');
        $this->register_override_scripts = config('app.assets.override_scripts');
    }

    /**
     * Read version from composer.json
     * @return void
     */
    private function set_version()
    {
        $content = file_get_contents(get_template_directory() . DIRECTORY_SEPARATOR . 'composer.json');
        $content = json_decode($content, true);
        $this->version = $content['version'] ?? '1.0.0';
    }

    /**
     * Read mix-manifest for compiled assets
     * @return void
     */
    private function set_mix_manifest()
    {
        $content = file_get_contents(get_template_directory() . DIRECTORY_SEPARATOR . $this->resource_dir . DIRECTORY_SEPARATOR . 'mix-manifest.json');
        $content = json_decode($content, true);
        $this->manifest = $content;
    }

    /**
     * setup theme
     * @return void
     */
    public function setup_theme()
    {
        load_theme_textdomain(texdomain(), get_template_directory() . DIRECTORY_SEPARATOR . 'languages');
        $this->register_nav_menus();
        $this->register_support();
    }

    /**
     *  register_nav_menus
     *
     * @see https://codex.wordpress.org/Function_Reference/register_nav_menu
     */
    public function register_nav_menus()
    {
        register_nav_menus(config('app.nav_menus', []));
    }

    /**
     *  register_option_pages
     *
     * @see https://www.advancedcustomfields.com/resources/options-page/
     */
    public function register_option_pages()
    {

        if (!function_exists('acf_add_options_page'))
            return;
	
		// options
        acf_add_options_page(config('app.admin_option_page', []));
    }

    /**
     *  support
     *
     * @see https://developer.wordpress.org/reference/functions/add_theme_support/
     */
    public function register_support()
    {
        foreach (config('app.supports', []) as $feature => $args) {
            if (!$args) {
                add_theme_support($feature);
            } else {
                add_theme_support($feature, $args);
            }
        }
    }

    /**
     * sidebar
     *
     * @see https://codex.wordpress.org/Function_Reference/register_sidebar
     */
    public function sidebar()
    {
        $sidebars = apply_filters(app_prefix() . '_register_sliders', config('app.sidebars'));

        foreach ($sidebars as $id => $sidebar) {
            register_sidebar([
                'name' => $sidebar['name'],
                'id' => $id,
                'description' => $sidebar['description'],
                'before_widget' => $sidebar['before_widget'] ?? '<section id="%1$s" class="widget %2$s">',
                'after_widget' => $sidebar['after_widget'] ?? '</section>',
            ]);
        }
    }

    /**
     * register some js variables
     *
     * @see https://codex.wordpress.org/Function_Reference/wp_localize_script
     */
    public function js_vars()
    {

        $INITIAL_DATA = apply_filters(app_prefix() .'_js_initial_data', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);

        ?>
            <script type="text/javascript">
			    window.INITIAL_DATA = <?php echo wp_json_encode($INITIAL_DATA); ?>;
		    </script>
        <?php

    }

    public function register_assets()
    {
        $uri = get_template_directory_uri() . '/' . $this->resource_dir;
        $path = get_template_directory() . DIRECTORY_SEPARATOR . $this->resource_dir;
        foreach ($this->register_override_scripts as $file => $options) {
            $mix_file = $this->manifest[$file] ?? $file;

            if (file_exists($path . $file)) {
                wp_deregister_script($options['key']);

                wp_register_script(
                    $options['key'], // handle
                    $uri . $mix_file, // src
                    $options['deps'] ?? [], // deps
                    $this->version, // version
                    $options['in_footer'] // in_footer
                );

                if (isset($options['include']) && $options['include']) {
                    wp_enqueue_script($options['key']);
                }
            }
        }
    }

    public function load_assets()
    {
        $this->load_stylesheet_files();
        $this->load_scripts_files();
    }

    protected function load_stylesheet_files()
    {
        $uri = get_template_directory_uri() . '/' . $this->resource_dir;
        $path = get_template_directory() . DIRECTORY_SEPARATOR . $this->resource_dir;

        foreach ($this->stylesheet_files as $key => $file) {
            $mix_file = $this->manifest[$file] ?? $file;
            if (file_exists($path . $file)) {
                wp_enqueue_style(
                    $this->get_asset_handle($key, 'style'), // handle
                    $uri . $mix_file, // src
                    [], // deps
                    $this->version, // version
                    'all' // media
                );
            }
        }
    }

    protected function load_scripts_files()
    {

        foreach ($this->scripts_urls as $url => $options) {
            if (is_array($options['params'])) {
                $url = $url . '?' . http_build_query($options['params']);
            }
            $handle = $this->get_asset_handle($options['key']);
            wp_register_script(
                $handle, // handle
                $url, // src
                $options['deps'] ?? [], // deps
                null, // version
                $options['in_footer'] // in_footer
            );

            if (isset($options['include']) && $options['include']) {
                wp_enqueue_script($handle);
            }
        }

        $uri = get_template_directory_uri() . '/' . $this->resource_dir;
        $path = get_template_directory() . DIRECTORY_SEPARATOR . $this->resource_dir;

        foreach ($this->scripts_files as $file => $options) {
            $mix_file = $this->manifest[$file] ?? $file;

            if (file_exists($path . $file)) {
                $handle = $this->get_asset_handle($options['key']);
                wp_register_script(
                    $handle, // handle
                    $uri . $mix_file, // src
                    $options['deps'] ?? [], // deps
                    $this->version, // version
                    $options['in_footer'] // in_footer
                );

                if (isset($options['include']) && $options['include']) {
                    wp_enqueue_script($handle);
                }
            }
        }
    }

    /**
     * @param string $key
     * @param string $type
     * @return string
     */
    public function get_asset_handle($key, $type = 'script')
    {
        if ($type === 'script') {
            return $this->prefix . '-scripts-url-' . $key;
        }

        if ($type === 'style'){
            return $this->prefix . '-style-' . $key;
        }

        return '';
    }
}