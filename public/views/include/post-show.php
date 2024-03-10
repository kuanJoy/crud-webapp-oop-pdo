<div class="post">
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
            <button type="submit" name="sendLike" class="like-button">
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
    </div>
</div>