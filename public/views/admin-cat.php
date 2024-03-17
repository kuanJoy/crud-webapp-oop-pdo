<?php

use App\App\Controllers\AuthController;
use App\App\Controllers\VerificationController;

$verification = new VerificationController();
$verification->redirectIfNotAdmin();
$verification->redirectToVerifyEmail();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";
include __DIR__ . "/admin/category.php";
include __DIR__ . "/layout/footer.php";
