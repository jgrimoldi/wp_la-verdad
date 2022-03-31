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
                    <?php addView($post['id'], $visitor_ip) ?>
                    <section class="container-fluid post">
                        <article class="d-flex post__info">
                            <strong class="post__info-budget"><?php echo $post['topic']['name'] ?></strong>
                            <strong class="post__info-created"><?php echo date('D d/m/Y', strtotime($post['created_at'])) ?></strong>
                        </article>
                        <div class="post__background">
                            <h1 class="post__title"><?php echo $post['title']; ?></h1>
                            <h2 class="post__subtitle"><?php echo $post['subtitle']; ?></h2>
                            <div class="post__imgs">
                                <?php if (isset($post['video'])) : ?>
                                    <iframe class="post__imgs-iframe" src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2F109301787920924%2Fvideos%2F302222865403254%2F&show_text=false&width=560&t=0" width="560" height="650" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
                                <?php else : ?>
                                    <img loading="lazy" class="post__imgs-img" width="100" height="100" src="<?php echo BASE_URL . 'static/img/uploads/' . $post['image'] ?>" alt="<?php echo $post['title'] ?>">
                                <?php endif ?>
                            </div>
                            <article class="post__body">
                                <?php echo html_entity_decode($post['body']) ?>
                            </article>
                            <div class="fb-share-button" data-href="<?php echo BASE_URL . 'single_post.php?post-slug=' . $post['slug']  ?>" data-layout="button_count" data-size="small">Compartir</div>
                        </div>
                        <article class="post__related">
                            <h2 class="post__related-title">Últimas Noticias</h2>
                            <div class="post__related-news d-flex">
                                <?php foreach ($latests as $last) : ?>
                                    <div class="related">
                                        <img class="related__img" loading="lazy" width="100" height="100" src="<?php echo BASE_URL . 'static/img/uploads/' . $last['image'] ?>" alt="<?php echo $last['title'] ?>">
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