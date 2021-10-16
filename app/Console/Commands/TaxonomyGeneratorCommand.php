<?php

namespace App\Console\Commands;

use WP_CLI;
use App\Base\Support\Str;
use App\Base\Support\Arr;

class TaxonomyGeneratorCommand extends GeneratorCommand
{
    /**
     * @var array
     */
    protected $posts = [];

    /**
     * @param mixed $args Args.
     * @param mixed $assoc_args Assoc Args.
	 */
    public function run($args, $assoc_args)
    {
        $values = WP_CLI\Utils\parse_shell_arrays($assoc_args, ['posts']);
        $posts = explode(',', WP_CLI\Utils\get_flag_value( $values, 'posts', ''));
        $this->setPosts($posts);
        $this->execute(collect($args)->get(0, null));
    }

    /**
     * @param array $posts 
     */
    protected function setPosts(array $posts)
    {
        $newPosts = array_map(function ($post) {
            return array_map(function($item) { return trim($item); }, explode(',', $post));
        }, $posts);

        $this->posts = Arr::flatten($newPosts);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Database\Taxonomies';
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

        $postsWithQuotes = array_map(function($item) { return "'".$item."'"; }, $this->posts);
        $posts = '['.implode(',', $postsWithQuotes).']';

        $content = str_replace(
            ['DummyClass', 'dummy-class', 'Dummy Class', 'DummyPostTypes', 'textdomain'],
            [$class, Str::kebab($class), $name, $posts, app()->getTextDomain()],
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
        return __DIR__.'/stubs/taxonomy.stub';
    }

}