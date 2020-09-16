<?php

namespace {
    include __DIR__ . '/../Framework/autoload.php';

    use Framework\Routing\Route as Route;  
    use Framework\Database\Database;
    use Framework\Database\MySQL;

    $database = new MySQL;
    Database::connect($database);

    define('BASEPATH', '/');

    Route::get('/', [App\Controllers\ExampleController::class, 'index']);
    
    Route::run();
}

