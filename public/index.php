<?php

namespace {

    // Autoload classes
    include __DIR__ . '/../Framework/autoload.php';

    // Use Route and Database classes
    use Framework\Auth\Auth;
    use Framework\Routing\Route;
    use Framework\Database\Database;
    use Framework\Database\MySQL;

    // Setup Database connection
    $database = new MySQL;
    Database::connect($database);
    $Authorization = new Auth();

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here you can register new routes for your app. See the docs to get 
    | started. Now create something beautiful!
    |
    */

    Route::get('/', [App\Controllers\ExampleController::class, 'index']);

    Route::run();
}

