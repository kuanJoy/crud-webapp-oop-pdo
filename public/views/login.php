<?php

use App\App\Controllers\AuthController;

$authController = new AuthController();
$errors = $authController->login();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";
include __DIR__ . "/include/login-form.php";
include __DIR__ . "/layout/footer.php";
