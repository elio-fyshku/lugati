<?php
namespace App\Base;

use App\Base\Exceptions\Handler;
use Symfony\Component\HttpFoundation\Request;

class Application extends Singleton
{
    /**
     * Theme textdomain
     *
     * @var string
     */
    protected $textdomain;
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;
    /**
     * The container's shared instances.
     *
     * @var array
     */
    protected $instances = [];

    protected $bootstrappers = [
        \App\Base\Bootstrap\LoadConfiguration::class,
        \App\Base\Bootstrap\HandleExceptions::class,
    ];

    protected function __construct()
    {
        $this->instance('logger', new Handler);

        $this->bootstrapWith($this->bootstrappers);
        $this->request = Request::createFromGlobals();
        $this->setTextDomain();
        
    }

    private function getLineWithString($fileName, $str) {
        $lines = file($fileName);
        foreach ($lines as $lineNumber => $line) {
            if (strpos($line, $str) !== false) {
                return $line;
            }
        }
        return '';
    }
    
    private function setTextDomain() {
        $textDomain = $this->getLineWithString(get_template_directory().'/style.css', 'Text Domain');
        $this->textdomain = trim(str_replace('Text Domain:', '', $textDomain));
    }

    /**
     * @return string
     */
    public function getTextDomain() {
        return $this->textdomain;
    }

    /**
     * Run the given array of bootstrap classes.
     *
     * @param  array  $bootstrappers
     * @return void
     */
    public function bootstrapWith(array $bootstrappers)
    {
        $this->hasBeenBootstrapped = true;

        foreach ($bootstrappers as $bootstrapper) {
            (new $bootstrapper)->bootstrap($this);
        }
    }

    /**
     * Register an existing instance as shared in the container.
     *
     * @param  string  $abstract
     * @param  mixed   $instance
     * @return mixed
     */
    public function instance($abstract, $instance)
    {
        $this->instances[$abstract] = $instance;
        return $instance;
    }

    /**
     * Determine if the given abstract type has been bound.
     *
     * @param  string  $abstract
     * @return bool
     */
    public function bound($abstract)
    {
        return isset($this->instances[$abstract]);
    }

    public function get($abstract)
    {
        if ($this->bound($abstract)) {
            return $this->instances[$abstract];
        }
        return null;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest() {
        return $this->request;
    }

}
