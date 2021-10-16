<?php

namespace App\Base\Bootstrap;

use App\Base\Singleton;
use App\Base\Contracts\AutoLoadInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;

class RegisterClasses extends Singleton
{
    /**
     * @var string
     */
    public $namespace;

    /**
     * @var string
     */
    public $directory;

    public function __construct()
    {
        foreach ($this->findAll() as $key => $class) {
            $this->register($class);
        }
    }

    protected function register($class)
    {
        if (class_exists($class) && (new \ReflectionClass($class))->implementsInterface(AutoLoadInterface::class)) {
            $class::load();                
        }
    }

    public function findAll()
    {
        $path = TEMPLATEPATH.DIRECTORY_SEPARATOR.$this->directory;
        $files = [];

        try {
            foreach (Finder::create()->files()->name('*.php')->in($path) as $file) {
                $fileName = basename($file->getRealPath(), '.php');
                $files[$fileName] = $this->namespace . '\\' . $fileName;
            }
    
            ksort($files, SORT_NATURAL);
    
            return $files;
        } catch (DirectoryNotFoundException $exp) {
            return [];
        }
    }
}
