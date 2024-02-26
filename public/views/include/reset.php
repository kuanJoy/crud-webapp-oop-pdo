<div class="auth">
    <form method="post" class="auth__content">
        <div class="auth__row">
            <h3 class="auth__title">
                Восстановление доступа
            </h3>
            <a href="/" class="auth__home">
                <svg class="auth__icon">
                    <use href="public/assets/images/svg/sprites.svg#back" />
                </svg>
                На главную
            </a>
        </div>
        <?php
        if (!empty($error)) : ?>
            <span class="err"> <?= $error ?></span>
        <?php endif; ?>
        <div class="auth__input-box">
            <svg class="auth__icon">
                <use href="public/assets/images/svg/sprites.svg#key" />
            </svg>
            <input name="email" class="auth__input" type="text" placeholder="Имя почты">
        </div>
        <button type="submit" name="sendLink" class="auth__btn">Восстановить</button>
        <div class="auth__btns">
            <a href="/login" class="auth__link">Войти</a>
            <a href="/register" class="auth__link">Зарегистрироваться</a>
        </div>
    </form>
</div>