<?php
    $q = selectAll('carousel');
    $path = CAROUSEL_IMG_PATH;
?>

<section class="carousel container-fluid px-lg-4 mt-4">
    <div class="swiper carousel-swiper-container">
        <div class="swiper-wrapper">
            <?php while($row = mysqli_fetch_assoc($q)): ?>
                <div class="swiper-slide" key="slide-<?=$row['sr_no']?>">
                    <img src="<?=$path?><?=$row['image']?>" class="w-100 d-block"/>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>