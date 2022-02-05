<?php

namespace Services\router;

use FastRoute;
use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
use Services\responses\Error;

class Router
{

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

    public static function navigate(string $uri)
    {
        $uri = '/' . rawurldecode($uri);
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $route = self::$dispatcher->dispatch($httpMethod, $uri);
        switch ($route[0]) {
            case Dispatcher::NOT_FOUND:
               $response = new Error(404, message: 'Страница не найдена');
               $response->json();
               break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                // $allowedMethods = $route[1];
                $response = new Error(code: 405, message: 'Метод не доступен');
                $response->json();
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