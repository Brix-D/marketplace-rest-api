<?php

use FastRoute\RouteCollector;

require_once "controllers/api/Auth/routes.php";

#Router::use('/auth', $routes);

function appRoutes(RouteCollector $routesList) {
    $routesList->addGroup('/auth', function (RouteCollector $routesList) {
        authRoutes($routesList);
    });
}