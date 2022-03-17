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
            <?php if (!empty($sponsors)) : ?>
                <section class="sponsor__large">
                    <img class="sponsor__large-img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . '/static/img/sponsors/' . $sponsors[0]['filename'] ?>" alt="<?php echo $sponsors[0]['filename'] ?>">
                </section>
            <?php endif ?>

        </main>

        <!-- ============== footer ============== -->
        <?php include(ROOT_PATH . '/includes/footer.php') ?>
        <!-- ============== scripts ============== -->
        <?php require_once(ROOT_PATH . '/includes/scripts.php') ?>
    </body>

</html>