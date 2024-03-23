<div class="hashtags container">
    <?php foreach ($hashtags as $hashtag) : ?>
        <a href="/hashtag/<?= $hashtag['name'] ?>" class="hashtag">#<?= $hashtag['name'] ?></a>
    <?php endforeach ?>
</div>