<?php

use FastRoute\RouteCollector;

// require_once "controllers/api/Auth/routes.php";
// require_once "controllers/api/Vacancy/routes.php";
require_once "controllers/api/Promo/routes.php";


function appRoutes(RouteCollector $routesList) {
    // $routesList->addGroup('/auth', function (RouteCollector $routesList) {
    //     authRoutes($routesList);
    // });

    // $routesList->addGroup('/vacancy', function (RouteCollector $routesList) {
    //     vacancyRoutes($routesList);
    // });
     $routesList->addGroup('', function (RouteCollector $routesList) {
        promoRoutes($routesList);
    });
}