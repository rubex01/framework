<?php

namespace App\Controllers\Demo;

use Framework\Pages\Pages;

class DemoController
{
    public function index()
    {
        return Pages::view('demo/demo', 'demo', [
            'title' => 'demo'
        ]);
    }
}