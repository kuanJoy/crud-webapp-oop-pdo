<?php

use App\App\Controllers\VerificationController;
use App\App\Controllers\PostController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();
$verification->redirectGuest();

$post = new PostController();
$errors = $post->createPost();
$errorsCat = $post->createCategory();

var_dump($errorsCat);

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";
include __DIR__ . "/include/post-create.php";
include __DIR__ . "/layout/footer.php";
