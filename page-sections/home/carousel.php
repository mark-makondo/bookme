<?php
    $images = [
        "images/carousel/IMG_15372.png", 
        "images/carousel/IMG_40905.png", 
        "images/carousel/IMG_55677.png", 
        "images/carousel/IMG_62045.png", 
        "images/carousel/IMG_93127.png", 
        "images/carousel/IMG_99736.png"
    ];
?>

<section class="carousel container-fluid px-lg-4 mt-4">
    <div class="swiper carousel-swiper-container">
        <div class="swiper-wrapper">
            <?php foreach($images as $key=>$value): ?>
                <div class="swiper-slide" key="slide-<?=$key?>">
                    <img src="<?=$value?>" class="w-100 d-block"/>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>