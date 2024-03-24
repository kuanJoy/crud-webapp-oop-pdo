<?php

use App\App\Controllers\SessionController;
use App\App\Controllers\PostController;

$sessionDestroy = new SessionController;
$sessionDestroy->logout();

$post = new PostController();
$categories = $post->getCategoriesForNavbar();
?>

<div class="header-bg">
    <header class="header container">
        <a href="/" class="home">
            <svg class="home-ico">
                <use href="/public/assets/images/svg/sprites.svg#home" />
            </svg>
        </a>
        <a href="/" class="logo">
            <img src="/public/assets/images/svg/idea.svg" class="footer__logo_pic">
            </img>
            Big.Идея
        </a>
        <div class="nav-collapse">
            <nav class="nav">
                <li class="nav-item dropdown">
                    <a class="nav-link nav__link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg class="icon-big">
                            <use href="/public/assets/images/svg/sprites.svg#category" />
                        </svg>
                        Категории
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($categories as $category) : ?>
                            <li><a class="dropdown-item" href="/category/<?= $category['id'] ?>"><?= $category['name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <a href="/popular" class="nav__link">
                    <svg class="icon-big">
                        <use href="/public/assets/images/svg/sprites.svg#popular" />
                    </svg>
                    Популярное
                </a>
                <div class="header-act-mobile">
                    <?php if (isset($_SESSION['id_user'])) : ?>
                        <a href="/favourite/<?= $_SESSION['id_user'] ?>" class="nav__link">
                            <svg class="icon i-category">
                                <use href="/public/assets/images/svg/sprites.svg#favourite" />
                            </svg>
                            Избранное
                        </a>
                        <a href="/user/<?= $_SESSION['id_user'] ?>" class="nav__link">
                            <svg class="icon i-category">
                                <use href="/public/assets/images/svg/sprites.svg#posts" />
                            </svg>
                            Мои статьи
                        </a>
                        <a class="nav__link" href="/create-post">
                            <svg class="icon i-category">
                                <use href="/public/assets/images/svg/sprites.svg#add" />
                            </svg>Добавить
                        </a>
                        <?php if ($_SESSION['role'] == 'админ' || $_SESSION['role'] == "модератор") : ?>
                            <a class="nav__link" href="/admin">
                                <svg class="icon i-category">
                                    <use href="/public/assets/images/svg/sprites.svg#admin" />
                                </svg>Админка
                            </a>
                        <?php endif; ?>
                        <form method="post" action="/" style="position: absolute; bottom: 50px;">
                            <button type="submit" name="logout" class="nav__link">
                                <svg class="auth__icon mt1">
                                    <use href="/public/assets/images/svg/sprites.svg#exit" />
                                </svg>Выйти
                            </button>
                        </form>
                    <?php else : ?>
                        <a href="/login" class="nav__link">Войти</a>
                    <?php endif; ?>
                </div>
            </nav>

            <div class="header-act">
                <!-- <form class="header__search">
                    <input class="search__input" type="text" placeholder="Поиск">
                    <button name="search" type="submit" class="btn-search">
                        <svg class="icon">
                            <use href="/public/assets/images/svg/sprites.svg#search" />
                        </svg>
                    </button>
                </form> -->
                <!-- ДЛЯ АВТОРИЗОВАННОГО -->
                <?php if (isset($_SESSION['id_user'])) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav__link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg class="icon">
                                <use href="/public/assets/images/svg/sprites.svg#user" />
                            </svg>
                            Профиль
                        </a>
                        <ul class="dropdown-menu">
                            <a href="/favourite/<?= $_SESSION['id_user'] ?>" class="nav__link">
                                <svg class="icon i-category">
                                    <use href="/public/assets/images/svg/sprites.svg#favourite" />
                                </svg>
                                Избранное
                            </a>
                            <a href="/user/<?= $_SESSION['id_user'] ?>" class="dropdown-item nav__link">
                                <svg class="icon i-category">
                                    <use href="/public/assets/images/svg/sprites.svg#posts" />
                                </svg>
                                Мои статьи
                            </a>
                            <li>
                                <a class="dropdown-item nav__link" href="/create-post">
                                    <svg class="icon i-category">
                                        <use href="/public/assets/images/svg/sprites.svg#add" />
                                    </svg>Добавить
                                </a>
                            </li>
                            <?php if ($_SESSION['role'] == 'админ' || $_SESSION['role'] == "модератор") : ?>
                                <li>
                                    <a class="dropdown-item nav__link" href="/admin">
                                        <svg class="icon i-category">
                                            <use href="/public/assets/images/svg/sprites.svg#admin" />
                                        </svg>Админка
                                    </a>
                                </li>
                            <?php endif; ?>
                            <hr class=" dropdown-divider">
                            <li>
                                <form method="post" action="/">
                                    <button type="submit" name="logout" class="dropdown-item nav__link">
                                        <svg class="auth__icon mt1">
                                            <use href="/public/assets/images/svg/sprites.svg#exit" />
                                        </svg>Выйти
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php else : ?>
                    <a href="/login" class="nav__link">Войти</a>
                <?php endif; ?>
            </div>
        </div>
        <button class="hamburger--slider" type="button">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
</div>
</header>
<main>