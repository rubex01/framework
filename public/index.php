<?php

namespace {

    include __DIR__ . '/../Framework/autoload.php';

    use Framework\Auth\Auth;
    use Framework\Routing\Route;
    use App\Config;

    if (Config::$enabledFunctions['authorization']) {
        $Authorization = new Auth();
    }

    // Database connections
    include __DIR__ . '/../Web/DBConnections.php';

    // Include the web routes
    include __DIR__ . '/../Web/Routes.php';

    Route::run();

}

