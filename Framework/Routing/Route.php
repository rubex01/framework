<?php

namespace Framework\Routing;

use Framework\Routing\Router;

class Route extends Router
{
    /**
     * Add get method route
     * 
     * @param string $path
     * @param $function
     * @return object
     */
    public static function get($path, $function) : object
    {
        self::addRoute($path, $function, 'get');
        return new static;
    }

    /**
     * Add post method route
     * 
     * @param string $path
     * @param $function
     * @return object
     */
    public static function post($path, $function) : object
    {
        self::addRoute($path, $function, 'post');
        return new static;
    }

    /**
     * Add put method route
     * 
     * @param string $path
     * @param $function
     * @return object
     */
    public static function put($path, $function) : object
    {
        self::addRoute($path, $function, 'put');
        return new static;
    }

    /**
     * Add patch method route
     * 
     * @param string $path
     * @param $function
     * @return object
     */
    public static function patch($path, $function) : object
    {
        self::addRoute($path, $function, 'patch');
        return new static;
    }

    /**
     * Add delete method route
     * 
     * @param string $path
     * @param $function
     * @return object
     */
    public static function delete($path, $function) : object
    {
        self::addRoute($path, $function, 'delete');
        return new static;
    }

    /**
     * Add options method route
     * 
     * @param string $path
     * @param $function
     * @return object
     */
    public static function options($path, $function) : object
    {
        self::addRoute($path, $function, 'options');
        return new static;
    }

    /**
     * Add middleware to route
     * 
     * @param array $middlewareArray
     * @return void
     */
    public static function middleware(array $middlewareArray) : void
    {
        $key = array_search(self::$currentRoute, self::$routes);
        foreach ($middlewareArray as $middleware) {
            self::$routes[$key]['middleware'][] = $middleware;
        }
    }    
}