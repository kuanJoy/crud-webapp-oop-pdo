<div class="popular">
    <?php foreach ($categoriesCount as $category) : ?>
        <div class="popular__category">
            <div class="category-name-more">
                <h3 class="category__name">
                    <svg class="icon i-category">
                        <use href="/public/assets/images/svg/sprites.svg#folder"></use>
                    </svg> <?= $category['category_name'] ?> - <b><?= $category['post_count'] ?></b>
                </h3>
                <a href="/category/<?= $category['category_id'] ?>">
                    Смотреть все
                    <svg class="icon i-category">
                        <use href="/public/assets/images/svg/sprites.svg#more" />
                    </svg></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>