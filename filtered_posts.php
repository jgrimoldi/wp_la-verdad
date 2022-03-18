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
            <?php
                echo '<h1> Articulos en ' . getTopicNameById($topic_id) . '</h1>';
                foreach($posts as $post):
                    echo BASE_URL . 'static/img/' . $post['image'];
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