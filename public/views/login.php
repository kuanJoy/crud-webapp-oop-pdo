<?php
session_start();

use App\App\Controllers\AuthController;
use App\App\Controllers\VerificationController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();
$verification->redirectUser();

$authController = new AuthController();
$errors = $authController->login();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/include/login-form.php";
include __DIR__ . "/layout/footer.php";
