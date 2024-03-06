<?php

// use App\Router\Router;

// require_once 'Router.php';

// $router = new Router();

$router->addRoute('GET', '/', 'views/home.php');
$router->addRoute('POST', '/', 'views/home.php');
$router->addRoute('GET', '/login', 'views/login.php');
$router->addRoute('POST', '/login', 'views/login.php');
$router->addRoute('GET', '/register', 'views/register.php');
$router->addRoute('POST', '/register', 'views/register.php');
$router->addRoute('GET', '/verify', 'views/verify.php');
$router->addRoute('POST', '/verify', 'views/verify.php');
$router->addRoute('GET', '/forget', 'views/forget.php');
$router->addRoute('POST', '/forget', 'views/forget.php');
$router->addRoute('GET', '/reset', 'views/reset.php');
$router->addRoute('POST', '/reset', 'views/reset.php');
