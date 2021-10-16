<?php 

namespace App\Base\Http;

interface ResponseInterface
{
    /**
     * @param mixed $data
     * @return $this
     */
    public function data($data);

    /**
     * @param number $status
     * @return $this
     */
    public function status($status);

    /**
     * Send Response
     * @return void
     */
    public function send();
}
