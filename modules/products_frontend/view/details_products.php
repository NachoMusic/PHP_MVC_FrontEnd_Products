<section >
    <div class="container">

        <?php
        if (isset($arrData) && !empty($arrData)) {
            ?>
            <div class="media">
                <div class="pull-left">
                    <img src="media/<?php echo $arrData['avatar']?>" class="img-product" >
                </div>
                <div class="media-body">
                    <h3 class="media-heading title-product"><?php echo $arrData['product_name'] ?></h3>
                    <p class="text-limited"><?php echo $arrData['product_description'] ?></p>
                    <br>
                    <h5 class="special"> <strong>Precio: <?php echo $arrData['product_price'] ?>€</strong> </h5>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</section>
