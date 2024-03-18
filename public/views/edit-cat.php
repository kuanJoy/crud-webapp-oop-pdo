<?php

use App\App\Controllers\VerificationController;
use App\App\Controllers\PostController;

$verification = new VerificationController();
$verification->redirectIfNotAdmin();

$post = new PostController();
if ($value = $post->getCatForEdit()) {
    $errors = $post->updateCat();
}

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/navbar.php";
if (!empty($value)) {
    include __DIR__ . "/include/edit-cat.php";
}
include __DIR__ . "/layout/footer.php";
