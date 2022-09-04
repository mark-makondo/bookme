<?php
    $rooms = [
        [
            'title' => 'Room 1',
            "image" => 'images/rooms/1.jpg',
            "description" => 'Some quick example text to build on the card title and make up the bulk of the cards content',
            "link" => "#",
            "price" =>"500 PHP",
            "features" => ["2 Rooms", "1 Bathroom"],
            "facilities" => ["AC", "Wifi"],
            "ratings" => 4
        ],
        [
            'title' => 'Room 2',
            "image" => 'images/rooms/2.png',
            "description" => 'Some quick example text to build on the card title and make up the bulk of the cards content',
            "link" => "#",
            "price"=> "2000 PHP",
            "features" => ["2 Rooms", "1 Bathroom", "1 Sofa"],
            "facilities" => ["AC", "Wifi", "TV"],
            "ratings" => 1
        ],
        [
            'title' => 'Room 3',
            "image" => 'images/rooms/3.png',
            "description" => 'Some quick example text to build on the card title and make up the bulk of the cards content',
            "link" => "#",
            "price"=> "5000 PHP",
            "features" => ["1 Room", "1 Bathroom", "1 Balcony"],
            "facilities" => ["AC", "Wifi", "TV"],
            "ratings" => 3
        ],
        [
            'title' => 'Room 4',
            "image" => 'images/rooms/4.png',
            "description" => 'Some quick example text to build on the card title and make up the bulk of the cards content',
            "link" => "#",
            "price"=> "50000 PHP",
            "features" => ["4 Rooms", "4 Bathroom", "1 Balcony", "1 Sofa"],
            "facilities" => ["AC", "Wifi", "TV", "Netflix", "Cable"],
            "ratings" => 5
        ],
    ];
?>

<section class="our-rooms">
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>

    <div class="container">
        <div class="row">
            <?php foreach($rooms as $key => $room): ?>
                <div class="col-lg-4 col-md-6 my-3"> 
                    <div key="<?=$key?>" class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                        <img src="<?=$room['image']?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?=$room['title']?></h5>
                            <h6 class="mb-4"><?=$room['price']?>/ Night</h6>
                            <div class="features mb-3">
                                <h6 class="mb-1">Features</h6>
                                <?php foreach($room["features"] as $key => $feature): ?>
                                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">
                                        <?=$feature?>
                                    </span>
                                <?php endforeach;?>
                            </div>
                            <div class="facilities mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                <?php foreach($room["facilities"] as $key => $feature): ?>
                                    <span key="<?=$key?>" class="badge rounded-pill bg-light text-dark mb-3 text-wrap">
                                        <?=$feature?>
                                    </span>
                                <?php endforeach;?>
                            </div>
                            <div class="ratings mb-4">
                                <h6 class="mb-1">Rating</h6>
                                <span class="badge rounded-pill bg-light">
                                    <?php for($ratingIndex = 0; $ratingIndex <= $room["ratings"]; $ratingIndex++): ?>
                                        <i key="<?=$ratingIndex?>" class="bi bi-star-fill text-warning"></i>
                                    <?php endfor;?>
                                </span>
                            </div>
                            <div class="d-flex justify-content-evenly gap-1 mb-2">
                                <a href="<?=$value["link"]?>" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                                <a href="<?=$value["link"]?>" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="col-lg-12 text-center mt-5">
                <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms</a>
            </div>
        </div>
    </div>
</section>