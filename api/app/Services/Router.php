<?php


namespace Services;

use Controllers\Index;

class Router
{
    private static array $routesList = [];

    private function __construct()
    {
    }

    public static function action()
    {
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

    public static function page(string $method, string $uri, callable $controllerAction)
    {
        self::$routesList[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controllerAction,
        ];
    }

    public static function use(string $namespace, array $routes)
    {
        foreach ($routes as $route) {
            self::page($route['method'], $namespace . $route['uri'], $route['controller']);
        }
    }

    public static function navigate(string $uri)
    {
            $routeFound = false;
            foreach (self::$routesList as $route) {
                if ($route['uri'] === '/' . $uri) {
//                try {
//                    $controller = new $route['controller']();
//                    if (method_exists($controller, 'action')) {
//                        $controller->action();
//                    } else {
//                        die('controller has not such method');
//                    }
//                } catch (\Error $error) {
//                    die('class is not exist ' . $error->getMessage());
//                }
                    $controller = $route['controller'];
                    $requestMethod = $route['method'];
                    if (is_callable($controller)) {
                        if ($requestMethod === $_SERVER['REQUEST_METHOD']) {
                            $controller();
                            $routeFound = true;
                            break;
                        }
                    }

                }
            }
            if (!$routeFound) {
                new Response(404, message: 'Page not found');
            }
    }

}