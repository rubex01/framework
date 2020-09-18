<?php

if (getenv('ENVIRONMENT') === 'production' && getenv('DEBUGGING') == false || getenv('DEBUGGING') == false) {
    error_reporting(0);
}

if (file_exists(__DIR__ . '/../.env.php')) {
    include __DIR__ . '/../.env.php';
    foreach ($variables as $key => $value) {
        putenv("$key=$value");
    }
}

spl_autoload_register(function ($className) {

    $extension = '.php';

    $fullPath =  $className . $extension;

    include_once __DIR__ . '/../' . $fullPath;

    if (method_exists($className, 'init')) {
        $className::init();
    }
});
