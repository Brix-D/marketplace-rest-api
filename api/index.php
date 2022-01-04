<?php
use Services\Router;
use Models\Database;
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/config.php";

$db = new Database();

require_once __DIR__ . "/app/routes.php";

Router::action();