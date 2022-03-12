    <?php include('../config.php') ?>
    <?php include(ROOT_PATH . '/admin/includes/admin_functions.php') ?>
    <?php include(ROOT_PATH . '/admin/includes/head_section.php') ?>
    <?php include(ROOT_PATH . '/admin/includes/admin_styles.php') ?>
    <?php $users = getAdminUsers() ?>
    <title>Admin | Administrar Usuario </title>
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
                    <?php if (empty($users)) : ?>
                        <h3 class="topics-title">No hay usuarios para mostrar.</h3>
                    <?php else : ?>
                        <div class="topics__table">
                            <div class="topics__table-row">
                                <div class="box">ID</div>
                                <div class="box">Username</div>
                                <div class="box">Correo</div>
                                <div class="box">Editar/Borrar</div>
                            </div>
                            <?php foreach ($users as $key => $user) : ?>
                                <div class="topics__table-row">
                                    <div class="box center"><?php echo $key + 1 ?></div>
                                    <div class="box"><?php echo $user['username'] ?></div>
                                    <div class="box"><?php echo $user['email'] ?></div>
                                    <div class="box action">
                                        <a href="usercreate.php?edit-admin=<?php echo $user['id'] ?>"><i class="fas fa-pencil"></i></a>
                                        <a href="usercreate.php?delete-admin=<?php echo $user['id'] ?>"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                    <?php include(ROOT_PATH . '/admin/includes/messages.php') ?>
                </div>
            </section>
        </main>
        <?php include(ROOT_PATH . '/admin/includes/footer_section.php') ?>
    </body>

    </html>