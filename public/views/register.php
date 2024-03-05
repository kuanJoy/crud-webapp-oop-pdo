<?php

use App\App\Controllers\AuthController;
use App\App\Controllers\VerificationController;

$authController = new AuthController();
$errors = $authController->register();

$verification = new VerificationController();
$verification->redirectToVerifyEmail();
$verification->redirectUser();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/include/register-form.php";
include __DIR__ . "/layout/footer.php";
