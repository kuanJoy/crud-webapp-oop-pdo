<?php
include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";

use App\Controllers\AuthController;

$authController = new AuthController();
$authController->regUser();

include __DIR__ . "/include/register-form.php";
include __DIR__ . "/layout/footer.php";
