<?php

namespace App\Controllers;

use Framework\Validation\Validation;
use Framework\Request\Request;

class TestController
{
    public static function renderPage(Request $request, string $test)
    {

    }

    public static function test(Request $request)
    {
        $validation = new Validation($request->body, [
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string'],
        ],
        [
            'email.required' => 'Email is een verplicht veld',
            'email.email' => 'U heeft geen geldig email adres ingevoerd',
            'email.exists:users' => 'Er bestaat geen account met dit email adres',
            'password.required' => 'Wachtwoord is een verplicht veld',
        ]);

        if (count($validation->validationErrors) > 0) {
            print_r($validation->validationErrors);
        }

    }
}