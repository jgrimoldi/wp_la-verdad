    <?php include('../config.php') ?>
    <?php include(ROOT_PATH . '/includes/signin.php') ?>
    <?php include(ROOT_PATH . '/admin/includes/head_section.php') ?>
    <?php if (isset($_SESSION['user'])) : ?>
        <!-- ---- css ---- -->
        <link rel="stylesheet" href="<?php echo BASE_URL . 'admin/static/css/main.css' ?>" />
        <!-- ---- title ---- -->
        <title>La Verdad | Dashboard </title>
    <?php else : ?>
        <title>La Verdad | Iniciar Sesión </title>
    <?php endif ?>
    </head>

    <?php if (isset($_SESSION['user'])) : ?>
        <?php include(ROOT_PATH . '/admin/includes/dashboard.php') ?>
    <?php else : ?>
        <body>
            <main>
                <section class="container h-100 middle-align">
                    <div class="login">
                        <div class="login__info d-flex">
                            <h1 aria-label="La Verdad"><img src="<?php echo BASE_URL . 'admin/static/img/isologo.svg' ?>" alt="Logo La Verdad"></h1>
                            <h2 class="login__info-title">Bienvenido a La Verdad!</h2>
                            <p class="login__info-text">Ingrese aquí sus credenciales</p>
                        </div>
                        <form action="index.php" method="post" class="login__form d-flex">
                            <input type="text" name="username" id="username" placeholder="Usuario" value="<?php echo $username ?>" />
                            <input type="password" name="password" id="password" placeholder="Contraseña" />
                            <input class="btn-submit" type="submit" name="login_btn" id="login_btn" value="Iniciar Sesión" />
                        </form>
                        <div class="error">
                            <?php include(ROOT_PATH . '/includes/errors.php') ?>
                        </div>
                    </div>
                </section>
            </main>
        </body>
    <?php endif ?>