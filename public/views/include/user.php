<div class="random-container">
    <?php if (!empty($userPosts)) : ?>
        <h3 class="random__title">Публикации <?= $userPosts[0]['user_nickname'] ?> <svg class="icon i-category">
                <use href="/public/assets/images/svg/sprites.svg#posts" />
            </svg></h3>
        <div class="random__rows" style="margin-top: 2rem;">
            <?php foreach ($userPosts as $post) : ?>
                <div class="random__card">
                    <img src="/public/<?= $post['pic'] ?>" alt="">
                    <div class="r_card__content">
                        <h3 class="r_card__title"><?= $post['title'] ?></h3>
                        <div class="r_card__row">
                            <div class="attribute__likes">
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
    <?php else : ?>
        <div style="display: flex; align-items: center;">
            <p style="min-width: 150px; color: red;">Список пуст</p>
            <a class="dropdown-item" href="/create-post" style="margin: 0 auto; padding-right: 2rem">
                <svg class="icon i-category">
                    <use href="/public/assets/images/svg/sprites.svg#add" />
                </svg>Добавить статью</a></li>
        </div>
    <?php endif; ?>
</div>