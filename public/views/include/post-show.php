<div class="post" id="topPost">
    <div class="post__back_btns">
        <?php if (isset($_SESSION['lastCategory'])) : ?>
            <a class="post__back" href="<?= $_SESSION['lastCategory'] ?>">
                <div>
                    <svg class="auth__icon">
                        <use href="/public/assets/images/svg/sprites.svg#back"></use>
                    </svg>назад
                </div>
            </a>
        <?php endif; ?>
        <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'админ' || $_SESSION['role'] == "модератор")) : ?>
            <a href="/admin" class="post__back">
                <div>
                    <svg class="auth__icon">
                        <use href="/public/assets/images/svg/sprites.svg#back"></use>
                    </svg>
                    панель управления
                </div>
            </a>
        <?php endif; ?>
    </div>
    <img src="/public/<?= $onePost['post']['pic'] ?>" class="post__banner container">
    <div class="post__attributes container">
        <div class="category-hashtags">
            <span class="post__attribute"><?= $onePost['post']['category_name'] ?></span>
            <?php foreach ($onePost['hashtags'] as $hashtag) : ?>
                <?php if (!empty($hashtag['name'])) : ?>
                    <a href="/hashtag/<?= $hashtag['name'] ?>" class="post__attribute">#<?= $hashtag['name'] ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="post__btns container">
        <?php if (isset($_SESSION['id_user'])) : ?>
            <?php if ($_SESSION['role'] == 'админ' || $_SESSION['role'] == 'модератор' || ($_SESSION['id_user'] == $onePost['post']['user_id'])) : ?>
                <!-- Редактирование и удаление поста -->
                <div class="attribute__likes" method="get">
                    <a href="/edit/<?= $onePost['likes']['id'] ?>" class="btn-post">
                        <svg class="icon i-like">
                            <use href="/public/assets/images/svg/sprites.svg#edit" />
                        </svg>
                        Изменить
                    </a>
                </div>
                <form class="attribute__likes" method="post">
                    <input type="hidden" name="postId" value="<?= $onePost['likes']['id'] ?>">
                    <input type="hidden" name="pic" value="<?= $onePost['post']['pic'] ?>">
                    <input type="hidden" name="postAuthor" value="<?= $onePost['post']['user_id'] ?>">
                    <button type="submit" onclick="return showConfirmation()" name="deletePost" class="btn-post">
                        <svg class="icon i-like">
                            <use href="/public/assets/images/svg/sprites.svg#delete" />
                        </svg>
                        удалить
                    </button>
                </form>
            <?php endif; ?>
        <?php endif; ?>
        <!-- Лайки и профиль пользователя -->
        <form action="/post/<?= $onePost['likes']['id'] ?>" class="attribute__likes" method="post">
            <input type="hidden" name="postId" value="<?= $onePost['likes']['id'] ?>">
            <?php if ($onePost['like_on_post'] == 'not-liked') : ?>
                <button type="submit" name="sendLike" class="btn-post">
                    <svg class="icon i-like">
                        <use href="/public/assets/images/svg/sprites.svg#heart" />
                    </svg>
                </button>
            <?php elseif ($onePost['like_on_post'] == 'liked') : ?>
                <button type="submit" name="deleteLike" class="btn-post">
                    <svg class="icon i-like">
                        <use href="/public/assets/images/svg/sprites.svg#heart-full" />
                    </svg>
                </button>
            <?php else : ?>
                <svg class="icon i-like">
                    <use href="/public/assets/images/svg/sprites.svg#heart-full" />
                </svg>
            <?php endif; ?>
            <span><?= $onePost['likes']['likes_count'] ?></span>
        </form>
        <a href="/user/<?= $onePost['post']['user_id'] ?>" class="attribute__likes">
            <svg class="icon">
                <use href="/public/assets/images/svg/sprites.svg#user" />
            </svg>
            <span><?= $onePost['post']['username'] ?></span>
        </a>
        <div class="attribute__likes">
            <b><span><?= substr(strval($onePost['post']['posts_time']), 0, 10) ?></span></b>
        </div>
    </div>
    <div class="post__container">
        <h2 class="post__title"><?= $onePost['post']['title'] ?></h2>
        <h2 class="post__content"><?= $onePost['post']['content'] ?></h2>
    </div>
    <a href="#topPost" class="scrollToTopBtn">
        <img src="/public/assets/images/svg/top.svg" alt="">
    </a>
</div>