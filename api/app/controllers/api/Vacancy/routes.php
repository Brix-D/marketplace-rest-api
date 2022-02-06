<?php
use Controllers\Api\Vacancy\VacancyController;
use FastRoute\RouteCollector;

function vacancyRoutes(RouteCollector $routesList) {
    $routesList->get('', fn($vars) => VacancyController::show());
}