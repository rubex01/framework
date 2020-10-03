<?php

use Framework\Routing\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here you can register new routes for your app. See the docs to get
| started. Now create something nice!
|
*/

Route::get('/', [App\Controllers\ExampleController::class, 'index']);

Route::group(
    [
        'prefix' => '/auth',
        'middleware' => ['auth'],
        'routes' => [
            Route::get('/account', [App\Controllers\ExampleController::class, 'index']),
            Route::get('/logout', [App\Controllers\ExampleController::class, 'index']),
        ]
    ]
);