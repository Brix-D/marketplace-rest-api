<?php

namespace Services;

use FastRoute;
use FastRoute\RouteCollector;
use FastRoute\Dispatcher;

class Router
{
    # private static array $routesList = [];

    private static Dispatcher $dispatcher;

    private function __construct()
    {
    }

    public static function action()
    {
        self::$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $routesList) {
            appRoutes($routesList);
        });
        $uri = self::getRequestUri();
        self::navigate($uri);
    }

    private static function getRequestUri()
    {
        if (isset($_GET['route'])) {
            $request = $_GET['route'];
        } else {
            $request = "";
        }
        return $request;
    }

//    private static function splitUri(string $uri) : array {
//        return explode('/', $uri);
//    }

//    public static function page(string $method, string $uri, callable $controllerAction)
//    {
//        self::$routesList[] = [
//            'method' => $method,
//            'uri' => $uri,
//            'controller' => $controllerAction,
//        ];
//    }
//
//    public static function use(string $namespace, array $routes)
//    {
//        foreach ($routes as $route) {
//            self::page($route['method'], $namespace . $route['uri'], $route['controller']);
//        }
//    }

    public static function navigate(string $uri)
    {
//            $routeFound = false;
//            foreach (self::$routesList as $route) {
//                if ($route['uri'] === '/' . $uri) {
////                try {
////                    $controller = new $route['controller']();
////                    if (method_exists($controller, 'action')) {
////                        $controller->action();
////                    } else {
////                        die('controller has not such method');
////                    }
////                } catch (\Error $error) {
////                    die('class is not exist ' . $error->getMessage());
////                }
//                    $controller = $route['controller'];
//                    $requestMethod = $route['method'];
//                    if (is_callable($controller)) {
//                        if ($requestMethod === $_SERVER['REQUEST_METHOD']) {
//                            $controller();
//                            $routeFound = true;
//                            break;
//                        }
//                    }
//
//                }
//            }
//            if (!$routeFound) {
//                new Response(404, message: 'Page not found');
//            }
        $uri = '/' . rawurldecode($uri);
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $route = self::$dispatcher->dispatch($httpMethod, $uri);
        switch ($route[0]) {
            case Dispatcher::NOT_FOUND:
                new Response(404, message: 'Page not found');
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $route[1];
                new Response(code: 405,  data: $allowedMethods, message: 'Method Not Allowed',);
                break;
            case Dispatcher::FOUND:
                $handler = $route[1];
                $vars = $route[2];
                // ... call $handler with $vars
                $handler($vars);
                break;
        }
    }

}