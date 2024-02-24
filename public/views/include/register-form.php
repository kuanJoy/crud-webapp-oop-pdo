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
        <?php if (isset($errors)) : ?>
            <li class="auth__errors">
                <?php foreach ($errors as $error) : ?>
                    <ul class="err"> <?= $error ?></ul>
            </li>
        <?php endforeach ?>
    <? endif; ?>
    <div class="auth__input-box">
        <svg class="auth__icon">
            <use href="public/assets/images/svg/sprites.svg#user" />
        </svg>
        <input class="auth__input" name="username" type="text" placeholder="Логин">
    </div>
    <div class="auth__input-box">
        <svg class="auth__icon">
            <use href="public/assets/images/svg/sprites.svg#email" />
        </svg>
        <input class="auth__input" name="email" type="email" placeholder="E-mail">
    </div>
    <div class="auth__input-box">
        <svg class="auth__icon">
            <use href="public/assets/images/svg/sprites.svg#key" />
        </svg>
        <input class="auth__input" name="pass" type="password" placeholder="Пароль">
    </div>
    <div class="auth__input-box">
        <svg class="auth__icon">
            <use href="public/assets/images/svg/sprites.svg#key" />
        </svg>
        <input class="auth__input" name="repass" type="password" placeholder="Повторите пароль">
    </div>
    <button name="register-btn" class="auth__btn">Зарегистрироваться</button>
    <div class="auth__btns">
        <a href="#" class="auth__link">Забыли пароль?</a>
        <a href="/login" class="auth__link">Войти в аккаунт</a>
    </div>
    </form>
</div>