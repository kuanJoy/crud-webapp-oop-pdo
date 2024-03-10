<div class="random-container">
    <h3 class="random__title"><?= $posts[0]['category_name'] ?><svg class="icon i-category">
            <use href="/public/assets/images/svg/sprites.svg#folder" />
        </svg></h3>
    <div class="random__rows">
        <?php foreach ($posts as $post) : ?>
            <div class="random__card">
                <img src="/public/<?= $post['pic'] ?>" alt="">
                <div class="r_card__content">
                    <h3 class="r_card__title"><?= $post['title'] ?></h3>
                    <p class="r_card__desc"><?= $post['description'] ?></p>
                    <a href="/post/<?= $post['id'] ?>" class="btn read-more">Читать</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>