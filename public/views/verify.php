<?php
session_start();

use App\App\Controllers\VerificationController;
use App\App\Controllers\SessionController;

$sessionTokenUpdate = new VerificationController;
$error = $sessionTokenUpdate->verifyEmailToken();

$sessionDestroy = new SessionController;
$sessionDestroy->logout();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/include/verify.php";
include __DIR__ . "/layout/footer.php";
