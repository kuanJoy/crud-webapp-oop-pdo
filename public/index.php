<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../src/config/config.php";
// require_once __DIR__ . "/../src/config/functions.php";

use App\Router\Router;

$router = new Router();

require_once __DIR__ . "/../src/router/routes.php";

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
