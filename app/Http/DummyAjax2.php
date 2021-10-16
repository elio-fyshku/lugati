<?php

namespace App\Http;

use App\Base\Ajax;
use Symfony\Component\HttpFoundation\Request;

class DummyAjax2 extends Ajax
{
    public $protection = ['public', 'private'];
    public function handle(Request $request) {

        return json([
            'foo' => 'bar2'
        ])->status(200);
    }
}