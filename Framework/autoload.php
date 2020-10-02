<?php

// Decide if error reporting needs to be enabled
if (getenv('ENVIRONMENT') === 'production' && getenv('DEBUGGING') == false || getenv('DEBUGGING') == false) {
    error_reporting(0);
}

// Load in all the environment variables
if (file_exists(__DIR__ . '/../.env.php')) {
    include __DIR__ . '/../.env.php';
    foreach ($variables as $key => $value) {
        putenv("$key=$value");
    }
}

// Defining basepath of app
define('BASEPATH', getenv('BASEPATH'));


// Autoloading all classes
spl_autoload_register(function ($className) {

    $extension = '.php';

    $fullPath =  $className . $extension;

    $fullPath = str_replace('\\', '/', $fullPath);

    include_once __DIR__ . '/../' . $fullPath;

    if (method_exists($className, 'init')) {
        $className::init();
    }
});
