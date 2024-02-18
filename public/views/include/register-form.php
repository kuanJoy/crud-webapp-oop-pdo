<div class="auth">
    <form method="post" class="auth__content">
        <h3 class="auth__title">
            Зарегистрироваться
        </h3>
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
            <input class="auth__input" name="checkpass" type="password" placeholder="Повторите пароль">
        </div>
        <button name="register" class="auth__btn">Зарегистрироваться</button>
        <div class="auth__btns">
            <a href="#" class="auth__link">Забыли пароль?</a>
            <a href="/login" class="auth__link">Войти в аккаунт</a>
        </div>
    </form>
</div>