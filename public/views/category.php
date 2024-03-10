<?php

use App\App\Controllers\PostController;
use App\App\Controllers\VerificationController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();

$post = new PostController();
$posts = $post->getPostsByCategory();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";

$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$_SESSION['lastCategory'] = $currentUrl;

if (!empty($posts)) {
    include __DIR__ . "/include/category.php";
} else {
    $title = "Категории";
    include __DIR__ . "/include/not-found.php";
}
include __DIR__ . "/layout/footer.php";
