<?php
use Controllers\Api\Auth\Auth;

$routes = [
    ['method' => 'GET', 'uri'=> '/login', 'controller' => fn() => Auth::login()],
    ['method' => 'POST', 'uri'=> '/register', 'controller' => fn() => Auth::register()],
    ['method' => 'GET', 'uri'=> '/show', 'controller' => fn() => Auth::show()]
];