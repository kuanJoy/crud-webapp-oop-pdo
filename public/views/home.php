<?php
session_start();

use App\App\Controllers\VerificationController;

$verifyEmail = new VerificationController();
$verifyEmail->redirectToVerifyEmail();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";
include __DIR__ . "/include/banner.php";
include __DIR__ . "/include/hashtags.php";
include __DIR__ . "/layout/footer.php";
