    <?php require_once('config.php'); ?>
    <?php require_once(ROOT_PATH . '/includes/public_functions.php') ?>
    <?php require_once(ROOT_PATH . '/includes/head_section.php'); ?>
    <?php $posts = getPublishedPosts() ?>
    <?php $sponsors = getAllSponsors() ?>
    <!-- ============== title ============== -->
    <title>La Verdad - Noticias</title>
    </head>

    <body>
        <!-- ============== header ============== -->
        <?php include(ROOT_PATH . '/includes/navbar.php') ?>

        <!-- ============== articles ============== -->
        <main class="container">
            <section class="container-fluid news">
                <?php if (!empty($sponsors)) : ?>
                    <article class="sponsor__large">
                        <img class="sponsor__large-img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . '/static/img/sponsors/' . $sponsors[0]['filename'] ?>" alt="<?php echo $sponsors[0]['filename'] ?>">
                    </article>
                <?php endif ?>
                <div class="columns d-flex">
                    <article class="column articles d-flex">
                        <?php foreach($posts as $post): ?>
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
                    </article>
                    <article class="column sponsors d-flex">
                        <div class="sponsors__box">
                            <img class="sponsors__box-img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . 'static/img/uploads/banner.jpg' ?>" alt="<?php ?>">
                        </div>
                    </article>
                </div>
            </section>
        </main>

        <!-- ============== footer ============== -->
        <?php include(ROOT_PATH . '/includes/footer.php') ?>
        <!-- ============== scripts ============== -->
        <?php require_once(ROOT_PATH . '/includes/scripts.php') ?>
    </body>

    </html>