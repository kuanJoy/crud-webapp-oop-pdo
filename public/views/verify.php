<?php

use App\App\Controllers\VerificationController;
use App\App\Controllers\SessionController;

$verification = new VerificationController;
$verification->redirectGuest();
$verification->redirectUser();
$error = $verification->verifyEmailToken();
$error_sendToken = $verification->sendToken();


$sessionDestroy = new SessionController;
$sessionDestroy->logout();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/include/verify.php";
include __DIR__ . "/layout/footer.php";
