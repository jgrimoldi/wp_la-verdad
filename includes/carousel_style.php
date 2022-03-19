<style>
    .item-1 {
        z-index: 2;
        opacity: 1;
    }

    <?php 
        foreach ($imgsPost as $key => $imgPost) : 
            if($key == 2){
                break;
            }
                echo '.item-' . $key + 1 . '{';
                echo  'background: url(' . BASE_URL . 'static/img/uploads/' . $imgPost . ');';
                echo  'background-size: cover;';
                echo '}'; 
        endforeach 
        ?>
</style>