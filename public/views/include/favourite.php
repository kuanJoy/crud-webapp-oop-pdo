<div class="random-container">
    <?php if (!empty($favourites)) : ?>
        <h3 class="random__title">Избранное <?= $favourites[0]['username'] ?> <svg class="icon i-category">
                <use href="/public/assets/images/svg/sprites.svg#posts" />
            </svg></h3>
        <div class="random__rows">
            <?php foreach ($favourites as $favourite) : ?>
                <div class="random__card">
                    <img src="/public/<?= $favourite['pic'] ?>">
                    <div class="r_card__content">
                        <h3 class="r_card__title"><?= $favourite['title'] ?></h3>
                        <p class="r_card__desc"><?= $favourite['description'] ?></p>
                        <a href="/post/<?= $favourite['id'] ?>" class="btn read-more">Читать</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div style="display: flex; align-items: center;">
            <p style="min-width: 150px; color: red;">Избранное пусто</p>
            <a class="dropdown-item" href="/popular" style="margin: 0 auto; padding-right: 2rem">
                <svg class="icon i-category">
                    <use href="/public/assets/images/svg/sprites.svg#posts" />
                </svg>Пополнить список</a></li>
        </div>
    <?php endif; ?>
</div>