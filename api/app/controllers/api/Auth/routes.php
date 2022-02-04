<?php
use Controllers\Api\Auth\Auth;
use FastRoute\RouteCollector;

function authRoutes(RouteCollector $routesList) {
    $routesList->get('/login', fn($vars) => Auth::login());
    $routesList->post('/register', fn($vars) => Auth::register());
    $routesList->get('/user', fn($vars) => Auth::showUsers());
    $routesList->get('/user/{id:\d+}', fn($vars) => Auth::findUser($vars));
}

//$routes = [
//    ['method' => 'GET', 'uri'=> '/login', 'controller' => fn() => Auth::login()],
//    ['method' => 'POST', 'uri'=> '/register', 'controller' => fn() => Auth::register()],
//    ['method' => 'GET', 'uri'=> '/show', 'controller' => fn() => Auth::show()]
//];