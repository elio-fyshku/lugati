<?php 

namespace App\Base\Http;

class JsonResponse implements ResponseInterface
{
    /**
     * @var mixed
     */
    protected $response_data;

    /**
     * @var number
     */
    protected $response_status = 200;

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->data($data);
    }

    /**
     * @param mixed $data
     * @return $this
     */
    public function data($data) {
        $this->response_data = $data;
        return $this;
    }

    /**
     * @param number $status
     * @return $this
     */
    public function status($status) {
        $this->response_status = $status;
        return $this;
    }
    
    public function send() {
        wp_send_json($this->response_data, $this->response_status);
    }
}
