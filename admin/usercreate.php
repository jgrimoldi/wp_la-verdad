    <?php include('../config.php') ?>
    <?php include(ROOT_PATH . '/admin/includes/admin_functions.php') ?>
    <?php include(ROOT_PATH . '/admin/includes/head_section.php') ?>
    <?php include(ROOT_PATH . '/admin/includes/admin_styles.php') ?>
    <?php $roles = ['Admin', 'Author'] ?>
    <title>Admin | Crear Usuario </title>
    </head>

    <body id="body">
      <!-- ---- collapsible ----  -->
      <?php include(ROOT_PATH . '/admin/includes/aside.php') ?>
      <!-- ---- content ---- -->
      <main>
        <section class="container">
          <?php if ($isEditingUser === true) : ?>
            <h2 class="container-title">Actualizar Usuario</h2>
          <?php else : ?>
            <h2 class="container-title">Crear Usuario</h2>
          <?php endif ?>
          <div class="form ptrem">
            <form action="<?php echo BASE_URL . '/admin/usercreate.php' ?>" method="POST" class="form__inputs d-flex">
              <input class="form__inputs-input" type="text" name="username" id="username" placeholder="Nombre de Usuario" value="<?php echo $username ?>">
              <input class="form__inputs-input" type="email" name="email" id="email" placeholder="Correo Electrónico" value="<?php echo $email ?>" autocomplete="off">
              <input class="form__inputs-input" type="password" name="password" id="password" placeholder="Contraseña" autocomplete="new-password">
              <input class="form__inputs-input" type="password" name="password_verify" id="password_verify" placeholder="Repetir Contraseña" autocomplete="repeat-new-password">
              <select class="form__inputs-input" name="role">
                <option value="" selected disabled>Elegí un Rol</option>
                <?php foreach ($roles as $key => $role) : ?>
                  <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                <?php endforeach ?>
              </select>
              <?php if ($isEditingUser === true) : ?>
                <input class="form__inputs-input btn-submit" type="submit" name="update_admin" id="update_admin" value="Actualizar Usuario">
              <?php else : ?>
                <input class="form__inputs-input btn-submit" type="submit" name="create_admin" id="create_admin" value="Nuevo Usuario">
              <?php endif ?>
            </form>
            <div class="error">
              <?php include(ROOT_PATH . '/includes/errors.php') ?>
            </div>
          </div>
        </section>
      </main>
      <?php include(ROOT_PATH . '/admin/includes/footer_section.php') ?>
    </body>

    </html>