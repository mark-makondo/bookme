<?php
    $q = selectAll('team_Details');
?>

<section class="container px-4">
    <h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3>
    <div class="swiper management-swiper-container">
        <div class="swiper-wrapper mb-5" id="management-swiper-items">
            <?php while($row = mysqli_fetch_assoc($q)) : ?>
                <div class="swiper-slide bg-white text-center overflow-hidden">
                    <img src="images/members/<?=$row['picture']?>" class="w-100 d-block"/>
                    <h5 class="mt-2"><?=$row['name']?></h5>
                </div>
            <?php endwhile?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>