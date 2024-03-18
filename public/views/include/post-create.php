<div class="create-post" style="padding-top: 2rem">
    <div class="post__box" style="margin-bottom: 1rem;">
        <?php if (isset($errorsCat)) : ?>
            <?php foreach ($errorsCat as $error) : ?>
                <span class="err"><?= $error ?></span>
            <?php endforeach; ?>
        <?php endif ?>
        <span class="input-box__span">Добавьте свою категорию: </span>
        <form method="post" class="input-box" style="border: none; width: 100%; border-top: 2px solid #e3e5ed; border-radius: 0; padding-right: 5px">
            <input name="newCategory" type="text" class="input-box" style="border: none; width: 100%; border-radius: 0; padding: 0; font-size: 14px" placeholder="Введите категорию">
            <button class="btn_h add_h" type="submit" name="createCat">Создать</button>
        </form>
    </div>
</div>
<form method="post" class="create-post" enctype="multipart/form-data">
    <?php if (!empty($errors)) : ?>
        <ul class="auth__errors">
            <?php foreach ($errors as $error) : ?>
                <li class="err"><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class="input-box">
        <span class="input-box__span">Заголовок: </span>
        <input class="box__input" name="title" type="text">
    </div>
    <div class="input-box">
        <span class="input-box__span">Описание: </span>
        <input class="box__input" name="description" type="text">
    </div>
    <div class="hashtags-inputs">
        <div class="hashtags__buttons">
            <button class="btn_h delete_h" type="button" onclick="removeLastHashtagInput()">Удалить хештег</button>
            <button class="btn_h add_h" type="button" onclick="addHashtagInput()">Добавить хештег</button>
        </div>
        <div class="input-wrapper">
            <input type="text" name="hashtags[]" class="input-box-hashtag" placeholder="Введите хештег">
        </div>
    </div>
    <div class="input-box ">
        <svg class="camera" height="23" width="23" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
        </svg>
        <label class="box__input">
            Загрузить баннер
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
            <input type="file" name="pic" class="feedback__file">
        </label>
    </div>
    <label for="">
        <textarea id="mytextarea" name="content" class="form-control"></textarea>
    </label>
    <button type="submit" name="createPost" class="auth__btn">Создать публикацию</button>
</form>