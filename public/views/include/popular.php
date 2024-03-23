<div class="popular container">
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

<div class="popular container col-hash">
    <?php foreach ($hashtagsCount as $hashtag) : ?>
        <div class="popular__category">
            <div class="category-name-more" style="justify-content: center">
                <h3 class=" category__name">
                    <svg class="icon i-category">
                        <use href="/public/assets/images/svg/sprites.svg#hashtag"></use>
                    </svg> <?= $hashtag['hashtag'] ?> - <b><?= $hashtag['count'] ?></b>
                </h3>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<h3 class="category__name container" style="margin-top: 2rem">Топ авторов</h3>
<div class="popular container">
    <?php foreach ($topUsers as $user) : ?>
        <div class="popular__category">
            <div class="category-name-more" style="justify-content: center;flex-direction: column; ">
                <div style="display: flex; align-items: center; gap: 0.5rem">
                    <h3 class=" category__name">
                        <?= $user['username'] ?>
                    </h3>
                    <div style="display: flex; align-items:center; justify-content: center">
                        <img src="/public/assets/images/svg/idea.svg" class="footer__logo_pic"><b><?= $user['total_likes'] + $user['total_posts'] ?></b>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem">
                    <a href="/favourite/<?= $user['id'] ?>" style="background-color: #e2e5f6; padding: 0.3125rem 0.625rem;
    border-radius: 0.5rem;">
                        избранное
                        <div style="display: flex; align-items:center; justify-content: center">
                            <svg class="icon i-category">
                                <use href="/public/assets/images/svg/sprites.svg#favourite" />
                            </svg>
                            <b><?= $user['total_likes'] ?></b>
                        </div>
                    </a>
                    <a href="/user/<?= $user['id'] ?>" style="background-color: #e2e5f6; padding: 0.3125rem 0.625rem; border-radius: 0.5rem;">
                        публикации
                        <div style="display: flex; align-items:center; justify-content: center">
                            <svg class="icon i-category">
                                <use href="/public/assets/images/svg/sprites.svg#posts" />
                            </svg>
                            <b><?= $user['total_posts'] ?></b>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>