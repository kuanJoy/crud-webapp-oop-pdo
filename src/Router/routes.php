<?php

// use App\Router\Router;

// require_once 'Router.php';

// $router = new Router();
$id = '{id}';

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

$router->addRoute('GET', '/create-post', 'views/post-create.php');
$router->addRoute('POST', '/create-post', 'views/post-create.php');

// POST/ID
$router->addRoute('GET', "/post/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/post.php";
});
$router->addRoute('POST', "/post/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/post.php";
});
$router->addRoute('GET', "/post", 'views/post.php');

// POST/EDIT/ID
$router->addRoute('GET', '/edit-post', 'views/posts-edit.php');
$router->addRoute('POST', '/edit-post', 'views/posts-edit.php');

// CATEGORY/ID
$router->addRoute('GET', "/category/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/category.php";
});

// POPULAR
$router->addRoute('GET', '/popular', 'views/popular.php');
