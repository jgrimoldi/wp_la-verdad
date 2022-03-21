<?php foreach ($posts as $post) : ?>
    <?php $imgs = explode(",", $post['image']) ?>
    <div class="articles__box">
        <div class="related">
            <div class="related__budgets">
                <a class="related__budgets-budget" href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $post['topic']['id'] ?>" rel="noopener noreferrer"><?php echo $post['topic']['name'] ?></a>
            </div>
            <img class="related__img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . 'static/img/uploads/' . $imgs[0] ?>" alt="<?php echo $imgs[0] ?>">
            <div class="related-shadow">
                <a href="<?php echo BASE_URL . 'single_post.php?post-slug=' . $post['slug'] ?>">
                    <h3 class="related__title"><?php echo $post['title'] ?></h3>
                </a>
                <div class="related__resume">
                    <div class="related__resume-info"><?php echo html_entity_decode($post['body']) ?></div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>