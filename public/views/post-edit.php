<?php

use App\App\Controllers\VerificationController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();
$verification->redirectGuest();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/include/post-edit.php";
include __DIR__ . "/layout/footer.php";
