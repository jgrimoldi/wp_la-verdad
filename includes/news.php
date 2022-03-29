<?php
if (isset($_GET['page'])) {
    $offset = 10 * $_GET['page'];
    $limit = $offset + 10;
} else {
    $offset = 0;
    $limit = 10;
}
?>

<?php $posts = getPublishedPosts($limit, $offset) ?>
<?php $total_posts = max(ceil(totalPublishedPosts() / 10), 1) ?>

<?php foreach ($posts as $post) : ?>
    <div class="articles__box">
        <div class="related">
            <div class="related__budgets">
                <a class="related__budgets-budget" href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $post['topic']['id'] ?>" rel="noopener noreferrer"><?php echo $post['topic']['name'] ?></a>
            </div>
            <img class="related__img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . 'static/img/uploads/' . $post['image'] ?>" alt="<?php echo $post['image'] ?>">
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

<div class="pagination">
    <div id="pb" class="pagination__buttons">
        <?php for ($i = 0; $i < $total_posts; $i++) : ?>
            <?php if ($i == 0) : ?>
                <a class="pagination__buttons-btn" href="<?php echo BASE_URL . 'index.php?section=Noticias' ?>" rel="noopener noreferrer" page="<?php $i ?>"><i class="fas fa-home"></i></a>
                <?php continue; ?>
            <?php endif ?>
            <a class="pagination__buttons-btn" href="<?php echo BASE_URL . 'index.php?section=Noticias&page=' . $i ?>" rel="noopener noreferrer" page="<?php $i ?>"><?php echo $i ?></a>
        <?php endfor ?>
    </div>
    <div class="pagination__scroll">
        <a class="scroll-arrow prev" rel="noopener noreferrer" page="prev"><i class="fas fa-angle-left"></i></a>
        <a class="scroll-arrow next" rel="noopener noreferrer" page="next"><i class="fas fa-angle-right"></i></a>
    </div>
</div>

<script src="<?php echo BASE_URL . 'static/js/pagination.js' ?>"></script>