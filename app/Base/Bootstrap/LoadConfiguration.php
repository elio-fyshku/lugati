<?php

namespace App\Base\Bootstrap;

use Exception;
use SplFileInfo;
use App\Base\Application;
use App\Base\Config\Repository;
use Symfony\Component\Finder\Finder;


class LoadConfiguration
{
    /**
     * Bootstrap the given application.
     *
     * @param  \App\Base\Application  $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $items = [];


        // Next we will spin through all of the configuration files in the configuration
        // directory and load each one into the repository. This will make all of the
        // options available to the developer for use in various parts of this app.
        $app->instance('config', $config = new Repository($items));

     
        $this->loadConfigurationFiles($config);

        mb_internal_encoding('UTF-8');
    }

    /**
     * Load the configuration items from all of the files.
     *
     * @param  \App\Config\Repository  $repository
     * @return void
     * @throws \Exception
     */
    protected function loadConfigurationFiles(Repository $repository)
    {
        $files = $this->getConfigurationFiles();
        if (! isset($files['app'])) {
            throw new Exception('Unable to load the "app" configuration file.');
        }

        foreach ($files as $key => $path) {
            $repository->set($key, require $path);
        }
    }

    /**
     * Get all of the configuration files for the application.
     * @return array
     */
    protected function getConfigurationFiles()
    {
        $files = [];

        $configPath = realpath($this->configPath());

        foreach (Finder::create()->files()->name('*.php')->in($configPath) as $file) {
            $directory = $this->getNestedDirectory($file, $configPath);

            $files[$directory.basename($file->getRealPath(), '.php')] = $file->getRealPath();
        }

        ksort($files, SORT_NATURAL);

        return $files;
    }

    /**
     * Get the configuration file nesting path.
     *
     * @param  \SplFileInfo  $file
     * @param  string  $configPath
     * @return string
     */
    protected function getNestedDirectory(SplFileInfo $file, $configPath)
    {
        $directory = $file->getPath();

        if ($nested = trim(str_replace($configPath, '', $directory), DIRECTORY_SEPARATOR)) {
            $nested = str_replace(DIRECTORY_SEPARATOR, '.', $nested).'.';
        }

        return $nested;
    }


        /**
     * Get the path to the application configuration files.
     *
     * @param  string  $path Optionally, a path to append to the config path
     * @return string
     */
    public function configPath($path = '')
    {
        return get_template_directory().DIRECTORY_SEPARATOR.'config'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}
