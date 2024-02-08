<?php

declare(strict_types=1);

require_once  '../vendor/autoload.php';

use App\Router;

$router = new Router();

$router->get('/', function () {
    echo "Главная";
});

$router->get('/register', function () {
    echo "Регистрация";
});

$router->addNotFoundHandler(function () {
    require_once __DIR__ . "/pages/404.php";
});

$router->run();
