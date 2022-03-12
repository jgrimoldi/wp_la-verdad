        <?php require_once('config.php'); ?>
        <?php require_once(ROOT_PATH . '/includes/public_functions.php') ?>
        <?php require_once(ROOT_PATH . '/includes/head_section.php'); ?>
        <?php $posts = getPublishedPosts(); ?>
        <!-- ============== title ============== -->
        <title>La Verdad - Noticias</title>
        </head>

        <body>
            <!-- ============== header ============== -->
            <?php include(ROOT_PATH . '/includes/navbar.php') ?>

            <!-- ============== articles ============== -->
            <?php // foreach(array_slice($posts, 1) as $post): ?>
            <main class="container">
                <div class="index d-flex container-fluid">
                    <section class="columns sponsors">
                        <article></article>
                    </section>
                    <section class="columns news d-flex">
                        <article class="big-new news__article">
                            <img class="news__article-img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . '/static/img/uploads/noticia.webp' ?>" alt="">
                            <div class="shadow">
                                <div class="news__article-info">
                                    <a href="" rel="noopener noreferrer">
                                        <h2 class="news__article-title">La guerra, minuto a minuto</h2>
                                        <p class="news__article-resume">Guerra Rusia-Ucrania, en vivo: advierten que las tropas de Putin ya controlan el 70 por ciento de Lugansk y siguen los bombardeos</p>
                                    </a>
                                </div>
                                <div class="news__article-budgets">
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Política</a>
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Guerra</a>
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Mundo</a>
                                </div>
                            </div>
                        </article>

                        <article class="small-new news__article">
                        <img class="news__article-img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . '/static/img/uploads/noticia2.webp' ?>" alt="">
                            <div class="shadow">
                                <div class="news__article-info">
                                    <a href="" rel="noopener noreferrer">
                                        <h2 class="news__article-title">La guerra, minuto a minuto</h2>
                                        <p class="news__article-resume">Guerra Rusia-Ucrania, en vivo: advierten que las tropas de Putin ya controlan el 70 por ciento de Lugansk y siguen los bombardeos</p>
                                    </a>
                                </div>
                                <div class="news__article-budgets">
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Política</a>
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Guerra</a>
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Mundo</a>
                                </div>
                            </div>
                        </article>
                        <article class="small-new news__article">
                        <img class="news__article-img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . '/static/img/uploads/noticia3.webp' ?>" alt="">
                            <div class="shadow">
                                <div class="news__article-info">
                                    <a href="" rel="noopener noreferrer">
                                        <h2 class="news__article-title">La guerra, minuto a minuto</h2>
                                        <p class="news__article-resume">Guerra Rusia-Ucrania, en vivo: advierten que las tropas de Putin ya controlan el 70 por ciento de Lugansk y siguen los bombardeos</p>
                                    </a>
                                </div>
                                <div class="news__article-budgets">
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Política</a>
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Guerra</a>
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Mundo</a>
                                </div>
                            </div>
                        </article>
                        <article class="small-new news__article">
                        <img class="news__article-img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . '/static/img/uploads/noticia3.webp' ?>" alt="">
                            <div class="shadow">
                                <div class="news__article-info">
                                    <a href="" rel="noopener noreferrer">
                                        <h2 class="news__article-title">La guerra, minuto a minuto</h2>
                                        <p class="news__article-resume">Guerra Rusia-Ucrania, en vivo: advierten que las tropas de Putin ya controlan el 70 por ciento de Lugansk y siguen los bombardeos</p>
                                    </a>
                                </div>
                                <div class="news__article-budgets">
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Política</a>
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Guerra</a>
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Mundo</a>
                                </div>
                            </div>
                        </article>
                        <article class="small-new news__article">
                        <img class="news__article-img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . '/static/img/uploads/noticia4.webp' ?>" alt="">
                            <div class="shadow">
                                <div class="news__article-info">
                                    <a href="" rel="noopener noreferrer">
                                        <h2 class="news__article-title">La guerra, minuto a minuto</h2>
                                        <p class="news__article-resume">Guerra Rusia-Ucrania, en vivo: advierten que las tropas de Putin ya controlan el 70 por ciento de Lugansk y siguen los bombardeos</p>
                                    </a>
                                </div>
                                <div class="news__article-budgets">
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Política</a>
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Guerra</a>
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Mundo</a>
                                </div>
                            </div>
                        </article>
                        <article class="small-new news__article">
                        <img class="news__article-img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . '/static/img/uploads/noticia4.webp' ?>" alt="">
                            <div class="shadow">
                                <div class="news__article-info">
                                    <a href="" rel="noopener noreferrer">
                                        <h2 class="news__article-title">La guerra, minuto a minuto</h2>
                                        <p class="news__article-resume">Guerra Rusia-Ucrania, en vivo: advierten que las tropas de Putin ya controlan el 70 por ciento de Lugansk y siguen los bombardeos</p>
                                    </a>
                                </div>
                                <div class="news__article-budgets">
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Política</a>
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Guerra</a>
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="budget">Mundo</a>
                                </div>
                            </div>
                        </article>
                    </section>
                    <section class="columns sponsors">
                        <article></article>
                    </section>
                </div>
            </main>

            <!-- ============== footer ============== -->
            <?php include(ROOT_PATH . '/includes/footer.php') ?>

            <!-- ============== scripts ============== -->
            <?php require_once(ROOT_PATH . '/includes/scripts.php') ?>


        </body>

        </html>