<?php
echo "<br>";
echo "404 | Страница не найдена";
echo "<br>";


use App\App\Controllers\VerificationController;

$verification = new VerificationController();
$verification->redirectToVerifyEmail();
