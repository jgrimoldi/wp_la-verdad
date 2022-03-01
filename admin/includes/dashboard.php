<body id="body">
    <!-- ---- collapsible ----  -->
    <?php include(ROOT_PATH . '/admin/includes/aside.php') ?>
    <!-- ---- main ---- -->
    <main>
      <section class="container">
        <h2 class="container-title">Dashboard</h2>
        <div class="container__content">
          <div class="sponsors d-flex">
            <label for="img">
              <div class="sponsor add-sponsor">
              <input type="file" name="img" id="img">
              <i class="fas fa-plus"></i>
            </div>
            </label>
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

