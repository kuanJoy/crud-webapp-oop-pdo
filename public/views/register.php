<?php

use App\Controllers\AuthController;

// require_once __DIR__ . '/../../src/app/controllers/AuthController.php';
// require_once __DIR__ . '/../../src/app/models/AuthModel.php';

$authController = new AuthController();
$authController->regUser();

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";
include __DIR__ . "/include/register-form.php";
include __DIR__ . "/layout/footer.php";
