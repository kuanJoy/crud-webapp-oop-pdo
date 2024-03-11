<form method="post" class="create-post" enctype="multipart/form-data">
    <?php if (!empty($errors)) : ?>
        <ul class="auth__errors">
            <?php foreach ($errors as $error) : ?>
                <li class="err"><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == 'админ' || $_SESSION['role'] == 'модератор') : ?>
        <div class="input-box">
            <span class="input-box__span">Статус: </span>
            <input type="radio" name="status" value="активен" <?= $getPostValues['post']['status'] == 'активен' ? 'checked' : '' ?>> Активен
            <input type="radio" name="status" value="скрыт" <?= $getPostValues['post']['status'] == 'скрыт' ? 'checked' : '' ?>> Скрыт
        </div>
    <?php endif; ?>
    <div class="input-box">
        <span class="input-box__span">Заголовок:</span>
        <input class="box__input" name="title" type="text" value="<?= $getPostValues['post']['title'] ?>">
    </div>
    <div class="input-box">
        <span class="input-box__span">Описание: </span>
        <input class="box__input" value="<?= htmlspecialchars($getPostValues['post']['description']) ?>" name="description" type="text">
    </div>
    <div class="input-box">
        <span class="input-box__span">Категория: </span>
        <select name="categoryId" class="form__select">
            <option selected value="<?= $getPostValues['post']['category_id'] ?>"><?= $getPostValues['post']['category_name'] ?> </option>
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['id'] ?>"> <?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="hashtags-inputs">
        <div class="hashtags__buttons">
            <button class="btn_h delete_h" type="button" onclick="removeLastHashtagInput()">Удалить хештег</button>
            <button class="btn_h add_h" type="button" onclick="addHashtagInput()">Добавить хештег</button>
        </div>
        <?php foreach ($getPostValues['hashtags'] as $hashtag) : ?>
            <div class="input-wrapper">
                <input type="text" name="hashtags[]" class="input-box-hashtag" value="<?= $hashtag['name'] ?>" placeholder="Введите хештег">
            </div>
        <?php endforeach; ?>
    </div>
    <div class="img__block">
        <h3 class="img__block_title">Текущий баннер</h3>
        <img class="current-img" src="/<?= htmlspecialchars($getPostValues['post']['pic']) ?>" alt="Current Image">
        <div class="img__block_upload">
            <svg class="camera" height="23" width="23" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
            </svg>
            <label>
                Загрузить новый баннер
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                <input type="hidden" name="pic" value="<?= $getPostValues['post']['pic'] ?>">
                <input type="file" name="newPic" class="feedback__file">
            </label>
        </div>
    </div>
    <label for="">
        <textarea id="mytextarea" name="content" class="form-control"><?= $getPostValues['post']['content'] ?></textarea>
    </label>
    <input type="hidden" name="postId" value="<?= $getPostValues['post']['id'] ?>">
    <button type="submit" name="editPost" class="auth__btn">Редактировать</button>
</form>