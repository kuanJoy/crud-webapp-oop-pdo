<?php

use App\App\Controllers\AuthController;
use App\App\Controllers\PostController;
use App\App\Controllers\VerificationController;

$verification = new VerificationController();
$verification->redirectIfNotAdmin();

$post = new PostController();
$allTables = $post->getAdminTables();

$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$_SESSION['lastCategory'] = $currentUrl;

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";
include __DIR__ . "/admin/admin.php";
include __DIR__ . "/layout/footer.php";
