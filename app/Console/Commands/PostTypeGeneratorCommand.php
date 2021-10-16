<?php

namespace App\Console\Commands;

use App\Base\Support\Str;

class PostTypeGeneratorCommand extends GeneratorCommand
{
    /**
	 * Create new post type.
     * This command allows you to create new post type
	 *
	 * ## OPTIONS
	 *
	 * [<name>]
	 * : New post-type class name.
	 *
	 * ## EXAMPLES
	 *
	 *     wp please theme post-type <name>
	 *
	 * @alias post-type
     * @param mixed $args Args.
     * @param mixed $assoc_args Assoc Args.
	 */
    public function run($args, $assoc_args)
    {
        $this->execute(collect($args)->get(0, null));
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Database\PostTypes';
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        $name = ucwords(str_replace(['-', '_'], ' ', Str::kebab($class)));
        $content = str_replace(
            ['DummyClass', 'dummy-class', 'Dummy Class', 'textdomain'],
            [$class, Str::kebab($class), $name, app()->getTextDomain()],
            $stub
        );

        return $content; //str_replace('DummyClass', $class, $stub);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/post-type.stub';
    }

}