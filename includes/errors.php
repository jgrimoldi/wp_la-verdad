<?php if(count($errors) > 0) : ?>
    <?php foreach($errors as $error): ?>
        <span class="error__text"><?php echo $error ?></span>
    <?php endforeach ?>
<?php endif ?>
