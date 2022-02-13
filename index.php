        <?php require_once('config.php'); ?>
        <?php require_once(ROOT_PATH . '/includes/public_functions.php') ?>
        <?php require_once(ROOT_PATH . '/includes/head_section.php'); ?>
        <!-- ============== title ============== -->
        <title>La Verdad - Noticias</title>
    </head>

    <body>
        <!-- ============== header ============== -->
        <?php include(ROOT_PATH . '/includes/navbar.php') ?>

        <!-- ============== articles ============== -->
        <main>
            <section class="container">
                <?php
                    $posts = getPublishedPosts();
                    foreach($posts as $post):
                        echo BASE_URL . '/static/img/' . $post['image'];
                        echo "<a href='single_post.php?post-slug =" . $post['slug'] . "'";
                        if (isset($post['topic']['name'])):
                            echo '<a href= class="btn category"' . BASE_URL . 'filtered_posts.php?topic=' . $post['topic']['id'] . '">'
                            . $post['topic']['name'] .
                            '</a>';
                        endif;
                        echo $post['title'];
                        echo date('F j, Y', strtotime($post["created_at"]));
                    endforeach
                ?>
            </section>
        </main>

        <!-- ============== footer ============== -->
        <?php include(ROOT_PATH . '/includes/footer.php') ?>

        <!-- ============== scripts ============== -->
        <?php require_once(ROOT_PATH . '/includes/scripts.php') ?>


    </body>

    </html>