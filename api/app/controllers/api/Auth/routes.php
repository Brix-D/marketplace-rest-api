<?php
use Controllers\Api\Auth\Auth;
use FastRoute\RouteCollector;

function authRoutes(RouteCollector $routesList) {
    $routesList->get('/login', fn($vars) => Auth::login());
    $routesList->post('/register', fn($vars) => Auth::register());
    $routesList->get('/users', fn($vars) => Auth::showUsers());
    $routesList->get('/user/{id:\d+}', fn($vars) => Auth::findUser($vars));
}