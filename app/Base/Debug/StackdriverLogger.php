<?php

namespace App\Base\Debug;

use Google\Cloud\Logging\LoggingClient;

class StackdriverLogger
{
    protected $logger;
    protected $projectId;
    protected $loggerName;
    protected $driver;

    public function __construct()
    {
        $this->projectId = config('app.logs.project_id', 'newmedia-logs'); //'newmedia-logs';
        $this->loggerName = config('app.logs.logger_name', 'taxsolutions');
        $this->driver = config('app.logs.driver', 'local');
        $this->setupStackDriver();

    }

    public function setupStackDriver()
    {
        $credentialsFile = config('app.logs.credentials_file', 'wordpress-stackdriver');
        $credentialsFilePath = __DIR__ . '/../../../' . $credentialsFile . '.json';

        // See Google\Cloud\Logging\LoggingClient::__construct
        $loggingClientOptions = [
            'projectId' => $this->projectId,
            'keyFilePath' => $credentialsFilePath,
        ];

        $this->logger = (new LoggingClient($loggingClientOptions))->logger($loggerName);
        $this->monologLogger = new MonologLogger();
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
        $entry = $this->logger->entry((array)$data);
        $this->logger->write($entry);
        if ($this->monologLogger) {
            $this->monologLogger->write($entry);
        }
    }
}
