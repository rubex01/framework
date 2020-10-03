<?php

namespace App\Controllers;

use Framework\Pages\Pages;

class ExampleController
{
    public function index()
    {
        return Pages::view('default', 'welcome', [
                'subheader' => 'Say hello to freedom..',
                'header' => 'Experience the joy of coding <br> and skip the messy parts', 
                'title' => 'Hello world!'
        ], true);
    }
}