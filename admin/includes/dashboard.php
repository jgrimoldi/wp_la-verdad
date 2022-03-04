<?php include(ROOT_PATH . '/admin/includes/sponsors_functions.php') ?>
<?php $sponsors = getAllSponsors() ?>

<body id="body">
  <!-- ---- collapsible ----  -->
  <?php include(ROOT_PATH . '/admin/includes/aside.php') ?>
  <!-- ---- main ---- -->
  <main>
    <section class="container">
      <h2 class="container-title">Dashboard</h2>
      <div class="container__content">
        <div class="sponsors d-flex">
          <form action="<?php echo BASE_URL . 'admin/index.php' ?>" method="post" enctype="multipart/form-data">
            <label for="img">
              <!-- ---- save button ---- -->
              <label class="sponsor__upload-label" for="upload_sponsor"><i class="fas fa-save"></i></label>
              <input class="sponsor__upload" type="submit" name="upload_sponsor" id="upload_sponsor" value="Guardar">
              <!-- ---- add sponsors button ----  -->
              <div class="sponsor add-sponsor">
                <input type="file" name="files[]" id="img" multiple>
                <i class="fas fa-plus"></i>
              </div>
            </label>
          </form>
          <!-- ---- sponsors ----  -->
          <?php if (!empty($sponsors)) : ?>
            <?php foreach ($sponsors as $sponsor) : ?>
              <div class="sponsor add-sponsor">
                <img src="<?php echo BASE_URL . 'static/img/sponsors/' . $sponsor['filename'] ?>" alt="<?php echo $sponsor['image_text'] ?>">
                <a class="sponsor__edit" href="index.php?delete-sponsor=<?php echo $sponsor['id'] ?>"><i class="fas fa-trash"></i></a>
              </div>
            <?php endforeach ?>
          <?php endif ?>
        </div>
        <?php include(ROOT_PATH . '/admin/includes/messages.php') ?>
        <div class="error">
          <?php include(ROOT_PATH . '/includes/errors.php') ?>
        </div>
        <!-- ---- end sponsors ----  -->
      </div>
    </section>
  </main>
  <?php include(ROOT_PATH . '/admin/includes/footer_section.php') ?>
</body>