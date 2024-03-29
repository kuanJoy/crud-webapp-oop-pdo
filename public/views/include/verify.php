<div class="auth">
    <form method="post" class="auth__content">
        <div class="auth__row">
            <h3 class="auth__title">
                Подтверждение почты
            </h3>
            <button type="submit" name="logout" class="nav__link">
                <svg class="auth__icon mt1">
                    <use href="public/assets/images/svg/sprites.svg#back" />
                </svg>Выйти</button>
        </div>
        <p class="auth__verify">Пожалуйста, подтвердите Вашу учетную запись. На электронную почту <?= $_SESSION['email'] ?> был выслан код подтверждения. </p>
        <?php
        if (!empty($error)) : ?>
            <span class="err"> <?= $error ?></span>
        <?php endif; ?>
        <?php if (isset($error_sendToken['success'])) : ?>
            <h3 class="auth__title">
                <?= $error_sendToken['success'] ?>
            </h3>
        <? endif; ?>
        <?php if (isset($error_sendToken['error'])) : ?>
            <h3 class="auth__title">
                <?= $error_sendToken['error'] ?>
            </h3>
        <? endif; ?>
        <div class="auth__input-box">
            <svg class="auth__icon">
                <use href="public/assets/images/svg/sprites.svg#key" />
            </svg>
            <input name="token" class="auth__input" type="text" placeholder="код подтверждения">
        </div>
        <button type="submit" name="checkToken" class="auth__btn">Проверить код</button>
        <button type="submit" name="sendToken" class="auth__btn">Отправить код еще раз</button>
    </form>
</div>