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
        <a href="/" class="logo">Big.Idea</a>
        <div class="hamburger">
            <nav class="nav">
                <li class="nav-item dropdown">
                    <a class="nav-link nav__link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg class="icon i-category">
                            <use href="/public/assets/images/svg/sprites.svg#category" />
                        </svg>
                        Категории
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($categories as $category) : ?>
                            <?php if ($category['status'] == 'активен') : ?>
                                <li><a class="dropdown-item" href="/category/<?= $category['id'] ?>"><?= $category['name'] ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <a href="/popular" class="nav__link">
                    <span class="link__content">
                        Популярное
                    </span>
                </a>
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
                            <a href="/favourite/<?= $_SESSION['id_user'] ?>" class="dropdown-item">
                                <svg class="icon i-category">
                                    <use href="/public/assets/images/svg/sprites.svg#favourite" />
                                </svg>
                                Избранное
                            </a>
                            <a href="/user/<?= $_SESSION['id_user'] ?>" class="dropdown-item">
                                <svg class="icon i-category">
                                    <use href="/public/assets/images/svg/sprites.svg#posts" />
                                </svg>
                                Мои статьи
                            </a>
                            <li><a class="dropdown-item" href="/create-post">
                                    <svg class="icon i-category">
                                        <use href="/public/assets/images/svg/sprites.svg#add" />
                                    </svg>Добавить</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <form method="post" action="/">
                                <button type="submit" name="logout" class="dropdown-item">
                                    <svg class="auth__icon mt1">
                                        <use href="/public/assets/images/svg/sprites.svg#exit" />
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