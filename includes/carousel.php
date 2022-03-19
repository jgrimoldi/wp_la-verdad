<div class="post__imgs">
    <?php foreach ($imgsPost as $key => $imgPost) : ?>
        <?php echo count($imgsPost) ?>
        <span id="item-<?php echo $key + 1 ?>" class="item"></span>

        <div class="carousel-item item-<?php echo $key + 1 ?>">
            <a href="#item-<?php if ($key == 0) {
                                echo count($imgsPost);
                            } else if ($key == count($imgsPost)) {
                                echo 1;
                            } else {
                                echo $key;
                            } ?>" class="arrow-prev arrow"></a>
            <a href="#item-<?php echo $key + 2 ?>" class="arrow-next arrow"></a>
        </div>
    <?php endforeach ?>
</div>