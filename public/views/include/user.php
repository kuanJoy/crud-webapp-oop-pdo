<div class="random-container">
    <?php if (!empty($userPosts)) : ?>
        <h3 class="random__title">Публикации <?= $userPosts[0]['username'] ?> <svg class="icon i-category">
                <use href="/public/assets/images/svg/sprites.svg#posts" />
            </svg></h3>
        <div class="random__rows">
            <?php foreach ($userPosts as $post) : ?>
                <div class="random__card">
                    <img src="/public/<?= $post['pic'] ?>">
                    <div class="r_card__content">
                        <h3 class="r_card__title"><?= $post['title'] ?></h3>
                        <p class="r_card__desc"><?= $post['description'] ?></p>
                        <a href="/post/<?= $post['id'] ?>" class="btn read-more">Читать</a>
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