<?php
use Services\router\Router;
use Models\Database;
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/app/utils/dump.php";
$db = new Database();

require_once __DIR__ . "/app/routes.php";

Router::action();