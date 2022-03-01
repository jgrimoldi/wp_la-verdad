<?php include('../config.php') ?>
    <?php // include(ROOT_PATH . '/admin/includes/admin_functions.php') ?>
    <?php include(ROOT_PATH . '/admin/includes/head_section.php') ?>
    <link rel="stylesheet" href="<?php echo BASE_URL . 'admin/static/css/main.css' ?>" />
    <title>La Verdad | Temas </title>
    </head>

    <body id="body">
      <!-- ---- collapsible ----  -->
      <?php include(ROOT_PATH . '/admin/includes/aside.php') ?>
      <!-- ---- content ---- -->
    <main>
    <!-- ---- topic create ---- -->
        <section class="container">
          <h2 class="container-title">Administrar Temas</h2>
            <div class="form ptrem">
              <form action="" method="POST" class="form__inputs d-flex">
                <?php if ($isEditingTopic === true): ?>
                  <input type="hidden" name="topic_id" value="<?php echo $topic_id ?>">
                <?php endif ?>
                <input class="form__inputs-input" type="text" name="topic_name" id="topic_name" placeholder="Nombre del Tema" value="<?php echo $topic_name ?>">
                <?php if ($isEditingTopic === true): ?> 
                    <input class="form__inputs-input btn-submit" type="submit" name="update_topic" id="update_topic" value="Actualizar Tema">
                <?php else: ?>
                    <input class="form__inputs-input btn-submit" type="submit" name="create_topic" id="create_topic" value="Guardar Nuevo Tema">
                <?php endif ?>
              </form>
              <div class="error">
                <?php include(ROOT_PATH . '/includes/errors.php') ?> 
              </div>
            </div>
        </section>
    <!-- ---- topic view ---- -->
        <section class="container">
            <div class="topics">
                <?php include(ROOT_PATH . '/includes/messages.php') ?>
                <?php if (empty($topics)): ?>
                    <h3 class="topics-title">No hay temas para mostrar.</h3>
                <?php else: ?>
                <div class="topics__table">
                    <div class="topics__table-row">
                        <div class="box">ID</div>
                        <div class="box">Tema</div>
                        <div class="box">Editar/Borrar</div>
                    </div>
                    <?php foreach ($topics as $key => $topic): ?>
                    <!-- <div class="topics__table-row">
                        <div class="box center">1</div>
                        <div class="box">Policiales</div>
                        <div class="box action">
                            <a href="topics.php?edit-topic=<?php // echo $topic['id'] ?>"><i class="fas fa-pencil"></i></a>
                            <a href="topics.php?delete-topic=<?php // echo $topic['id'] ?>"><i class="fas fa-trash"></i></a>
                        </div>
                    </div> -->
                    <div class="topics__table-row">
                      <div class="box center"><?php echo $key + 1 ?></div>
                      <div class="box"><?php echo $topic['name'] ?></div>
                      <div class="box action">
                          <a href="topics.php?edit-topic=<?php echo $topic['id'] ?>"><i class="fas fa-pencil"></i></a>
                          <a href="topics.php?delete-topic=<?php echo $topic['id'] ?>"><i class="fas fa-trash"></i></a>
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