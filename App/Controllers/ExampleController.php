<?php

namespace App\Controllers;

use Framework\Pages\Pages;

class ExampleController
{
    public function index()
    {
        return Pages::view('default', 'welcome', [
                'subheader' => 'Say hello to freedom..',
                'header' => 'Escape the clutter and experience<br>the joy of coding flawless',
                'title' => 'Hello world!'
        ], true);
    }
}