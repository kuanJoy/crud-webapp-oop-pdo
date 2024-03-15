<?php

use App\App\Controllers\VerificationController;
use App\App\Controllers\PostController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();

$post = new PostController();
$posts = $post->getPostsByHashtag();
$hashtags = $post->getHashtagsForMain();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";
include __DIR__ . "/include/hashtags.php";
include __DIR__ . "/include/hashtag.php";
include __DIR__ . "/layout/footer.php";
