<?php

use App\App\Controllers\VerificationController;
use App\App\Controllers\PostController;

$verification = new VerificationController();
$verification->redirectIfNotAdmin();

$post = new PostController();
if ($value = $post->getUserForEdit()) {
    $errors = $post->updateUser();
}

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";
if (!empty($value)) {
    include __DIR__ . "/admin/edit-user.php";
}
include __DIR__ . "/layout/footer.php";
