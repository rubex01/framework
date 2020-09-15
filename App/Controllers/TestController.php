<?php

namespace App\Controllers;

use Framework\Validation\Validation;

class TestController
{
    public static function renderPage(string $test)
    {
        echo $test;
    }

    public static function test()
    {
        $validation = new Validation($_POST, [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ],
        [
            'email.required' => 'Email is een verplicht veld',
            'email.email' => 'U heeft geen geldig email adres ingevoerd',
            'email.exists:users' => 'Er bestaat geen account met dit email adres',
            'password.required' => 'Wachtwoord is een verplicht veld',
        ]
        );

        if (count($validation->validationErrors) > 0) {
            print_r($validation->validationErrors);
        }
    }
}