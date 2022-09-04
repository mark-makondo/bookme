<?php
    $title = 'Lorem ipsum dolor it';
    $description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus voluptates nam ducimus fugiat dolorum dicta at vero. Sapiente cum.';
    $image = 'images/about/about.jpg';

    $data = [
        [
            'image' => "images/about/hotel.svg",
            'title' => "100+ ROOMS"
        ],
        [
            'image' => "images/about/customers.svg",
            'title' => "200+ CUSTOMERS"
        ],
        [
            'image' => "images/about/rating.svg",
            'title' => "150+ REVIEWS"
        ],
        [
            'image' => "images/about/staff.svg",
            'title' => "500+ STAFFS"
        ],
    ]
?>

<section>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3"><?=$title?></h3>
                <p><?=$description?></p>
            </div>
            <div class="col-lg-6 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
                <img class='w-100' src="<?=$image?>" alt="about me">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php foreach($data as $key => $value): ?>
                <div class="col-lg-3 col-md-6 mb-4 px-4">
                    <div class="bg-white rounded shadow p-4 border-top border-4 text-center box h-100">
                        <img src="<?=$value['image']?>" alt="hotel" width="70px">
                        <h4 class="mt-3"><?=$value['title']?></h4>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>