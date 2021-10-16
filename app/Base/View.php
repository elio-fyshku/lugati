<?php
namespace App\Base;

class View
{
    /**
     * @var string
     */
    const NAME_DELIMITER = '@';

    const BASE_DIR = 'resources/views';

    /**
     * Get view
     *
     * @param string $name          View Name.
     * @param string $template_name Template name.
     *
     * @return mixed
     */
    public static function get($name, $template_name = null)
    {
        $path = View::BASE_DIR . '/' . self::normalize_path($name);
        if (strpos($path, View::NAME_DELIMITER) === false) {
            return get_template_part($path, $template_name);
        }

        list($slug, $name) = explode(self::NAME_DELIMITER, $path);

        return get_template_part($slug, $name);
    }

    /**
     * @param string $name
     * @return string
     */
    public static function normalize_path($name)
    {
        return str_replace('.', '/', $name);
    }

    /**
     * @param string $template_name
     * @param array  $args
     * @param string $template_path
     * @param bool   $return_html
     * @return string
     */
    public static function get_template($template_name, $args = [], $template_path = '', $return_html = false)
    {
        if (!empty($args) && is_array($args)) {
            extract($args); // @codingStandardsIgnoreLine
        }

        $template_name = View::normalize_path(str_replace('.php', '', $template_name)) . '.php';
        $located = static::locate_template($template_name, $template_path);

        if (!file_exists($located)) {
            /* translators: %s template */
            _doing_it_wrong(
                __FUNCTION__,
                sprintf(__('%s does not exist.', 'prenatal'), '<code>' . $located . '</code>'),
                '4.9'
            );
            return;
        }

        // Allow 3rd party plugin filter template file from their plugin.
        $located = apply_filters(app_prefix() . '_get_template', $located, $template_name, $args, $template_path);

        if ($return_html) {
            ob_start();
        }

        do_action(app_prefix() . '_before_template_part', $template_name, $template_path, $located, $args);

        include $located;

        do_action(app_prefix() . '_after_template_part', $template_name, $template_path, $located, $args);

        if ($return_html) {
            return ob_get_clean();
        }
    }

    public static function locate_template($template_name, $template_path = '')
    {
        if (!$template_path) {
            $template_path = View::BASE_DIR;
        }

        // Look within passed path within the theme - this is priority.
        $template = locate_template([
            trailingslashit($template_path) . $template_name,
            $template_name,
        ]);

        return apply_filters(app_prefix() . '_locate_template', $template, $template_name, $template_path);
    }
}
