<?php
use Controllers\Api\Vacancy\Vacancy;
use FastRoute\RouteCollector;

function vacancyRoutes(RouteCollector $routesList) {
    $routesList->get('/', fn($vars) => Vacancy::show());
}