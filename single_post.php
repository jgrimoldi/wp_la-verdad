    <?php include('config.php'); ?>
    <?php include(ROOT_PATH . '/includes/public_functions.php'); ?>
    <?php
    // GET post by slug
    if (isset($_GET['post-slug'])) {
        $post = getPost($_GET['post-slug']);
    }
    ?>
    <?php include(ROOT_PATH . '/includes/head_section.php'); ?>
    <?php $visitor_ip = $_SERVER['REMOTE_ADDR']; ?>
    <?php // $topics = getPostTopic($post['id']) 
    ?>

    <!-- ============== title ============== -->
    <title>La Verdad | <?php if (isset($post['title'])) {
                            echo $post['title'];
                        } else {
                            echo 'No se encontro la noticia';
                        } ?> </title>
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
                                        <img class="related__img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . 'static/img/uploads/' . $last['image'] ?>" alt="<?php echo $last['title'] ?>">
                                        <div class="related-shadow">
                                            <a href="<?php echo BASE_URL . 'noticia/' . $last['slug'] ?>">
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
                    <?php addView($post['id'], $visitor_ip) ?>
                    <section class="container-fluid post">
                        <article class="d-flex post__info">
                            <strong class="post__info-budget"><?php echo $post['topic']['name'] ?></strong>
                            <strong class="post__info-created"><?php echo date('D d/m/Y', strtotime($post['created_at'])) ?></strong>
                        </article>
                        <div class="post__background">
                            <h1 class="post__title"><?php echo $post['title']; ?></h1>
                            <h2 class="post__subtitle"><?php echo $post['subtitle']; ?></h2>
                            <?php if (!empty($post['video'])) : ?>
                                <div class="post__iframe">
                                    <iframe width="560" height="315" src="<?php echo $post['video'] ?>" title="<?php echo $post['title'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            <?php else : ?>
                                <div class="post__imgs">
                                    <img loading="lazy" class="post__imgs-img" width="100" height="100" src="<?php echo BASE_URL . 'static/img/uploads/' . $post['image'] ?>" alt="<?php echo $post['title'] ?>">
                                </div>
                            <?php endif ?>
                            <article class="post__body">
                                <?php echo html_entity_decode($post['body']) ?>
                            </article>
                            <div class="fb-share-button" data-href="<?php echo BASE_URL . 'noticia/' . $post['slug']  ?>" data-layout="button_count" data-size="small">Compartir</div>
                        </div>
                        <article class="post__related">
                            <h2 class="post__related-title">Últimas Noticias</h2>
                            <div class="post__related-news d-flex">
                                <?php foreach ($latests as $last) : ?>
                                    <div class="related">
                                        <?php
                                        if (!empty($last['image'])) {
                                            echo '<img class="related__img" loading="lazy" width="100" height="100" src=' . BASE_URL . 'static/img/uploads/' . $last['image'] . ' alt=' . $last['image'] . '>';
                                        } else {
                                            echo '<div class="post__iframe">';
                                            echo '<iframe width="560" height="315" src=' . $last['video']  . ' title=' . $last['title']  . ' frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                            echo '</div>';
                                        }
                                        ?>
                                        <div class="related-shadow">
                                            <a href="<?php echo BASE_URL . 'noticia/' . $last['slug'] ?>">
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

        <!-- ============== fb ============== -->
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://connect.facebook.net/es_LA/all.js#xfbml=1&version=v3.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>



    </body>

    </html>