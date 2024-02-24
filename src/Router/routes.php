<?php
$router->addRoute('GET', '/', 'views/home.php');
$router->addRoute('POST', '/', 'views/home.php');
$router->addRoute('GET', '/login', 'views/login.php');
$router->addRoute('POST', '/login', 'views/login.php');
$router->addRoute('GET', '/register', 'views/register.php');
$router->addRoute('POST', '/register', 'views/register.php');
