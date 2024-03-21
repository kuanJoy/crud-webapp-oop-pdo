<div class="random-container">
    <?php if (!empty($favourites)) : ?>
        <h3 class="random__title">Избранное <?= $favourites[0]['username'] ?> <svg class="icon i-category">
                <use href="/public/assets/images/svg/sprites.svg#like" />
            </svg></h3>
        <div class="random__rows" style="margin-top: 2rem;">
            <?php foreach ($favourites as $post) : ?>
                <div class="random__card">
                    <img src="/public/<?= $post['pic'] ?>" alt="">
                    <div class="r_card__content">
                        <h3 class="r_card__title"><?= $post['title'] ?></h3>
                        <div class="r_card__row">
                            <a href="/user/<?= $post['user_id'] ?>" class="r_card__auth" style="cursor: pointer;"><?= $post['username'] ?></a>
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
        <div style="text-align: center">
            <a style="display: flex;" href="/popular">
                <button type="submit">
                    <svg class="auth__icon">
                        <use href="/public/assets/images/svg/sprites.svg#back"></use>
                    </svg>назад
                </button>
            </a>
            <p style="color: red; margin-bottom: 1rem">Список избранного пуст</p>
            <?php if (isset($_SESSION['id_user'])) : ?>
                <?php if ($_SESSION['id_user'] == basename($_SERVER['REQUEST_URI'])) : ?>
                    <a class="dropdown-item" style="justify-content: center" href="/popular" style="margin: 0 auto; padding-right: 2rem">
                        <svg class="icon i-category">
                            <use href="/public/assets/images/svg/sprites.svg#posts" />
                        </svg>Пополнить список</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>