<?php

namespace App\Middleware;

class Authentication
{
    public function handle()
    {
        if (true === true) {
            return true;
        }
    }

    public function onFailure()
    {
        echo 'error';
    }
}