<?php

namespace App\Base\Debug;

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

class MonologLogger
{
    protected $logger;
    protected $loggerName;
    protected $path;

    public function __construct()
    {
        $this->loggerName = config('app.logs.logger_name', 'taxsolutions');
        $this->logger = new Logger($this->loggerName);
        
        $this->path = $this->getDirectory() . DIRECTORY_SEPARATOR . $this->loggerName .'.log';
        $this->logger->pushHandler(new RotatingFileHandler($this->path, 30, Logger::DEBUG));
        
    }

    public function getDirectory()
    {
        $basedir = wp_get_upload_dir()['basedir'];
        $logDir = config('app.prefix') . '-logs';
        $path = $basedir . DIRECTORY_SEPARATOR . $logDir;

        if (!is_dir($path)) {
            mkdir($path);
        }

        return $path;
    }

    public function get()
    {
        return $this->logger;
    }

    public function write($data)
    {
        if (!$this->logger) {
            return;
        }
        $this->logger->error($data['exception']['message'], (array) $data);
    }
}
