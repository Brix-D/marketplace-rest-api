<?php


namespace Services;


class Router
{
    private static $routesList = [];

    private function __construct() {}

    public static function action() {
        $uri = self::getRequestUri();
        self::navigate($uri);
    }

    private static function getRequestUri() {
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

    public static function page(string $uri, string $controllerName) {
        self::$routesList[] = [
            'uri' => $uri,
            'controller' => $controllerName,
        ];
    }

    public static function use(string $namespace, array $routes) {

    }

    public static function navigate(string $uri) {
        $routeFound = false;
        foreach (self::$routesList as $route) {
            if ($route['uri'] === '/' . $uri) {
                try {
                    $controller = new $route['controller']();
                    if (method_exists($controller, 'action')) {
                        $controller->action();
                    } else {
                        die('controller has not such method');
                    }
                } catch (\Error $error) {
                    die('class is not exist ' . $error->getMessage());
                }
                $routeFound = true;
                break;
            }
        }
        if (!$routeFound) {
            header('Content-Type: application/json');
            //header('HTTP/1.0 404 Not Found');
            http_response_code(404);
            echo json_encode(['status' => 404, 'message' => 'Page not found']);
        }
    }
}