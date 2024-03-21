<?php

use App\App\Controllers\VerificationController;
use App\App\Controllers\PostController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();



$post = new PostController();
$categoriesCount = $post->getCategoriesCount();
$hashtagsCount = $post->getHashtagsCount();
$topUsers = $post->getTopUsers();

$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$_SESSION['lastCategory'] = $currentUrl;

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";
include __DIR__ . "/include/popular.php";
include __DIR__ . "/layout/footer.php";
