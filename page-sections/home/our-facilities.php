<?php
    $facilities = [
        [
            'title' => 'Facility 1',
            "image" => 'images/facilities/1.svg',
        ],
        [
            'title' => 'Facility 2',
            "image" => 'images/facilities/2.svg',
        ],
        [
            'title' => 'Facility 2',
            "image" => 'images/facilities/3.svg',
        ],
        [
            'title' => 'Facility 2',
            "image" => 'images/facilities/4.svg',
        ],
        [
            'title' => 'Facility 2',
            "image" => 'images/facilities/5.svg',
        ],
        [
            'title' => 'Facility 2',
            "image" => 'images/facilities/6.svg',
        ],
    ];
?>

<section class="our-facilities">
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>

    <div class="container mt-5">
        <div class="row justify-content-evenly gap-1">
            <?php foreach($facilities as $key => $facility): ?>
                <div class="col-lg-2 col-md-3 text-center bg-white rounded shadow py-4 my-3" style="max-width:350px;">
                    <img class="p-md-1" src="<?=$facility['image']?>" width="55px"  class="card-img-top">
                    <h5 class="mt-3"><?=$facility['title']?></h5>
                </div>
            <?php endforeach; ?>
            
            <div class="col-lg-12 text-center mt-5">
                <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facility</a>
            </div>
        </div>
    </div>
</section>