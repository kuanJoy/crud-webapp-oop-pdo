<div class="random-container">
    <div style="display: flex; align-items: center;">
        <a style="display: flex;" href="/popular">
            <button type="submit">
                <svg class="auth__icon">
                    <use href="/public/assets/images/svg/sprites.svg#back"></use>
                </svg>назад
            </button>
        </a>
        <h3 class="random__title" style="margin: 0 auto; padding-right: 2rem">
            <?= $posts[0]['name'] ?>
            <svg class="icon-big">
                <use href="/public/assets/images/svg/sprites.svg#folder" />
            </svg>
        </h3>
    </div>
    <div class="random__rows" style="margin-top: 2rem;">
        <?php foreach ($posts as $post) : ?>
            <div class="random__card">
                <img src="/public/<?= $post['pic'] ?>" alt="">
                <div class="r_card__content">
                    <h3 class="r_card__title"><?= $post['title'] ?></h3>
                    <div class="r_card__row">
                        <a href="/user/<?= $post['user_id'] ?>" class="r_card__auth" style="cursor: pointer;"><?= $post['user_nickname'] ?></a>
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
</div>