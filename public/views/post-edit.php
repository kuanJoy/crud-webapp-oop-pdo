<?php

use App\App\Controllers\VerificationController;
use App\App\Controllers\PostController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();
$verification->redirectGuest();

$post = new PostController();
if ($getPostValues = $post->getPostForEdit()) {
    $errors = $post->updatePost();
}

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";
include __DIR__ . "/include/post-edit.php";
include __DIR__ . "/layout/footer.php";
