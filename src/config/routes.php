<?php

use App\Router\Route;

// в ключе, в качестве значения может хранить результат анонимную функцию
return [
    Route::get('/', function () {
        include_once APP_PATH . "/index.php";
    }),
    Route::get('/login', function () {
        include_once APP_PATH . "/public/pages/login.php";
    }),
    Route::get('/register', function () {
        include_once APP_PATH . "/public/pages/register.php";
    }),
];
