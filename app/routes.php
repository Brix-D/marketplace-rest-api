<?php

use Services\Router;
use Controllers\Index;

require_once "controllers/api/Auth/routes.php";

Router::page('/', fn() => Index::action());
Router::use('/api/auth', $routes);