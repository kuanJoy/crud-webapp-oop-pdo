<div class="post">
    <?php if (isset($_SESSION['lastCategory'])) : ?>
        <form class="post__back" action="<?= $_SESSION['lastCategory'] ?>">
            <button type="submit">
                <svg class="auth__icon">
                    <use href="/public/assets/images/svg/sprites.svg#back"></use>
                </svg>назад</button>
        </form>
    <?php else : ?>
        <div style="display: flex;justify-content: space-between;max-width: 59rem;width: 75%;margin: 0 auto;">
            <a href="/" class="post__back">
                <svg class="auth__icon">
                    <use href="/public/assets/images/svg/sprites.svg#home"></use>
                </svg>
                главная
            </a>
            <?php if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 'админ' || $_SESSION['role'] == "модератор") { ?>
                    <a href="/admin" class="post__back" style="width: 100%; text-align: right">
                        <svg class="auth__icon">
                            <use href="/public/assets/images/svg/sprites.svg#back"></use>
                        </svg>
                        панель управления
                    </a>
                <?php } ?>
            <?php } ?>
        </div>
    <?php endif ?>
    <img src="/public/<?= $onePost['post']['pic'] ?>" alt="" class="post__banner">
    <div class="post__attributes">
        <div class="category-hashtags">
            <span class="post__attribute"><?= $onePost['post']['category_name'] ?></span>
            <?php foreach ($onePost['hashtags'] as $hashtag) : ?>
                <span class="post__attribute">#<?= $hashtag['name'] ?></span>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="post__container">
        <h2 class="post__title"><?= $onePost['post']['title'] ?></h2>
        <h2 class="post__content"><?= $onePost['post']['content'] ?></h2>
        <div class="post__btns">
            <?php if (isset($_SESSION['role']) || isset($_SESSION['id_user'])) : ?>
                <?php if ($_SESSION['role'] == 'админ' || $_SESSION['role'] == 'модератор' || $_SESSION['id_user'] == $onePost['post']['user_id']) : ?>
                    <div class="attribute__likes" method="get">
                        <a href="/edit/<?= basename($_SERVER['REQUEST_URI']) ?>" class="btn-post">
                            <svg class="icon i-like">
                                <use href="/public/assets/images/svg/sprites.svg#edit" />
                            </svg>
                            Изменить
                        </a>
                    </div>
                    <form action="/" class="attribute__likes" method="post">
                        <input type="hidden" name="postId" value="<?= $onePost['post']['id'] ?>">
                        <input type="hidden" name="pic" value="<?= $onePost['post']['pic'] ?>">
                        <input type="hidden" name="postAuthor" value="<?= $onePost['post']['user_id'] ?>">
                        <button type="submit" onclick="return showConfirmation()" name="deletePost" class="btn-post">
                            <svg class="icon i-like">
                                <use href="/public/assets/images/svg/sprites.svg#delete" />
                            </svg>
                            удалить
                        </button>
                    </form>
                    <form action="/post/<?= basename($_SERVER['REQUEST_URI']) ?>" class="attribute__likes" method="post">
                        <input type="hidden" name="postId" value="<?= basename($_SERVER['REQUEST_URI'])  ?>">
                        <button type="submit" name="sendLike" class="btn-post">
                            <svg class="icon i-like">
                                <use href="/public/assets/images/svg/sprites.svg#heart" />
                            </svg>
                        </button>
                        <span><?= $onePost['likes']['likes_count'] ?></span>
                    </form>
                    <a href="/user/<?= $onePost['post']['user_id'] ?>" class="attribute__likes">
                        <svg class="icon">
                            <use href="/public/assets/images/svg/sprites.svg#user" />
                        </svg>
                        <span><?= $onePost['post']['username'] ?></span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>