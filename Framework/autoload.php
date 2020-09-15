<?php

spl_autoload_register(function ($className) {

    $extension = '.php';

    $fullPath =  $className . $extension;

    include_once __DIR__ . '/../' . $fullPath;

    if (method_exists($className, 'init')) {
        $className::init();
    }
});
