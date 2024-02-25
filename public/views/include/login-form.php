<div class="auth">
    <form method="post" class="auth__content">
        <div class="auth__row">
            <h3 class="auth__title">
                Войти в аккаунт
            </h3>
            <a href="/" class="auth__home">
                <svg class="auth__icon">
                    <use href="public/assets/images/svg/sprites.svg#back" />
                </svg>
                На главную
            </a>
        </div>
        <!-- =========== ВЫВОД ОШИБОК =========== -->
        <?php if (!empty($errors)) : ?>
            <ul class="auth__errors">
                <?php foreach ($errors as $error) : ?>
                    <li class="err"> <?= $error ?></li>
                <?php endforeach ?>
            </ul>
        <? endif; ?>
        <div class="auth__input-box">
            <svg class="auth__icon">
                <use href="public/assets/images/svg/sprites.svg#user" />
            </svg>
            <input name="loginOrEmail" class="auth__input" type="text" placeholder="Логин или email">
        </div>
        <div class="auth__input-box">
            <svg class="auth__icon">
                <use href="public/assets/images/svg/sprites.svg#key" />
            </svg>
            <input name="pass" class="auth__input" type="password" placeholder="Пароль">
        </div>
        <button type="submit" name="login" class="auth__btn">Войти</button>
        <div class="auth__btns">
            <a href="/reset" class="auth__link">Забыли пароль?</a>
            <a href="/register" class="auth__link">Зарегистрироваться</a>
        </div>
    </form>
</div>