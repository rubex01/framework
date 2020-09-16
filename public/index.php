<?php

namespace {
    include __DIR__ . '/../Framework/autoload.php';

    use Framework\Routing\Route as Route;  
    use Framework\Database\Database;
    use Framework\Database\MySQL;

    $database = new MySQL;
    Database::connect($database);

    define('BASEPATH', '/');

    Route::get('/hello/(.*)', [App\Controllers\TestController::class, 'renderPage'])
        ->middleware(['auth']);


    Route::post('/test', [App\Controllers\TestController::class, 'test'])
        ->disableCSRF()
        ->middleware(['auth']);

    Route::post('/tes2t', [App\Controllers\TestController::class, 'test'])
        // ->disableCSRF()
        ->middleware(['auth']);

    Route::run();
}

