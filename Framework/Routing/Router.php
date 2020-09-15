<?php

namespace Framework\Routing;

use App\Config;
use Framework\Request\Request;
use ReflectionClass;

class Router
{
    protected static $routes = [];

    protected static $currentRoute;

    protected static $pathNotFound = null;

    protected static $methodNotAllowed = null;

    private static $pathMatchFound = false;

    private static $routeMatchFound = false;

    private static $request;

    private static $basepath = BASEPATH;

    public static function addRoute(string $expression, $function, string $method = 'get')
    {
        if (is_array($function)) {
            $function = [
                'class' => $function[0],
                'method' => $function[1]
            ];
        }

        self::$routes[] = [
            'expression' => $expression,
            'function' => $function,
            'method' => $method
        ];

        self::$currentRoute = [
            'expression' => $expression,
            'function' => $function,
            'method' => $method
        ];
    }

    public static function run()
    {
        self::$request = new Request();

        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);

        if (isset($parsedUrl['path'])) {
            $path = $parsedUrl['path'];
        } else {
            $path = '/';
        }

        self::runFunctionForRoute($path);
    }

    private static function runFunctionForRoute (string $path)
    {
        $basepath = self::$basepath;

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {

            if ($basepath != '' && $basepath != '/') {
                $route['expression'] = '(' . $basepath . ')' . $route['expression'];
            }

            $route['expression'] = '^' . $route['expression'];
            $route['expression'] = $route['expression'] . '$';

            if (preg_match('#' . $route['expression'] . '#', $path, $matches)) {

                self::$pathMatchFound = true;

                if (strtolower($method) == strtolower($route['method'])) {
                    array_shift($matches);

                    if ($basepath != '' && $basepath != '/') {
                        array_shift($matches);
                    }

                    if (isset($route['middleware'])) {
                        self::runRouteMiddleware($route['middleware']);
                    }

                    $matches = self::urldecodeMatchesArray($matches);

                    if (is_array($route['function'])) {
                        self::runMethodRoute(
                            $route['function']['class'],
                            $route['function']['method'],
                            $matches
                        );
                    } else {
                        call_user_func_array($route['function'], $matches);
                    }

                    self::$routeMatchFound = true;

                    break;
                }
            }
        }

        if (!self::$routeMatchFound) {
            if (self::$pathMatchFound) {
                self::methodNotAllowed($path, $method);
            }
            else {
                self::pathNotFound($path, $method);
            }
        }
    }

    public static function methodNotAllowed($path, $method)
    {
        //todo:: give correct error w error handler
        echo 'Error 405 :-(<br>';
        echo 'The requested path "' . $path . '" exists. But the request method "' . $method . '" is not allowed on this path!';
        header('HTTP/1.0 405 Method Not Allowed');
    }


    public static function pathNotFound($path)
    {
        //todo:: give correct error w error handler
        echo 'Error 404 :-(<br>';
        echo 'The requested path "' . $path . '" was not found!';
        header('HTTP/1.0 404 Not Found');
    }

    private static function runMethodRoute(string $controller, string $methodName, array $matches)
    {
        $reflectionClass = new ReflectionClass($controller);
        $firstParam = $reflectionClass->getMethod('renderPage')->getParameters()[0]->getClass()->name;
        
        if ($firstParam === 'Framework\Request\Request') {
            array_unshift($matches, self::$request);
        }

        $routeClass = new $controller;
        $routeClass->$methodName(...$matches);
    }

    private function urldecodeMatchesArray(array $matches)
    {
        $newMatches = [];
        foreach ($matches as $match) {
            $newMatches[] = urldecode($match);
        }
        return $newMatches;
    }

    private function runRouteMiddleware(array $middlewareArray)
    {
        $allMiddleware = Config::$routeMiddleware;

        foreach ($middlewareArray as $middlewareString) {
            if (isset($allMiddleware[$middlewareString])) {
                $runMiddleware = new $allMiddleware[$middlewareString];
                if ($runMiddleware->handle() === false) {
                    $runMiddleware->onFailure();
                    exit();
                }
            }
            else {
                //todo:: give correct error w error handler
                echo 'error';
                exit();
            }
        }
    }

}