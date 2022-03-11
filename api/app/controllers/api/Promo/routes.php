<?php
use Controllers\Api\Promo\PromoController;
use FastRoute\RouteCollector;

function promoRoutes(RouteCollector $routesList) {
    // $routesList->get('/login', fn($vars) => Auth::login());
    // $routesList->post('/register', fn($vars) => Auth::register());
    // $routesList->get('/users', fn($vars) => Auth::showUsers());
    // $routesList->get('/user/{id:\d+}', fn($vars) => Auth::findUser($vars));
    $routesList->get('/promo', fn($vars) => PromoController::allPromos());
    $routesList->post('/promo', fn($vars) => PromoController::addPromo());
    $routesList->get('/promo/{id:\d+}', fn($vars) => PromoController::showPromo($vars));
    $routesList->put('/promo/{id:\d+}', fn($vars) => PromoController::editPromo($vars));
    $routesList->delete('/promo/{id:\d+}', fn($vars) => PromoController::deletePromo($vars));
}