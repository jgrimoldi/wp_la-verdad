<?php
if (isset($_GET['page'])) {
    $offset = (10 * $_GET['page']) + 1;
    // $limit = 10;
} else {
    $offset = 0;
    // $limit = 10;
}
?>

<?php $posts = getPublishedPosts($limit = 10, $offset) ?>
<?php $total_posts = max(ceil(totalPublishedPosts() / 10), 1) ?>

<?php foreach ($posts as $key => $post) : ?>
    <div class="articles__box">
        <div class="principal d-flex">
            <div class="principal__info">
                <h3 class="principal__info-title">
                    <a href="<?php echo BASE_URL . 'single_post.php?post-slug=' . $post['slug'] ?>"><?php echo $post['title'] ?></a>
                </h3>
                <div class="principal__info-resume">
                    <!-- <p><?php // echo html_entity_decode($post['body']) 
                            ?></p> -->
                </div>
            </div>
            <?php
            if (!empty($post['image'])) {
                echo '<img class="principal__image-img" loading="lazy" width="100" height="100" src=' . BASE_URL . 'static/img/uploads/' . $post['image'] . ' alt=' . $post['image'] . '>';
            } else {
                echo '<div class="post__iframe">';
                echo '<iframe width="560" height="315" src=' . $post['video']  . ' title=' . $post['title']  . ' frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                echo '</div>';
            }
            ?>
            <div class="principal__budgets">
                <a class="principal__budgets-budget" href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $post['topic']['id'] ?>" rel="noopener noreferrer"><?php echo $post['topic']['name'] ?></a>
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