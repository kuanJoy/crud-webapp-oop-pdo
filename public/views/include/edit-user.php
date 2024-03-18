<div class="random-container">
    <div style="display: flex; align-items: center;">
        <a style="display: flex;" href="/admin">
            <button type="submit">
                <svg class="auth__icon">
                    <use href="/public/assets/images/svg/sprites.svg#back"></use>
                </svg>назад
            </button>
        </a>
        <h3 class="random__title" style="margin: 0 auto; padding-right: 2rem">
            Редактирование пользователя
            <svg class="icon i-category">
                <use href="/public/assets/images/svg/sprites.svg#user" />
            </svg>
        </h3>
    </div>
    <form method="post" class="create-post" action="/admin" style="margin-top: 2rem;">
        <?php if (!empty($errors)) : ?>
            <ul class="auth__errors">
                <?php foreach ($errors as $error) : ?>
                    <li class="err"><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="input-box" style="font-size: 13px;">
            <span class="input-box__span">Роль: </span>
            <input type="radio" name="catStatus" value="активен" <?= $value['status'] == 'активен' ? 'checked' : '' ?>> Активен
            <input style="margin-left: 0.5rem;" type="radio" name="catStatus" value="скрыт" <?= $value['status'] == 'скрыт' ? 'checked' : '' ?>> Скрыт
        </div>
        <input type="hidden" name="catId" value="<?= $value['id'] ?>">
        <button type="submit" name="updateCat" class="auth__btn">Редактировать</button>
    </form>
</div>