<?php

namespace {
    include __DIR__ . '/../Framework/autoload.php';
    include __DIR__ . '/../Framework/ErrorHandling.php';

    use Framework\Routing\Route as Route;  
    use Framework\Database\Database;
    use Framework\Database\MySQL;

    $database = new MySQL;
    Database::connect($database);

    define('BASEPATH', '/');

    Route::get('/', [App\Controllers\ExampleController::class, 'index']);

    Route::post('/', [App\Controllers\ExampleController::class, 'index']);
    
    Route::run();
}

