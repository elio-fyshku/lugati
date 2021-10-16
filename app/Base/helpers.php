<?php

use App\Base\View;
use App\Base\Http\JsonResponse;
use App\Base\Support\Collection;

if (!function_exists('dump_caller')) {
    function dump_caller()
    {
        $backtrace = debug_backtrace();
        $caller = next($backtrace);
        dump($caller);
    }
}

if (!function_exists('view')) {
    /**
     * @param string $name content@page where page is name content slug
     * @param string $template_name
     */
    function view($name, $template_name = null, $args = null)
    {
        if (is_array($template_name)) {
            $args = $template_name;
        } elseif (!empty($template_name) && is_string($template_name)) {
            $name = $name . '-' . $template_name;
        }

        if (is_array($args)) {
            return View::get_template($name, $args, '');
        }

        return View::get($name, $template_name);
    }
}
if (! function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @return App\Base\Application
     */
    function app()
    {
        return \App\Base\Application::getInstance();
    }
}

if (! function_exists('texdomain')) {
    /**
     * Get the theme textdomain
     *
     * @return string
     */
    function texdomain()
    {
        return app()->getTextDomain();
    }
}


if (! function_exists('request')) {
    /**
     * Get the request.
     *
     * @return \Symfony\Component\HttpFoundation\Request
     */
    function request()
    {
        return app()->getRequest();
    }
}

if (! function_exists('config')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string  $key
     * @param  mixed  $default
     * @return mixed|\App\Config\Repository
     */
    function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return app()->get('config');
        }

        if (is_array($key)) {
            return app()->get('config')->set($key);
        }

        return app()->get('config')->get($key, $default);
    }
}

if (! function_exists('app_prefix')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  string  $default
     * @return string
     */
    function app_prefix($default = null)
    {
        return config('app.prefix', $default);
    }
}


if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (! function_exists('collect')) {
    /**
     * Create a collection from the given value.
     *
     * @param  mixed  $value
     * @return \App\Base\Support\Collection
     */
    function collect($value = null)
    {
        return new Collection($value);
    }
}

if (! function_exists('json')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $data
     * @return \App\Base\Http\JsonResponse
     */
    function json($data = [])
    {
        return new JsonResponse($data);
    }
}


if (! function_exists('get_svg')) {
    /**
     * Return the default value of the given value.
     *
     * @param  string  $name
     * @param array $attributes
     * @return \SVG\SVG
     */
    function get_svg($name, $attributes = [], \Closure $callback = null)
    {
        $svg = (new App\Base\Utils\SvgLoader)->get($name, $attributes, $callback);

        return $svg;
    }
}


if (! function_exists('svg')) {
    /**
     * Return the default value of the given value.
     *
     * @param  string  $name
     * @param array $attributes
     * @return \SVG\SVG
     */
    function svg($name, $attributes = [], \Closure $callback = null)
    {
        echo get_svg($name, $attributes, $callback);
    }
}

if (!function_exists('get_svg_icon')) {
    /**
     * Returns svg icon
     *
     * @param $name
     * @param array $attributes
     * @param array $container_classes
     * @param Closure|null $callback
     * @throws Exception
     */
    function get_svg_icon($name, $attributes = [], $container_classes = [], \Closure $callback = null)
    {
        if (empty($container_classes)) {
            $container_classes = [ 'svg-icon--baseline' ];
        }
        $container_classes = array_unique(array_merge($container_classes, ['svg-icon']));
        $svg_container_class = implode(' ', $container_classes);
        $svg = get_svg($name, $attributes, $callback);
        
        $icon_html = '';
        if ($svg) {
            if ($name == 'trash-alt-solid') {
                // dump($svg->toXMLString());
            }
            $icon_html = '<div class="' . $svg_container_class . '">' . $svg . '</div>';
        }
        return $icon_html;
    }
}


if (!function_exists('svg_icon')) {
    /**
     * Output svg icon
     *
     * @param $name
     * @param array $attributes
     * @param array $container_classes
     * @param Closure|null $callback
     *
     */
    function svg_icon($name, $attributes = [], $container_classes = [], \Closure $callback = null)
    {
        echo get_svg_icon($name, $attributes, $container_classes, $callback);
    }
}


if (!function_exists('view_html')) {
    /**
     * Return template html.
     *
     * @param        $template_name
     * @param array  $args
     * @param string $template_path
     * @param bool   $html
     * @return mixed
     */
    function view_html($template_name, $args = [], $template_path = '', $html = true)
    {
        return View::get_template($template_name, $args, $template_path, $html);
    }
}

if (!function_exists('data_get')) {
    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param  mixed   $target
     * @param  string|array  $key
     * @param  mixed   $default
     * @return mixed
     */
    function data_get($target, $key, $default = null)
    {
        if (is_null($key)) {
            return $target;
        }
        $key = is_array($key) ? $key : explode('.', $key);
        while (!is_null($segment = array_shift($key))) {
            if ($segment === '*') {
                if ($target instanceof Collection) {
                    $target = $target->all();
                } elseif (!is_array($target)) {
                    return value($default);
                }
                $result = [];
                foreach ($target as $item) {
                    $result[] = data_get($item, $key);
                }
                return in_array('*', $key) ? Arr::collapse($result) : $result;
            }
            if (Arr::accessible($target) && Arr::exists($target, $segment)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return value($default);
            }
        }
        return $target;
    }
}