<?php
session_start();

use App\App\Controllers\AuthController;
use App\App\Controllers\VerificationController;

$authController = new AuthController();
$errors = $authController->login();

$verification = new VerificationController();
$verification->redirectToVerifyEmail();
$verification->redirectUser();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/include/login-form.php";
include __DIR__ . "/layout/footer.php";
