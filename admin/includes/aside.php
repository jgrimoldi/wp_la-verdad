    <!-- ---- collapisble button ---- -->
    <header class="menu d-flex">
        <div id="collapse" class="menu__icon d-flex">
            <i class="fas fa-bars"></i>
        </div>
    </header>

    <!-- ---- sidebar ---- -->
    <aside class="navbar d-flex">
        <div class="navbar__logo">
            <picture>
                <source media="(max-width: 100px)" srcset="<?php echo BASE_URL . 'admin/static/img/isotipo.svg' ?>"/>
                <source media="(min-width: 200px)" srcset="<?php echo BASE_URL . 'admin/static/img/logotipo.svg' ?>"/>
                <img src="<?php echo BASE_URL . 'admin/static/img/logotipo.svg' ?>" alt="La Verdad" />
            </picture>
        </div>
        <div class="navbar__links">
            <a href="<?php echo BASE_URL . 'admin/index.php' ?>">
                <div class="link d-flex selected">
                    <i class="fas fa-th-large" title="Dashboard"></i>
                    <h4>Dashboard</h4>
                </div>
            </a>
            <!-- Only admin users can view publish input field -->
            <!-- <?php if ($_SESSION['user']['role'] == "Admin") : ?> -->
            <a href="<?php echo BASE_URL . 'admin/usercreate.php' ?>">
                <div class="link d-flex">
                    <i class="fas fa-user-plus" title="Crear Usuario"></i>
                    <h4>Crear Usuario</h4>
                </div>
            </a>
            <!-- <?php endif ?> -->
            <a href="<?php echo BASE_URL . 'admin/postcreate.php' ?>">
                <div class="link d-flex">
                    <i class="fas fa-folder-plus" title="Crear Post"></i>
                    <h4>Crear Post</h4>
                </div>
            </a>
            <a href="<?php echo BASE_URL . 'admin/topics.php' ?>">
                <div class="link d-flex">
                    <i class="fas fa-plus" title="Crear Tema"></i>
                    <h4>Crear Tema</h4>
                </div>
            </a>
            <!-- Only admin users can view publish input field -->
            <!-- <?php if ($_SESSION['user']['role'] == "Admin") : ?> -->
            <a href="<?php echo BASE_URL . 'admin/usermanager.php' ?>">
                <div class="link d-flex">
                    <i class="fas fa-user-cog" title="Administrar Usuarios"></i>
                    <h4>Administrar Usuarios</h4>
                </div>
            </a>
            <!-- <?php endif ?> -->
            <a href="<?php echo BASE_URL . 'admin/postmanager.php' ?>">
                <div class="link d-flex">
                    <i class="fas fa-wrench" title="Administrar Posteos"></i>
                    <h4>Administrar Posteos</h4>
                </div>
            </a>
            <!-- <a href="#">
          <div class="link d-flex">
            <i class="fas fa-cogs" title="Administrar Temas"></i>
            <h4>Administrar Temas</h4>
          </div>
        </a> -->
        </div>
        <div class="navbar__profile">
            <a href="#">
                <div class="link d-flex">
                    <i class="fas fa-user" title="Username"></i>
                    <h4><?php echo $_SESSION['user']['username'] ?></h4>
                </div>
            </a>
            <a class="theme" href="#">
                <div class="link d-flex">
                    <i class="fas fa-cog" title="Tema"></i>
                    <h4>Tema</h4>
                </div>
            </a>
            <a href="<?php echo BASE_URL . 'admin/includes/logout.php' ?>">
                <div class="link d-flex">
                    <i class="fas fa-sign-out-alt" title="Cerrar Sesión"></i>
                    <h4>Cerrar Sesión</h4>
                </div>
            </a>
        </div>
    </aside>
    <div class="theme__chooser hide-chooser">
        <div data-theme="original" class="switch" id="switch-0">Original</div>
        <div data-theme="high-contrast" class="switch" id="switch-1">Contraste</div>
        <div data-theme="black" class="switch" id="switch-2">Negro</div>
        <div data-theme="pink" class="switch" id="switch-3">Rosa</div>
        <div data-theme="blue" class="switch" id="switch-4">Azul</div>
    </div>