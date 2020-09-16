<?php

namespace {
    include __DIR__ . '/../Framework/autoload.php';

    use Framework\Routing\Route as Route;  

    define('BASEPATH', '/');

    Route::get('/hello/(.*)', [App\Controllers\TestController::class, 'renderPage'])
        ->middleware(['auth']);


    Route::post('/test', [App\Controllers\TestController::class, 'test'])
        ->disableCSRF()
        ->middleware(['auth']);

    Route::run();
}

