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

    public static function page(string $uri, callable $controllerAction)
    {
        self::$routesList[] = [
            'uri' => $uri,
            'controller' => $controllerAction,
        ];
    }

    public static function use(string $namespace, array $routes)
    {
        foreach ($routes as $route) {
            self::page($namespace . $route['uri'], $route['controller']);
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
                    if (is_callable($controller)) {
                        $controller();
                    }
                    $routeFound = true;
                    break;
                }
            }
            if (!$routeFound) {
                new Response(404, message: 'Page not found');
            }
    }

}