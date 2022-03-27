    <?php include('config.php'); ?>
    <?php include(ROOT_PATH . '/includes/public_functions.php'); ?>
    <?php include(ROOT_PATH . '/includes/head_section.php'); ?>
    <?php
    // Get posts under a particular topic
    if (isset($_GET['topic'])) {
        $topic_id = $_GET['topic'];
        $posts = getPublishedPostsByTopic($topic_id);
    }
    ?>
    <!-- ============== title ============== -->
    <title>La Verdad | <?php echo getTopicNameById($topic_id); ?> </title>
    </head>

    <body>
        <!-- ============== header ============== -->
        <?php include(ROOT_PATH . '/includes/navbar.php') ?>

        <!-- ============== articles ============== -->
        <main>
            <section class="container">
                <?php if(!empty($posts)): ?>
                    <?php echo '<h1 class="filtered__title" > Artículos en <span class="filtered__title-topic">' . getTopicNameById($topic_id) . '</span></h1>' ?>
                    <div class="d-flex filtered">
                        <?php foreach ($posts as $post) : ?>
                            <?php $imgs = explode(",", $post['image']) ?>

                            <div class="filtered__item">
                                <div class="related">
                                    <img class="related__img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . 'static/img/uploads/' . $imgs[0] ?>" alt="<?php echo $imgs[0] ?>">
                                    <div class="related-shadow">
                                        <a href="<?php echo BASE_URL . 'single_post.php?post-slug=' . $post['slug'] ?>">
                                            <h3 class="related__title"><?php echo $post['title'] ?></h3>
                                        </a>
                                        <div class="related__resume">
                                            <div class="related__resume-created"><?php echo $post['created_at'] ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php else: ?>
                    <?php echo '<h1 class="filtered__title" > No se encontraron Artículos relacionados</h1>' ?>
                <?php endif ?>
            </section>
        </main>

        <!-- ============== footer ============== -->
        <?php include(ROOT_PATH . '/includes/footer.php') ?>

        <!-- ============== scripts ============== -->
        <?php require_once(ROOT_PATH . '/includes/scripts.php') ?>

    </body>

    </html>