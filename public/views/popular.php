<?php

use App\App\Controllers\VerificationController;
use App\App\Controllers\PostController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();

$post = new PostController();
$categoriesCount = $post->getCategoriesCount();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";
include __DIR__ . "/include/popular.php";
include __DIR__ . "/layout/footer.php";
