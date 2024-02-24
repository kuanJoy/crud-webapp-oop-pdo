<?php
session_start();

use App\App\Controllers\AuthController;
use App\App\Controllers\SessionController;

$authController = new AuthController();
$errors = $authController->login();

$sessionController = new SessionController();
$sessionController->redirect();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";
include __DIR__ . "/include/login-form.php";
include __DIR__ . "/layout/footer.php";
