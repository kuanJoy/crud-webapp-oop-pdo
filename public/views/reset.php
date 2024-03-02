<?php

use App\App\Controllers\VerificationController;
use App\App\Controllers\PasswordController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();
$verification->redirectUser();

$passwordReset = new PasswordController;
var_dump($passwordReset->sendLink());


include __DIR__ . "/layout/header.php";
include __DIR__ . "/include/reset.php";
include __DIR__ . "/layout/footer.php";
