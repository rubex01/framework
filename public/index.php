<?php

namespace {
    include __DIR__ . '/../Framework/autoload.php';

    use Framework\Routing\Route as Route;
    use Framework\CSRF\CSRF;

    CSRF::checkCSRFtoken();

    define('BASEPATH', '/');

    Route::get('/hello/(.*)', [App\Controllers\TestController::class, 'renderPage'])
        ->middleware(['auth']);


    Route::post('/test', [App\Controllers\TestController::class, 'test'])
        ->middleware(['auth']);

    Route::run();
}

