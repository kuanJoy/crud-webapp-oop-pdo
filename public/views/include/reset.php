<div class="auth">
    <form method="post" class="auth__content">
        <div class="auth__row">
            <h3 class="auth__title">
                Новый пароль
            </h3>
        </div>
        <?php
        if (isset($errors) && empty($errors['success'])) :
            foreach ($errors as $error) : ?>
                <span class="err"> <?= $error ?></span>
        <?php endforeach;
        endif; ?>
        <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token']) ?>">
        <div class="auth__input-box">
            <svg class="auth__icon">
                <use href="public/assets/images/svg/sprites.svg#key" />
            </svg>
            <input name="pass" class="auth__input" type="text" placeholder="Пароль">
        </div>
        <div class="auth__input-box">
            <svg class="auth__icon">
                <use href="public/assets/images/svg/sprites.svg#key" />
            </svg>
            <input name="repass" class="auth__input" type="text" placeholder="Повторите пароль">
        </div>
        <button type="submit" name="changePass" class="auth__btn">Поменять пароль</button>
    </form>
</div>