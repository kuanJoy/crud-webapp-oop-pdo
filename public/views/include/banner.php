<div class="banner">
    <div class="swiper mySwiper banner__item">
        <div class="swiper-wrapper">
            <?php foreach ($bannerPosts as $banner) : ?>
                <div class="swiper-slide">
                    <div class="banner__card">
                        <div class="card__img" style="background:url('<?= $banner['pic'] ?>') no-repeat; background-size: cover;
        background-position: center"></div>
                        <div class=" card__fade"></div>
                        <div class="card__content">
                            <h3 class="card__content-title"><?= $banner['title'] ?></h3>
                            <p class="card__content-desc"><?= $banner['description'] ?></p>
                            <a class="btn" href="/post/<?= $banner['id'] ?>">Читать</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-button-next swiper-btn"></div>
        <div class="swiper-button-prev swiper-btn"></div>
    </div>
</div>