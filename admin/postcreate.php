  <?php include('../config.php') ?>
  <?php include(ROOT_PATH . '/admin/includes/admin_functions.php') ?>
  <?php include(ROOT_PATH . '/admin/includes/post_functions.php') ?>
  <?php include(ROOT_PATH . '/admin/includes/head_section.php') ?>
  <?php include(ROOT_PATH . '/admin/includes/admin_styles.php') ?>
  <?php $topics = getAllTopics() ?>
  <title>Admin | Crear Noticias </title>
  </head>

  <body id="body">
    <!-- ---- collapsible ----  -->
    <?php include(ROOT_PATH . '/admin/includes/aside.php') ?>
    <!-- ---- content ---- -->
    <main>
      <section class="container">
        <?php if ($isEditingPost === true) : ?>
          <h2 class="container-title">Editar Noticias</h2>
        <?php else : ?>
          <h2 class="container-title">Crear Noticias</h2>
        <?php endif ?>
        <div class="form">
          <form action="<?php echo BASE_URL . 'admin/postcreate.php' ?>" method="POST" enctype="multipart/form-data" class="form__inputs d-flex">
            <?php if ($isEditingPost === true) : ?>
              <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
              <input type="hidden" name="f_image" value="<?php echo $featured_image ?>">
            <?php endif ?>

            <div class="checkbox d-flex">
              <label class="form__inputs-label" for="publish">¿Es un empleo?</label>
              <input class="form__inputs-checkbox" type="checkbox" name="job" id="job" value="0">
            </div>

            <input class="form__inputs-input" type="text" name="title" id="title" placeholder="Título de la Noticia" value="<?php echo $title ?>">
            <input class="form__inputs-input" type="text" name="subtitle" id="subtitle" placeholder="Subtítulo de la Noticia" value="<?php echo $subtitle ?>">
            <!-- ---- file input for img ---- -->
            <input class="form__inputs-input input-file" type="file" name="featured_image" id="featured_image">
            <select class="form__inputs-input" name="topic_id" id="topic_id">
              <?php if (empty($topics)) : ?>
                <option value="" selected disabled>LA CAJAS DE TEMAS ESTA VACÍA :C</option>
              <?php else : ?>
                <option value="0" selected disabled>SELECCIONA UN TEMA</option>
              <?php endif ?>
              <?php foreach ($topics as $topic) : ?>
                <option value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
              <?php endforeach ?>
            </select>
            <textarea class="form__inputs-input input-textarea" name="body" id="bodytext" cols="30" rows="10" placeholder="Cuerpo de la Noticia"><?php echo $body ?></textarea>
            <input style="display: none;" class="form__inputs-input" type="number" name="phone" id="phone" placeholder="Teléfono del Empleo">
            <input style="display: none;" class="form__inputs-input" type="mail" name="email" id="email" placeholder="Correo del Empleo">
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
    <?php include(ROOT_PATH . '/admin/includes/footer_section.php') ?>
    <!-- ---- ckeditor ----  -->
    <script>
      CKEDITOR.replace('bodytext');
    </script>
    <!-- ---- checkbox ---- -->
    <script src="<?php echo BASE_URL . 'admin/static/js/checkbox.js' ?>"></script>

  </body>

  </html>