<div class="random-container">
    <section id="tabs" class="project-tab">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-posts-tab" data-toggle="tab" href="#nav-posts" role="tab" aria-controls="nav-posts" aria-selected="true">Публикации</a>
                            <a class="nav-item nav-link" id="nav-users-tab" data-toggle="tab" href="#nav-users" role="tab" aria-controls="nav-users" aria-selected="false">Пользователи</a>
                            <a class="nav-item nav-link" id="nav-category-tab" data-toggle="tab" href="#nav-category" role="tab" aria-controls="nav-category" aria-selected="false">Категории</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-posts" role="tabpanel" aria-labelledby="nav-posts-tab">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th style="width:30%">Заголовок</th>
                                        <th>Статус</th>
                                        <th>Дата</th>
                                        <th>Автор</th>
                                        <th>Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($allTables['posts'])) : ?>
                                        <?php foreach ($allTables['posts'] as $post) : ?>
                                            <tr>
                                                <td><a href="/post/<?= $post['id'] ?>"><?= $post['id'] ?></a></td>
                                                <td class="td_1_row"><?= $post['title'] ?></td>
                                                <td><?= $post['status'] ?></td>
                                                <td><?= $post['create_time'] ?></td>
                                                <td><a href="/user/<?= $post['user_id'] ?>"><?= $post['username'] ?></a></td>
                                                <td><a href="/edit/<?= $post['id'] ?>">Изменить</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-users" role="tabpanel" aria-labelledby="nav-users-tab">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Имя</th>
                                        <th>Почта</th>
                                        <th>Дата</th>
                                        <th>Роль</th>
                                        <th>Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($allTables['users'])) : ?>
                                        <?php foreach ($allTables['users'] as $user) : ?>
                                            <tr>
                                                <th><?= $user['id'] ?></th>
                                                <th><?= $user['username'] ?></th>
                                                <th><?= $user['email'] ?></th>
                                                <th><?= $user['create_time'] ?></th>
                                                <th><?= $user['role'] ?></th>
                                                <td><a href="/edit-user/<?= $user['id'] ?>">Изменить</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-category" role="tabpanel" aria-labelledby="nav-category-tab">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Название</th>
                                        <th>Статус</th>
                                        <th>Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($allTables['category'])) : ?>
                                        <?php foreach ($allTables['category'] as $category) : ?>
                                            <tr>
                                                <td><a href="/category/<?= $category['id'] ?>"><?= $category['id'] ?></a></td>
                                                <td><?= $category['name'] ?></td>
                                                <td><?= $category['status'] ?></td>
                                                <td><a href="/edit-cat/<?= $category['id'] ?>">Изменить</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>