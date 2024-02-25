<?php
echo "404 | Страница не найдена";

use App\App\Controllers\VerificationController;

$verifyEmail = new VerificationController();
$verifyEmail->redirectToVerifyEmail();
