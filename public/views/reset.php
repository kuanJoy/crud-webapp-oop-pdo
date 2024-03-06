<?php

use App\App\Controllers\VerificationController;
use App\App\Controllers\PasswordController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();
$verification->redirectUser();

$password = new PasswordController;
$errors = $password->chechToken();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/include/reset.php";
include __DIR__ . "/layout/footer.php";
