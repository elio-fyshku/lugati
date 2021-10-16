<?php

namespace App\Base;

use App\Base\Support\Str;
use App\Base\Http\ResponseInterface;

use Symfony\Component\HttpFoundation\Request;
use App\Base\Contracts\AutoLoadInterface;

abstract class Ajax extends Singleton implements AutoLoadInterface
{
    const PUBLIC_LEVEL = 'public';
    const PRIVATE_LEVEL = 'private';

    /**
     * ajax action [default snake_case(class name)]
     * @var string
     */
    public $action;

    /**
     * @var array
     */
    public $protection = ['public'];

    protected function __construct()
    {
        $this->setAction();
        if (in_array(Ajax::PRIVATE_LEVEL, $this->protection)) {
            add_filter("wp_ajax_{$this->action}", [$this, 'handleAction']);
        }

        if (in_array(Ajax::PUBLIC_LEVEL, $this->protection)) {
            add_filter("wp_ajax_nopriv_{$this->action}", [$this, 'handleAction']);
        }
    }

    protected function setAction()
    {
        if (!$this->action) {
            $className = (new \ReflectionClass($this))->getShortName();
            $this->action = Str::snake($className);
        }
    }

    public function handleAction()
    {
        
        $data = $this->handle(request());
        if ($data instanceof ResponseInterface) {
           $data->send();
        }

        if (is_array($data)) {
            wp_send_json($data);
        }

        if (is_string($data)) {
            echo $data;
        }
        
        wp_die();
    }

    /**
     * handle ajax action
     * @param \Symfony\Component\HttpFoundation\Request
     * @return return array
     */
    abstract public function handle(Request $request);

    public static function load()
    {
        return static::init();
    }
}
