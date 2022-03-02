<?php if (isset($_SESSION['message'])) : ?>
    <div class="message">
        <span class="message__text">
            <?php echo $_SESSION['message']; unset($_SESSION['message']);?>
        </span>
    </div>
<?php endif ?>