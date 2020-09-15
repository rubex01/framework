<?php

namespace App\Middleware;

class Authentication
{
    public function handle()
    {
        if (1 === 1) {
            return true;
        }
    }

    public function onFailure()
    {
        echo 'error';
    }
}