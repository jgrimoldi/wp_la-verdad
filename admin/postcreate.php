    <?php include('../config.php') ?>
    <?php // include(ROOT_PATH . '/admin/includes/ad<?php ecmin_functions.php') ?>
    <?php include(ROOT_PATH . '/admin/includes/head_section.php') ?>
    <link rel="stylesheet" href="<?php echo BASE_URL . 'admin/static/css/main.css' ?>" />
    <title>La Verdad | Crear Post </title>
    </head>

    <body id="body">
      <!-- ---- collapsible ----  -->
      <?php include(ROOT_PATH . '/admin/includes/aside.php') ?>
      <!-- ---- content ---- -->
      <main>
        <section class="container">
          <h2 class="container-title">Crear Post</h2>
          <div class="form">
            <form action="" method="POST" enctype="multipart/form-data" class="form__inputs d-flex">
              <?php if ($isEditingPost === true) : ?>
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
              <?php endif ?>
              <input class="form__inputs-input" type="text" name="title" id="title" placeholder="Título de la Noticia" value="<?php echo $title ?>">
              <input class="form__inputs-input input-file" type="file" name="featured_img" id="featured_img" multiple>
              <textarea class="form__inputs-input input-textarea" name="body" id="body" cols="30" rows="10" placeholder="Cuerpo de la Noticia"><?php echo $body ?></textarea>
              <select class="form__inputs-input" name="topic_id" id="topic_id">
                <option value="" selected disabled>Selecciona un Tema</option>
                <?php foreach ($topics as $topic) : ?>
                  <option value="<?php echo $topic['id'] ?>">
                    <?php echo $topic['name'] ?>
                  </option>
                <?php endforeach ?>
              </select>
              <!-- Only admin users can view publish input field -->
              <?php if ($_SESSION['user']['role'] == "Admin") : ?>
                <!-- display checkbox according to whether post has been published or not -->
                <?php if ($published == true) : ?>
                  <label for="publish">
                    Publicado
                    <input type="checkbox" value="1" name="publish" checked="checked">&nbsp;
                  </label>
                <?php else : ?>
                  <label for="publish">
                    Publicar
                    <input type="checkbox" value="1" name="publish">&nbsp;
                  </label>
                <?php endif ?>
              <?php endif ?>
              <!-- if editing post, display the update button instead of create button -->
              <?php if ($isEditingPost === true) : ?>
                <input type="submit" class="form__inputs-input btn-submit" name="update_post" id="update_post" value="Actualizar">
              <?php else : ?>
                <input type="submit" class="form__inputs-input btn-submit" name="create_post" id="create_post" value="Guardar Post">
              <?php endif ?>
            </form>
            <div class="error">
              <?php include(ROOT_PATH . '/includes/errors.php') ?>
            </div>
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