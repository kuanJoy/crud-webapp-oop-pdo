<?php
session_start();

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../src/config/config.php";

use App\Router\Router;

$router = new Router();

require_once __DIR__ . "/../src/Router/routes.php";

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

echo "<pre>";
var_dump($_SESSION);
// echo "<br>";
// var_dump($_GET);
// echo "<br>";
// var_dump($_POST);
// echo "<br>";
// var_dump($_SERVER);
echo "</pre>";
