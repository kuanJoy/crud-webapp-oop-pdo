<?php

use App\App\Controllers\SessionController;

$sessionDestroy = new SessionController;
$sessionDestroy->logout();
?>

<div class="header-bg">
    <header class="header container">
        <div class="logo">Big.Idea</div>
        <div class="hamburger">
            <nav class="nav">
                <li class="nav-item dropdown">
                    <a class="nav-link nav__link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg class="icon i-category">
                            <use href="public/assets/images/svg/sprites.svg#category" />
                        </svg>
                        Каталог
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">История</a></li>
                        <li><a class="dropdown-item" href="#">География</a></li>
                    </ul>
                </li>
                <a href="#" class="nav__link">
                    <span class="link__content">
                        Популярное
                    </span>
                </a>
            </nav>
            <div class="header-act">
                <form class="header__search">
                    <input class="search__input" type="text" placeholder="Поиск">
                    <button name="search" type="submit" class="btn-search">
                        <svg class="icon">
                            <use href="public/assets/images/svg/sprites.svg#search" />
                        </svg>
                    </button>
                </form>
                <!-- ДЛЯ АВТОРИЗОВАННОГО -->
                <?php if (isset($_SESSION['id_user'])) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav__link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg class="icon">
                                <use href="public/assets/images/svg/sprites.svg#user" />
                            </svg>
                            Профиль
                        </a>
                        <ul class="dropdown-menu">
                            <a class="dropdown-item">
                                <svg class="icon i-category">
                                    <use href="public/assets/images/svg/sprites.svg#favourite" />
                                </svg>
                                Избранное
                            </a>
                            <?php if (($_SESSION['role'] != 3)) : ?>
                                <li><a class="dropdown-item" href="#">
                                        <svg class="icon i-category">
                                            <use href="public/assets/images/svg/sprites.svg#add" />
                                        </svg>Добавить</a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <form method="post" action="">
                                <button type="submit" name="logout" class="dropdown-item">
                                    <svg class="auth__icon mt1">
                                        <use href="public/assets/images/svg/sprites.svg#exit" />
                                    </svg>Выйти</button>
                            </form>
                        </ul>
                    </li>
                <?php else : ?>
                    <a href="/login" class="nav__link">Войти</a>
                <? endif; ?>
            </div>
        </div>
</div>
</header>