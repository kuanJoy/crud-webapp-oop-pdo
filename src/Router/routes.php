<?php

use App\Router\Router;

// require_once 'Router.php';

$router = new Router();
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

$router->addRoute('GET', '/admin', 'views/admin.php');
$router->addRoute('POST', '/admin', 'views/admin.php');


// POST SHOW BY ID
$router->addRoute('GET', "/post/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/post.php";
});
$router->addRoute('POST', "/post/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/post.php";
});

//  POST EDIT BY ID
$router->addRoute('GET', "/edit/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/post-edit.php";
});
$router->addRoute('POST', "/edit/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/post-edit.php";
});

// POST/EDIT/ID
$router->addRoute('GET', '/post-edit', 'views/posts-edit.php');
$router->addRoute('POST', '/post-edit', 'views/posts-edit.php');

// CATEGORY/ID
$router->addRoute('GET', "/category/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/category.php";
});

// POPULAR
$router->addRoute('GET', '/popular', 'views/popular.php');

// FAVOURITE
$router->addRoute('GET', "/favourite/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/favourite.php";
});

// USERS POST
$router->addRoute('GET', "/user/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/user.php";
});


// SHOW POSTS BY HASHTAG
$router->addRoute('GET', "/hashtag/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/hashtag.php";
});


$router->addRoute('GET', "/edit-user/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/edit-user.php";
});
$router->addRoute('POST', "/edit-user/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/edit-user.php";
});

$router->addRoute('GET', "/edit-cat/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/edit-cat.php";
});
$router->addRoute('POST', "/edit-cat/{$id}", function ($id) {
    include_once __DIR__ . "/../../public/views/edit-cat.php";
});
