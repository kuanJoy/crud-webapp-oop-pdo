<div class="post">
    <?php if (isset($_SESSION['lastCategory'])) : ?>
        <form class="post__back" action="<?= $_SESSION['lastCategory'] ?>">
            <button type="submit">
                <svg class="auth__icon">
                    <use href="/public/assets/images/svg/sprites.svg#back"></use>
                </svg>назад</button>
        </form>
    <?php else : ?>
        <a href="/" class="auth__home">
            <svg class="auth__icon">
                <use href="/public/assets/images/svg/sprites.svg#back"></use>
            </svg>
            На главную
        </a>
    <?php endif ?>
    <img src="/public/<?= $onePost['post']['pic'] ?>" alt="" class="post__banner">
    <div class="post__attributes">
        <div class="category-hashtags">
            <span class="post__attribute"><?= $onePost['post']['category_name'] ?></span>
            <?php foreach ($onePost['hashtags'] as $hashtag) : ?>
                <span class="post__attribute">#<?= $hashtag['name'] ?></span>
            <?php endforeach; ?>
        </div>
        <form action="/post/<?= $onePost['post']['id'] ?>" class="attribute__likes" method="POST">
            <input type="hidden" name="post_id" value="<?= $onePost['post']['id'] ?>">
            <button type="submit" name="sendLike" class="btn-post">
                <svg class="icon i-like">
                    <use href="/public/assets/images/svg/sprites.svg#heart" />
                </svg>
            </button>
            <span><?= $onePost['likes']['likes_count'] ?></span>
        </form>
    </div>
    <div class="post__container">
        <h2 class="post__title"><?= $onePost['post']['title'] ?></h2>
        <h2 class="post__content"><?= $onePost['post']['content'] ?></h2>
        <?php if (isset($_SESSION['role']) || isset($_SESSION['id_user'])) : ?>
            <?php if ($_SESSION['role'] == 'админ' || $_SESSION['role'] == 'модератор' || $_SESSION['id_user'] == $onePost['post']['user_id']) : ?>
                <div class="post__btns">
                    <div class="attribute__likes" method="get">
                        <a href="/edit/<?= $onePost['post']['id'] ?>" class="btn-post">
                            <svg class="icon i-like">
                                <use href="/public/assets/images/svg/sprites.svg#edit" />
                            </svg>
                            Изменить
                        </a>
                    </div>
                    <form class="attribute__likes" method="post">
                        <input type="hidden" name="post_id" value="<?= $onePost['post']['id'] ?>">
                        <button type="submit" name="deletePost" class="btn-post">
                            <svg class="icon i-like">
                                <use href="/public/assets/images/svg/sprites.svg#delete" />
                            </svg>
                            Удалить
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>