<?php

namespace App\Http;

use App\Base\Ajax;
use Symfony\Component\HttpFoundation\Request;

class DummyAjax extends Ajax
{
    public function handle(Request $request) {
        return ['foo' => 'bar'];
    }
}