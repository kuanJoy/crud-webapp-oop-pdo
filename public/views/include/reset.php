<div class="auth">
    <form method="post" class="auth__content">
        <div class="auth__row">
            <a href="/forget" class="auth__home">
                <svg class="auth__icon">
                    <use href="public/assets/images/svg/sprites.svg#back" />
                </svg>
                Назад
            </a>
        </div>
        <?php
        if (isset($errors) && empty($errors['success'])) :
            foreach ($errors as $error) : ?>
                <span class="err"> <?= $error ?></span>
        <?php endforeach;
        endif; ?>
        <?php if (isset($errors['success'])) : ?>
            <input type="hidden" name="token" value="<?php if (isset($_GET['token'])) {
                                                            htmlspecialchars($_GET['token']);
                                                        } ?>">
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
        <?php endif; ?>
        <?php if (!empty($errors_sendLink)) : ?>
            <h3 class="auth__title">
                <?= $errors_sendLink['success'] ?>
            </h3>
        <?php endif; ?>
        <?php if (isset($errors['expired'])) : ?>
            <input name="email" value="<?= $_SESSION['email_temp'] ?>" class="auth__input" type="hidden">
            <button type="submit" name="sendLink" class="auth__btn">Отправить новую ссылку</button>
        <?php endif; ?>
    </form>
</div>