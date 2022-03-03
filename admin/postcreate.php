  <?php include('../config.php') ?>
  <?php include(ROOT_PATH . '/admin/includes/admin_functions.php') ?>
  <?php include(ROOT_PATH . '/admin/includes/post_functions.php') ?>
  <?php include(ROOT_PATH . '/admin/includes/head_section.php') ?>
  <?php include(ROOT_PATH . '/admin/includes/admin_styles.php' )?>
  <?php $topics = getAllTopics() ?>
  <title>La Verdad | Crear Post </title>
  </head>

  <body id="body">
    <!-- ---- collapsible ----  -->
    <?php include(ROOT_PATH . '/admin/includes/aside.php') ?>
    <!-- ---- content ---- -->
    <main>
      <section class="container">
        <?php if ($isEditingPost === true) : ?>
          <h2 class="container-title">Editar Post</h2>
        <?php else: ?>
          <h2 class="container-title">Crear Post</h2>
        <?php endif ?>
        <div class="form">
          <form action="<?php echo BASE_URL . 'admin/postcreate.php' ?>" method="POST" enctype="multipart/form-data" class="form__inputs d-flex">
            
            <?php if ($isEditingPost === true) : ?>
              <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <?php endif ?>

            <input class="form__inputs-input" type="text" name="title" id="title" placeholder="Título de la Noticia" value="<?php echo $title ?>">
              <!-- MAX_FILE_SIZE must precede the file input field -->
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
            <!-- ---- file input for img ---- -->
            <input class="form__inputs-input input-file" type="file" name="userfile" id="featured_image" multiple>
            <select class="form__inputs-input" name="topic_id" id="topic_id">
              <?php if(empty($topics)): ?>
                <option value="" selected disabled>LA CAJAS DE TEMAS ESTA VACÍA :C</option>
              <?php else: ?>
                <option value="" selected disabled>SELECCIONA UN TEMA</option>
              <?php endif ?>
              <?php foreach ($topics as $topic) : ?>
                <option value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
              <?php endforeach ?>
            </select>
            <textarea class="form__inputs-input input-textarea" name="body" id="bodytext" cols="30" rows="10" placeholder="Cuerpo de la Noticia"><?php echo $body ?></textarea>

            <!-- Only admin users can view publish input field -->
            <?php if ($_SESSION['user']['role'] == "Admin") : ?>
              <!-- display checkbox according to whether post has been published or not -->
              <?php if ($published == true) : ?>
                <div class="checkbox d-flex"><label class="form__inputs-label" for="publish">Publicado</label><input class="form__inputs-checkbox" type="checkbox" name="publish" id="publish" value="1" checked="checked"></div>
              <?php else : ?>
                <div class="checkbox d-flex"><label class="form__inputs-label" for="publish">Publicar</label><input class="form__inputs-checkbox" type="checkbox" name="publish" id="publish" value="1"></div>
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
    <!-- ---- ckeditor ----  -->
    <script>
      CKEDITOR.replace('bodytext');
    </script>

  </body>

</html>