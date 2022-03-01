    <?php include('../config.php') ?>
    <?php // include(ROOT_PATH . '/admin/includes/admin_functions.php') ?>
    <?php include(ROOT_PATH . '/admin/includes/head_section.php') ?>
    <link rel="stylesheet" href="<?php echo BASE_URL . 'admin/static/css/main.css' ?>" />
    <title>La Verdad | Administrar Post </title>
    </head>

    <body id="body">
      <!-- ---- collapsible ----  -->
      <?php include(ROOT_PATH . '/admin/includes/aside.php') ?>
      <!-- ---- content ---- -->
    <main>
    <!-- ---- topic view ---- -->
        <section class="container">
          <h2 class="container-title">Administrar Usuarios</h2>
            <div class="topics">
                <?php include(ROOT_PATH . '/includes/messages.php') ?>
                <?php if (empty($users)): ?>
                    <h3 class="topics-title">No hay posts para mostrar.</h3>
                <?php else: ?>
                <div class="topics__table post__table">
                    <div class="topics__table-row">
                        <div class="box">ID</div>
                        <div class="box">Título</div>
                        <div class="box">Autor</div>
                        <div class="box">Vistas</div>
                        <?php if ($_SESSION['user']['role'] == "Admin"): ?>
							<div class="box">Publicado</div>
						<?php endif ?>
                        <div class="box"><i class="fas fa-tools"></i></div>
                    </div>
                    <?php foreach ($posts as $key => $post): ?>
                    <div class="topics__table-row">
                        <div class="box center">1</div>
                        <div class="box">The Mistery of JohnDoe</div>
                        <div class="box">Jane Doe</div>
                        <div class="box">20352</div>
                        <?php if ($_SESSION['user']['role'] == "Admin" ): ?>
                        <div class="box center">
                            <?php if ($post['published'] == true): ?>
                                <a href="posts.php?unpublish=<?php echo $post['id'] ?>"><i class="fas fa-check"></i></a>
                            <?php else: ?>   
                                <a href="posts.php?publish=<?php echo $post['id'] ?>"><i class="fas fa-times"></i></a>
                            <?php endif ?>
                        </div>
                        <?php endif ?>
                        <div class="box action">
                            <a href="user_c.php?edit-user=<?php echo $user['id'] ?>"><i class="fas fa-pencil"></i></a>
                            <a href="user_c.php?delete-user=<?php echo $user['id'] ?>"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                    <div class="topics__table-row">
                        <div class="box center"><?php echo $key + 1 ?></div>
                        <div class="box"><a class="title-post" href="<?php echo BASE_URL . 'single_post.php?post-slug=' . $post['slug'] ?>" target="_blank" rel="noopener noreferrer"><?php echo $post['title'] ?></a></div>
                        <div class="box"><?php echo $post['author'] ?></div>
                        <div class="box"><?php echo $post['views'] ?></div>
                        <?php if ($_SESSION['user']['role'] == "Admin" ): ?>
                        <div class="box center">
                            <?php if ($post['published'] == true): ?>
                                <a href="posts.php?unpublish=<?php echo $post['id'] ?>"><i class="fas fa-check"></i></a>
                            <?php else: ?>   
                                <a href="posts.php?publish=<?php echo $post['id'] ?>"><i class="fas fa-times"></i></a>
                            <?php endif ?>
                        </div>
                        <?php endif ?>
                        <div class="box action">
                            <a href="user_c.php?edit-user=<?php echo $user['id'] ?>"><i class="fas fa-pencil"></i></a>
                            <a href="user_c.php?delete-user=<?php echo $user['id'] ?>"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                <?php endif ?>
            </div>
        </section>
    </main>
    <!-- ---- footer ---- -->
    <footer></footer>
    <!-- ---- fontawesome ---- -->
    <script src="https://kit.fontawesome.com/65e563f321.js" crossorigin="anonymous"></script>
    <!-- ---- menu ----  -->
    <script src="<?php echo BASE_URL . 'admin/static/js/collapsible.js' ?>"></script>
    <!-- ---- theme picker ---- -->
    <script src="<?php echo BASE_URL . 'admin/static/js/themepicker.js' ?>"></script>
  </body>
</html>