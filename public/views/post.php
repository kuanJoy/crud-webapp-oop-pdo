<?php

use App\App\Controllers\PostController;
use App\App\Controllers\VerificationController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();

$post = new PostController();
$onePost = $post->getPostById();

var_dump($onePost);

include __DIR__ . "/layout/header.php";
include __DIR__ . "/include/post-show.php";
include __DIR__ . "/layout/footer.php";
