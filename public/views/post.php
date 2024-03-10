<?php

use App\App\Controllers\PostController;
use App\App\Controllers\VerificationController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();

$post = new PostController();
$onePost = $post->getPostById();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";

if (!$onePost['post'] == false) {
    include __DIR__ . "/include/post-show.php";
} else {
    include __DIR__ .
        "/include/post-not-found.php";
}
include __DIR__ . "/layout/footer.php";
