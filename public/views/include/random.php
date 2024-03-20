<?php

use App\App\Controllers\PostController;

$post = new PostController();
$randomPosts = $post->getRandomPosts();

?>

<div class="random-container" style="background-color: inherit;">
    <h3 class="random__title">Случайные статьи <svg class="icon i-category">
            <use href="/public/assets/images/svg/sprites.svg#random" />
        </svg></h3>
    <div class="random__rows" style="margin-top: 2rem; overflow-y: inherit; max-height: 17.5rem;">
        <?php foreach ($randomPosts as $post) : ?>
            <div class="random__card">
                <img src=" /public/<?= $post['pic'] ?>" alt="">
                <div class="r_card__content" style="background-color: #f0f2fa;">
                    <h3 class="r_card__title"><?= $post['title'] ?></h3>
                    <div class="r_card__row">
                        <a href="/user/<?= $post['user_id'] ?>" class="r_card__auth" style="cursor: pointer; background-color: white"><?= $post['user_nickname'] ?></a>
                        <div class="attribute__likes" style="background-color: white">
                            <span><?= $post['like_count'] ?></span>
                            <span class="btn-post">
                                <svg class="icon i-like">
                                    <use href="/public/assets/images/svg/sprites.svg#like" />
                                </svg>
                            </span>
                        </div>
                        <span class="r_card__time"><?= substr(strval($post['created_time']), 0, 10) ?></span>
                    </div>
                    <a href="/post/<?= $post['post_id'] ?>" class="btn read-more">Читать</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>