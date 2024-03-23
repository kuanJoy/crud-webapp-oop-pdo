<?php
session_set_cookie_params(2592000);
ini_set('session.gc_maxlifetime', 2592000);
session_start([
    'cookie_lifetime' => 2592000,
    'gc_maxlifetime' => 2592000,
]);

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../src/config/config.php";

use App\Router\Router;

$router = new Router();

require_once __DIR__ . "/../src/Router/routes.php";

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
