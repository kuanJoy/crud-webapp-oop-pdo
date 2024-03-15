<div class="not__found" style="max-width: 59rem; margin: 0 auto; padding-top: 2rem">
    <p style="width: 100%;"><?= $title ?> не существует</p>
    <?php if (isset($_SESSION['lastCategory'])) : ?>
        <form class="post__back" action="<?= $_SESSION['lastCategory'] ?>">
            <button type="submit" style="color: black">
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
</div>