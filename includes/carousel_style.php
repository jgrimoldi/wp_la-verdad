<style>
    .item-1 {
        z-index: 2;
        opacity: 1;
    }

    <?php
    foreach ($imgsPost as $key => $imgPost) :
        if ($key == 2) {
            break;
        }
        echo '.item-';
        echo  $key + 1 . '{';
        echo  'background: url(' . BASE_URL . 'static/img/uploads/';
        echo   $imgPost . ');';
        echo  'background-size: contain;';
        echo  'background-repeat: no-repeat;';
        echo  'background-position: center;';

        echo '}';
    endforeach
    ?>
</style>