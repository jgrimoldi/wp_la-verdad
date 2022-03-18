    <?php include('config.php'); ?>
    <?php include(ROOT_PATH . '/includes/public_functions.php'); ?>
    <?php include(ROOT_PATH . '/includes/head_section.php'); ?>
    <?php
    // GET post by slug
    if (isset($_GET['post-slug'])) {
        $post = getPost($_GET['post-slug']);
    }
    $topics = getPostTopic($post['id']);
    ?>
    <style>
        .item-1 {
            z-index: 2;
            opacity: 1;
            background: url(<?php echo BASE_URL . 'static/img/uploads/' . $post['image']; ?>);
            background-size: cover;
        }

        .item-2 {
            background: url(<?php echo BASE_URL . 'static/img/uploads/' . $post['image']; ?>);
            background-size: cover;
        }

        .item-3 {
            background: url(<?php echo BASE_URL . 'static/img/uploads/' . $post['image']; ?>);
            background-size: cover;
        }
    </style>
    <!-- ============== title ============== -->
    <title>La Verdad | <?php if (isset($post['title'])) {echo $post['title'];}else{ echo 'No se encontro la noticia'; } ?> </title>
    </head>

    <body>
        <!-- ============== header ============== -->
        <?php include(ROOT_PATH . '/includes/navbar.php') ?>

        <!-- ============== articles ============== -->
        <main>
            <section class="container">
                <?php if (empty($post)) : ?>
                    <?php $latests = getLastPosts(0, 3) ?>
                    <section class="container-fluid post">
                        <div class="post__background">
                            <h1 class="post__title">Lo siento! Esta noticia todavía no fue publicada</h1>
                        </div>
                        <article class="post__related">
                            <h2 class="post__related-title">Últimas Noticias</h2>
                            <div class="post__related-news d-flex">
                                <?php foreach ($latests as $last) : ?>
                                    <div class="related">
                                        <img class="related__img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . 'static/img/uploads/' . $last['image'] ?>" alt="<?php echo $last['image'] ?>">
                                        <div class="related-shadow">
                                            <a href="<?php echo BASE_URL . 'single_post.php?post-slug=' . $last['slug'] ?>">
                                                <h3 class="related__title"><?php echo $last['title'] ?></h3>
                                            </a>
                                            <div class="related__resume">
                                                <div class="related__resume-created"><?php echo $last['created_at'] ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </article>
                    </section>
                <?php else : ?>
                    <?php $latests = getLastPosts($post['id'], 3) ?>
                    <?php addView($post['id']) ?>
                    <section class="container-fluid post">
                        <article class="d-flex post__info">
                            <strong class="post__info-budget"><?php echo $post['topic']['name'] ?></strong>
                            <strong class="post__info-created"><?php echo $post['created_at'] ?></strong>
                        </article>
                        <div class="post__background">
                            <h1 class="post__title"><?php echo $post['title']; ?></h1>
                            <div class="post__imgs">
                                <span id="item-1" class="item"></span>
                                <span id="item-2" class="item"></span>
                                <span id="item-3" class="item"></span>
                                <div class="carousel-item item-1">
                                    <a href="#item-3" class="arrow-prev arrow"></a>
                                    <a href="#item-2" class="arrow-next arrow"></a>
                                </div>

                                <div class="carousel-item item-2">
                                    <a href="#item-1" class="arrow-prev arrow"></a>
                                    <a href="#item-3" class="arrow-next arrow"></a>
                                </div>

                                <div class="carousel-item item-3">
                                    <a href="#item-2" class="arrow-prev arrow"></a>
                                    <a href="#item-1" class="arrow-next arrow"></a>
                                </div>
                            </div>
                            <article class="post__body">
                                <?php echo html_entity_decode($post['body']) ?>
                            </article>
                        </div>
                        <article class="post__related">
                            <h2 class="post__related-title">Últimas Noticias</h2>
                            <div class="post__related-news d-flex">
                                <?php foreach ($latests as $last) : ?>
                                    <div class="related">
                                        <img class="related__img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . 'static/img/uploads/' . $last['image'] ?>" alt="<?php echo $last['image'] ?>">
                                        <div class="related-shadow">
                                            <a href="<?php echo BASE_URL . 'single_post.php?post-slug=' . $last['slug'] ?>">
                                                <h3 class="related__title"><?php echo $last['title'] ?></h3>
                                            </a>
                                            <div class="related__resume">
                                                <div class="related__resume-created"><?php echo $last['created_at'] ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </article>
                    </section>
                <?php endif ?>
        </main>

        <!-- ============== footer ============== -->
        <?php include(ROOT_PATH . '/includes/footer.php') ?>

        <!-- ============== scripts ============== -->
        <?php require_once(ROOT_PATH . '/includes/scripts.php') ?>

    </body>

    </html>