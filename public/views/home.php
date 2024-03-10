<?php

use App\App\Controllers\VerificationController;
use App\App\Controllers\PostController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();

$posts = new PostController();
$bannerPosts = $posts->getPostsForBanner();
$hashtags = $posts->getHashtagsForMain();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";
include __DIR__ . "/include/banner.php";
include __DIR__ . "/include/hashtags.php";
include __DIR__ . "/include/random.php";
include __DIR__ . "/layout/footer.php";
