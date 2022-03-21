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
                        <?php if(isset($_GET['jobs'])): ?>
                            <?php include(ROOT_PATH . '/includes/jobs.php') ?>
                        <?php else: ?>
                            <?php include(ROOT_PATH . '/includes/news.php') ?>
                        <?php endif ?>
                    </article>
                    <article class="column sponsors d-flex">
                        <?php foreach($sponsors as $sponsor):?>
                        <div class="sponsors__box">
                            <img class="sponsors__box-img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . 'static/img/uploads/' . $sponsor['filename'] ?>" alt="<?php ?>">
                        </div>
                        <?php endforeach ?>
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