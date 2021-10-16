<?php

namespace App\Console\Commands;

use WP_CLI;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class ChangeTextDomainCommand
{
    /**
     * @var \Symfony\Component\Finder\Finder
     */
    protected $finder;

    /**
     * @var string
     */
    protected $baseDir;

    /**
     * @var string
     */
    protected $pattern;

    /**
     * @var string
     */
    protected $replacement;

    public function __construct()
    {
        $this->baseDir = get_stylesheet_directory();
        $this->finder = Finder::create();
    }
    
    /**
     * @param mixed $args Args.
     * @param mixed $assoc_args Assoc Args.
	 */
    public function run($args, $assoc_args)
    {

        $old_textdomain = app()->getTextDomain();
        $new_textdomain = collect($args)->get(0, null);

        if (!$new_textdomain) {
            WP_CLI::error( 'You need to specify new textdomain in order to change.' );
        }

        $this->pattern = "/(__\(.*?['\"])({$old_textdomain})(['\"].*?\))/";
        $this->replacement = "\${1}{$new_textdomain}\${3}";

        $this->replaceTextDomainInAllPhpFiles();
        $this->changeTextDomainInStyle($old_textdomain, $new_textdomain);

        WP_CLI::success( 'TEXT DOMAIN was changed successfully!' );
    }

     /**
     *
     * @return void
     */
    protected function replaceTextDomainInAllPhpFiles() {
        $files = $this->finder->in($this->baseDir)
                    ->contains($this->pattern)
                    ->exclude([
                        'app/Console',
                        'app/Base',
                        'resources/assets',
                        'vendor',
                        'none_modules',
                        'logs',
                        'build',
                    ])
                    ->name('*.php');

        $dbFiles = $this->finder->in($this->baseDir . '/app/Base/Database')
                    ->contains($this->pattern)
                    ->name('*.php');
        
        foreach ($files as $file) {
            $this->replaceTextDomain($file);
        }

        foreach ($dbFiles as $file) {
            $this->replaceTextDomain($file);
        }
    }

    /**
     *
     * @param  \Symfony\Component\Finder\SplFileInfo $file
     * @return void
     */
    protected function replaceTextDomain(SplFileInfo $file)
    {
        $content = $file->getContents();
        $newContent = preg_replace($this->pattern, $this->replacement, $content);
        file_put_contents($file->getRealPath(), $newContent);
    }

    /**
     *
     * @param string $old_textdomain
     * @param string $new_textdomain
     * @return void
     */
    protected function changeTextDomainInStyle($old_textdomain, $new_textdomain)
    {
        $file = $this->baseDir.'/style.css';
        $search = 'Text Domain: '.$old_textdomain;
        $replace = 'Text Domain: '.$new_textdomain;

        $content = file_get_contents($file);

        $newContent = str_replace($search, $replace, $content);
        
        file_put_contents($file, $newContent);
    }
}