<div class="popular">
    <?php foreach ($categoriesCount as $category) : ?>
        <div class="popular__category">
            <div class="category-name-more">
                <h3 class="category__name">
                    <svg class="icon-big">
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

<div class="popular">
    <?php foreach ($hashtagsCount as $hashtag) : ?>
        <div class="popular__category">
            <div class="category-name-more">
                <h3 class="category__name">
                    <svg class="icon i-category">
                        <use href="/public/assets/images/svg/sprites.svg#hashtag"></use>
                    </svg> <?= $hashtag['hashtag'] ?> - <b><?= $hashtag['count'] ?></b>
                </h3>
                <a href="/hashtag/<?= $hashtag['hashtag'] ?>">
                    Смотреть все
                    <svg class="icon i-category">
                        <use href="/public/assets/images/svg/sprites.svg#more" />
                    </svg></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<h3 class="category__name" style="margin-top: 2rem">Топ авторов</h3>
<div class="popular">
    <?php foreach ($topUsers as $user) : ?>
        <div class="popular__category">
            <div class="category-name-more" style="justify-content: center;">
                <div style="display: flex; align-items: center; gap: 0.5rem">
                    <h3 class=" category__name">
                        <?= $user['username'] ?>
                    </h3>
                    <div style="display: flex; align-items:center; justify-content: center">
                        <svg class="icon i-category">
                            <use href="/public/assets/images/svg/sprites.svg#like"></use>
                        </svg><b><?= $user['total_likes'] ?></b>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem">
                    <a href="/favourite/<?= $user['id'] ?>" style="background-color: #e2e5f6; padding: 0.3125rem 0.625rem;
    border-radius: 0.5rem;">
                        избранное
                        <svg class="icon i-category">
                            <use href="/public/assets/images/svg/sprites.svg#favourite" />
                        </svg></a>
                    <a href="/user/<?= $user['id'] ?>" style="background-color: #e2e5f6; padding: 0.3125rem 0.625rem; border-radius: 0.5rem;">
                        публикации
                        <svg class="icon i-category">
                            <use href="/public/assets/images/svg/sprites.svg#posts" />
                        </svg></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>