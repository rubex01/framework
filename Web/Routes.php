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