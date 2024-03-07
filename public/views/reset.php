<?php

use App\App\Controllers\VerificationController;
use App\App\Controllers\PasswordController;

$verification = new VerificationController();
$verification->redirectIfNoToken();

$password = new PasswordController;
$errors = $password->checkToken();
$errors_sendLink = $password->sendLink();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/include/reset.php";
include __DIR__ . "/layout/footer.php";
