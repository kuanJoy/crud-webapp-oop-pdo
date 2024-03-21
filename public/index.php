<?php
ini_set('session.gc_maxlifetime', 90 * 24 * 60 * 60);
session_start();

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../src/config/config.php";

use App\Router\Router;

$router = new Router();

require_once __DIR__ . "/../src/Router/routes.php";

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
