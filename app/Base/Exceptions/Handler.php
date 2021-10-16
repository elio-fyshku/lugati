<?php

namespace App\Base\Exceptions;

use Exception;

use App\Base\Support\Arr;

class Handler
{
    /**
     * Report or log an exception.
     *
     * @param  \Exception  $e
     * @return mixed
     *
     * @throws \Exception
     */
    public function report(Exception $e)
    {

        if (method_exists($e, 'report')) {
            return $e->report();
        }

        try {
            $logger = $this->getLogger();
        } catch (Exception $ex) {
            // dd($ex);
            throw $e; // throw the original exception
        }

        $logger->write(
            array_merge($this->context(), ['exception' => $this->convertExceptionToArray($e)])
        );
    }

    /**
     * @return \App\Base\Debug\StackdriverLogger|\App\Base\Debug\MonologLogger
     */
    protected function getLogger() {
        $driver = config('app.logs.driver', 'local');

        switch ($driver) {
            case 'stackdriver':
                return new \App\Base\Debug\StackdriverLogger();
            case 'local':
            default:
                return new \App\Base\Debug\MonologLogger(); 
        }
    }


    /**
     * Get the default context variables for logging.
     *
     * @return array
     */
    protected function context()
    {
        return [];
    }

    /**
     * Render an exception into a response.
     *
     * @param  \Exception  $e
     */
    public function render(Exception $e)
    {
        ob_clean();
        print $this->renderExceptionWithWhoops($e);
        ob_start();
        die;
    }

    /**
     * Render an exception to a string using "Whoops".
     *
     * @param  \Exception  $e
     * @return string
     */
    protected function renderExceptionWithWhoops(Exception $e)
    {
        $whoops = new \Whoops\Run;

        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);

        $whoops->writeToOutput(false);

        $whoops->allowQuit(false);

        return $whoops->handleException($e);
    }

    /**
     * Convert the given exception to an array.
     *
     * @param  \Exception  $e
     * @return array
     */
    protected function convertExceptionToArray(Exception $e, $render = false)
    {
        $trace = $e->getTrace();

        if (!$render) {
            $trace = array_map(function ($trace) {
                return Arr::except($trace, ['args']);
            }, $e->getTrace());
        }


        return [
            'message' => $e->getMessage(),
            'exception' => get_class($e),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $trace,
        ];
    }
}
