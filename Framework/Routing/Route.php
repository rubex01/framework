<?php

namespace Framework\Routing;

use Framework\Routing\Router;

class Route extends Router
{
    public static function get($path, $function)
    {
        self::addRoute($path, $function, 'get');
        return new static;
    }

    public static function post($path, $function)
    {
        self::addRoute($path, $function, 'post');
        return new static;
    }

    public static function put($path, $function)
    {
        self::addRoute($path, $function, 'put');
        return new static;
    }

    public static function patch($path, $function)
    {
        self::addRoute($path, $function, 'patch');
        return new static;
    }

    public static function delete($path, $function)
    {
        self::addRoute($path, $function, 'delete');
        return new static;
    }

    public static function options($path, $function)
    {
        self::addRoute($path, $function, 'options');
        return new static;
    }

    public static function middleware(array $middlewareArray) {
        $key = array_search(self::$currentRoute, self::$routes);
        foreach ($middlewareArray as $middleware) {
            self::$routes[$key]['middleware'][] = $middleware;
        }
    }    
}