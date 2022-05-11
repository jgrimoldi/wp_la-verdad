        <?php require_once('config.php'); ?>
        <?php require_once(ROOT_PATH . '/includes/public_functions.php') ?>
        <?php require_once(ROOT_PATH . '/includes/head_section.php'); ?>
        <?php $posts = getPublishedPosts($limit = 3, 0) ?>
        <!-- ============== title ============== -->
        <title>La Verdad - Sitio no encontrado</title>
        </head>

        <body>
            <!-- ============== error ============== -->
            <main>
                <section class="errorpage d-flex">
                    <h1 class="errorpage__title">Error 404</h1>
                    <div class="errorpage__principal d-flex">
                        <div class="errorpage__principal-title">
                            <h2>OOPS!</h2>
                            <p>Parece que esta página no existe!</p>
                        </div>
                        <div class="errorpage__principal-img">
                            <img loading="lazy" width="100" height="100" src="<?php echo BASE_URL . 'static/img/error_gif.gif' ?>" alt="Gif Error Page404 Simpsons">
                        </div>
                    </div>
                    <div class="errorpage__help">
                        <h3 class="errorpage__help-title">Esto puede ayudar!</h3>
                        <div class="errorpage__help-links d-flex">
                            <a href="<?php echo BASE_URL . 'seccion/Noticias' ?>" rel="noopener noreferrer">Inicio</a>
                            <a href="<?php echo BASE_URL . 'seccion/Busquedas' ?>" rel="noopener noreferrer">Búsquedas</a>
                            <a href="<?php echo BASE_URL . 'seccion/Empleos' ?>" rel="noopener noreferrer">Empleos</a>
                            <?php if (count($posts) > 0) : ?>
                                <div class="post__links">
                                    <?php foreach ($posts as $post) : ?>
                                        <a href="<?php echo BASE_URL . 'noticia/' . $post['slug']  ?>" rel="noopener noreferrer"><?php echo $post['title'] ?></a>
                                    <?php endforeach ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </section>
            </main>
        </body>

        </html>