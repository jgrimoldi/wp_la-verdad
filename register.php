    <?php include('config.php'); ?>
    <?php include(ROOT_PATH . '/includes/registration_login.php') ?>
    <?php include(ROOT_PATH . '/includes/head_section.php'); ?>
    <!-- ============== title ============== -->
    <title>La Verdad - Iniciar Sesión</title>
</head>

<body>
    <!-- ============== header ============== -->
    <?php include(ROOT_PATH . '/includes/navbar.php') ?>

    <!-- ============== articles ============== -->
    <main>
        <section class="container">
            <?php include(ROOT_PATH . '/includes/errors.php') ?>
        </section>
    </main>

    <!-- ============== footer ============== -->
    <?php include(ROOT_PATH . '/includes/footer.php') ?>

    <!-- ============== scripts ============== -->
    <?php require_once(ROOT_PATH . '/includes/scripts.php') ?>

</body>

</html>