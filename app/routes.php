<?php

use Services\Router;
use Controllers\Index;

require_once "controllers/api/Auth/routes.php";

Router::use('/auth', $routes);
//Router::page('/', fn() => Index::action());