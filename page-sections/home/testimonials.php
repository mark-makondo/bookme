<?php
    $testimonials = [
        [
            "rating" => 5,
            "name" => "Anonymous",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni iste minima animi obcaecati voluptatibus? In minus"
        ],
        [
            "rating" => 2,
            "name" => "Anonymous 2",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni iste minima animi obcaecati voluptatibus? In minus"
        ],
        [
            "rating" => 4,
            "name" => "Anonymous 3",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni iste minima animi obcaecati voluptatibus? In minus"
        ],
    ];
?>

<section class="testimonials">
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TESTIMONIALS</h2>

    <div class="container">
        <div class="swiper testimonials-swiper-container">
            <div class="swiper-wrapper mb-5">
                <?php foreach($testimonials as $key=>$testimonial): ?>
                    <div class="swiper-slide bg-white p-4" key="slide-<?=$key?>">
                        <div class="profile d-flex align-items-center mb-3">
                            <i class="bi bi-star-fill fs-5"></i>
                            <h6 class="m-0 ms-2"><?=$testimonial["name"]?></h6>
                        </div>
                        <p><?=$testimonial["description"]?></p>
                        <div class="rating">
                            <?php for ($testimonialIndex=0; $testimonialIndex <= $testimonial["rating"]; $testimonialIndex++):?>
                                <i class="bi bi-star-fill text-warning"></i>
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="col-lg-12 text-center mt-5">
        <a href="about.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Know More</a>
    </div>
</section>