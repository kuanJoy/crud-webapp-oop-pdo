<div class="random-container">
    <h3 class="random__title">Избранное <?= $favourites[0]['username'] ?> <svg class="icon i-category">
            <use href="/public/assets/images/svg/sprites.svg#random" />
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
</div>