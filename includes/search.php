<?php $searchs = getPublishedPostBy('Búsquedas') ?>

<div class="d-flex filtered">
    <?php foreach ($searchs as $search) : ?>
        <div class="filtered__item search">
            <div class="related">
                <img class="related__img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . 'static/img/uploads/' . $search['image'] ?>" alt="<?php echo $search['image'] ?>">
                <div class="related-shadow">
                    <a href="<?php echo BASE_URL . 'single_post.php?post-slug=' . $search['slug'] ?>">
                        <h3 class="related__title"><?php echo $search['title'] ?></h3>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>