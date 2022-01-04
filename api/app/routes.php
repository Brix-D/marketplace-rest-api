<?php

use Services\Router;

require_once "controllers/api/Auth/routes.php";

Router::use('/auth', $routes);