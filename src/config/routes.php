<?php

use App\Router\Route;

// в ключе, в качестве значения может хранить результат анонимную функцию
return [
    Route::get('/', function () {
        include_once "index.php";
    }),
    Route::get('/views/pages/login', function () {
        include_once "views/pages/login.php";
    }),
    Route::get('/views/pages/register', function () {
        include_once "views/pages/register.php";
    }),
];
