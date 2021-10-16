<?php

namespace App\Base\Utils;

use SVG\SVG;
use App\Base\Support\Str;


class SvgLoader
{
    protected $baseDir;
    public function __construct() {
        $path = config('svg.path');
        $this->baseDir = get_template_directory().DIRECTORY_SEPARATOR.$path;
    }


    /**
     * 
     * @param string $name
     * @param array $attributes
     * @return \SVG\SVG
     * @throws \Exception
     */
    public function get($name, $attributes = [], \Closure $callback = null) {

        $svg = null;
        if (Str::startsWith($name, '/')) {
            $svg = $this->contentFromFullPath($name);
        }

        if($this->exists($name)) {
            $svg = $this->content($name);
        }

        if (!$svg) {
            return '';
            // throw new \Exception("SVG file: {{$name}} dont exist in directory: {$this->baseDir}");
        }

    
        $document = $svg->getDocument();
        foreach ($attributes as $attr => $value) {
            $document->setAttribute($attr, $value);
        }

        if(is_callable($callback)) {
            $callback($svg);
        }

        return $svg;
    }

    protected function exists($name) {
        return file_exists($this->baseDir.DIRECTORY_SEPARATOR.$name.'.svg');
    }

    /**
     * 
     * @param string $name
     * @return \SVG\SVG
     */
    protected function content($name) {
        $svg = SVG::fromFile($this->baseDir.DIRECTORY_SEPARATOR.$name.'.svg');
        return $svg;
    }

        /**
     * 
     * @param string $fullpath
     * @return \SVG\SVG
     */
    protected function contentFromFullPath($fullpath) {
        $svg = SVG::fromFile($fullpath);
        return $svg;
    }
}