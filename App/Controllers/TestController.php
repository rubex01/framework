<?php

namespace App\Controllers;

use Framework\Validation\Validation;
use Framework\Request\Request;
use Framework\Pages\Pages;

class TestController
{

    public function index()
    {
        return Pages::view('default', 'home', ['message' => 'this is a message', 'title' => 'Hello world!']);
    }


    public function post(Request $request, string $parameter)
    {
        $validation = new Validation(
            $request->body,
            [
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'string'],
            ],
            [
                'email.required' => 'Email is een verplicht veld',
                'email.email' => 'U heeft geen geldig email adres ingevoerd',
                'email.exists:users' => 'Er bestaat geen account met dit email adres',
                'password.required' => 'Wachtwoord is een verplicht veld',
            ],
        );

        if (count($validation->validationErrors) > 0) {
            print_r($validation->validationErrors);
        }
        
        echo $parameter;
    }
}