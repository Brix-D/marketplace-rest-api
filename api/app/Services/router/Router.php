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
               Error::json(404, message: 'Страница не найдена');
               break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $route[1];
                $message = 'Метод не доступен. Доступные методы: ' . implode(', ', $allowedMethods);
                Error::json(405, message: $message);
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