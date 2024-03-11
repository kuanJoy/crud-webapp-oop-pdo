<?php
echo "404 | Страница не найдена";


use App\App\Controllers\VerificationController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();
