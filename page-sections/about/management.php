<?php
    $roles =[
        [
            'name' => 'Team 1',
            'image' => 'images/about/team.jpg'
        ],
        [
            'name' => 'Team 2',
            'image' => 'images/about/team.jpg'
        ],
        [
            'name' => 'Team 3',
            'image' => 'images/about/team.jpg'
        ],
        [
            'name' => 'Team 4',
            'image' => 'images/about/team.jpg'
        ],
    ];
?>

<section class="container px-4">
    <h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3>
    <div class="swiper management-swiper-container">
        <div class="swiper-wrapper mb-5">
            <?php foreach($roles as $key=>$role): ?>
                <div class="swiper-slide bg-white text-center overflow-hidden" key="slide-<?=$key?>">
                    <img src="<?=$role['image']?>" class="w-100 d-block"/>
                    <h5 class="mt-2"><?=$role['name']?></h5>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>