<?php

namespace App\Console\Commands;

use WP_CLI;
use App\Base\Support\Str;

abstract class GeneratorCommand
{
    /**
     * @var string
     */
    protected $namespace;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $rawName;

    /**
     * @var string
     */
    protected $baseDir;

    public function __construct()
    {
        $this->baseDir = get_stylesheet_directory();
    }

    /**
     * @param string $name Name
     */
    protected function execute($name)
    {
        $this->rawName = $name;

        if (!$this->rawName) {
            WP_CLI::error( 'You need to specify name argument.' );
        }

        $name = $this->qualifyClass($this->rawName);

        $path = $this->getPath($name);


        if ($this->alreadyExists($this->rawName)) {
            WP_CLI::error( $this->name . ' already exists!' );
        }

        $this->makeDirectory($path);

        file_put_contents($path, $this->buildClass($name));

        WP_CLI::success( $this->name .' created successfully.' );
    }



    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $name = str_replace('/', '\\', $name);

        return $this->qualifyClass(
            $this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name
        );
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return file_exists($this->getPath($this->qualifyClass($rawName)));
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    abstract protected function getDefaultNamespace($rootNamespace);

     /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->baseDir.'/app/'.str_replace('\\', '/', $name).'.php';
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (!is_dir(dirname($path))) {
            @mkdir(dirname($path), 0777, true);
        }

        return $path;
    }


    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = file_get_contents($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyNamespace', 'DummyRootNamespace'],
            [$this->getNamespace($name), str_replace('\\', '', $this->rootNamespace())],
            $stub
        );

        return $this;
    }

    /**
     * Get the full namespace for a given class, without the class name.
     *
     * @param  string  $name
     * @return string
     */
    protected function getNamespace($name)
    {
        return trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    abstract protected function replaceClass($stub, $name);

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        if (! is_null($this->namespace)) {
            return $this->namespace;
        }

        $composer = json_decode(file_get_contents($this->baseDir.'/composer.json'), true);

        foreach ((array) $composer['autoload']['psr-4'] as $namespace => $path) {
            foreach ((array) $path as $pathChoice) {
                if (realpath($this->baseDir.'/app/') == realpath($this->baseDir.'/'.$pathChoice)) {
                    return $this->namespace = $namespace;
                }
            }
        }

        throw new RuntimeException('Unable to detect application namespace.');
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    abstract protected function getStub();

}