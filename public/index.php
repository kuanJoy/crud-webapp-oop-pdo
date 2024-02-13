<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Router\Router;

$router = new Router();

$router->addRoute('GET', '/', 'views/home.php');
$router->addRoute('GET', '/login', 'views/login.php');
$router->addRoute('POST', '/login', 'views/login.php');
$router->addRoute('GET', '/register', 'views/register.php');
$router->addRoute('POST', '/register', 'views/register.php');




$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
