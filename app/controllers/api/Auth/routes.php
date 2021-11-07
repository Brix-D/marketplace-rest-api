<?php
use Controllers\Api\Auth\Auth;

$routes = [
    ['uri'=> '/login', 'controller' => fn() => Auth::login()],
    ['uri'=> '/register', 'controller' => fn() => Auth::register()],
    ['uri'=> '/show', 'controller' => fn() => Auth::show()]
];