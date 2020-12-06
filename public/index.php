<?php

namespace {

    /*
    |--------------------------------------------------------------------------
    | Include autoloading script
    |--------------------------------------------------------------------------
    |
    | This is the autoloading script of the framework. It autoloads all the
    | classes that you use in your namespaces. It also handles the composer
    | vendor autoloader.
    |
    */
    include __DIR__ . '/../Framework/autoload.php';

    /*
    |--------------------------------------------------------------------------
    | Ignite the framework
    |--------------------------------------------------------------------------
    |
    | This provides the autocompiling of templating files, handles environment
    | variables and more...
    |
    */
    include __DIR__ . '/../Framework/bootstrap.php';

    use Framework\Auth\Auth;
    use Framework\Routing\Route;
    use App\Config;

    /*
    |--------------------------------------------------------------------------
    | Database connections
    |--------------------------------------------------------------------------
    |
    | Register all the database connections from the user.
    |
    */
    include __DIR__ . '/../Web/DBConnections.php';

    if (Config::$enabledFunctions['authorization']) {
        $Authorization = new Auth();
    }

    /*
    |--------------------------------------------------------------------------
    | Include all the routes
    |--------------------------------------------------------------------------
    |
    | This file contains all the routes of the application.
    |
    */
    include __DIR__ . '/../Web/Routes.php';

    /*
    |--------------------------------------------------------------------------
    | Run the routes
    |--------------------------------------------------------------------------
    */
    Route::run();

    /*
    |--------------------------------------------------------------------------
    | Exit framework
    |--------------------------------------------------------------------------
    */
    include __DIR__ . '/../Framework/shutdown.php';

}

