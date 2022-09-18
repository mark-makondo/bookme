<?php
    $path = ROOMS_IMG_PATH;
    $q = "SELECT * FROM `rooms` WHERE `status`=? ORDER BY `sr_no` DESC LIMIT 3";
    $rooms = select($q, [1], 'i');
    
    $roomImages = selectAll('room_images');
   
    $images = mysqli_fetch_all($roomImages, MYSQLI_ASSOC);
?>

<section class="our-rooms">
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>

    <div class="container">
        <div class="row">
            <?php while($room = mysqli_fetch_assoc($rooms)): ?>
                <div class="col-lg-4 col-md-6 my-3"> 
                    <div key="<?=$key?>" class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                        <?php
                            $img = findItem($images, fn($data)=> 
                                ($data['room_id'] ==  $room['sr_no']) && ($data['thumb'] == 1));
                            
                            if(isset($img['image'])) 
                                $img = $img['image'];
                            else
                                $img = 'thumbnail.jpg';

                            echo <<< data
                                <img src="$path$img" class="card-img-top" style="height: 12.5rem;">
                            data;
                        ?>
                        <div class="card-body">
                            <h5 class="card-title"><?=$room['name']?></h5>
                            <h6 class="mb-4"><?=$room['price']?>/ Night</h6>
                            <div class="features mb-3">
                                <h6 class="mb-1">Features</h6>
                                <?php
                                    $featuresQ = "SELECT `name` from `features` f INNER JOIN `room_features` rf ON f.sr_no = rf.feature_id WHERE rf.room_id=?";
                                    $features = select($featuresQ,[$room['sr_no']],'i');

                                    while($row = mysqli_fetch_assoc($features)) {
                                        $feature = $row['name'];
                                        echo <<<data
                                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">
                                               $feature
                                            </span>
                                        data;
                                    }
                                ?>
                            </div>
                            <div class="facilities mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                <?php
                                    $facilitiesQ = "SELECT `name` from `facilities` f INNER JOIN `room_facilities` rf ON f.sr_no = rf.facilities_id WHERE rf.room_id=?";
                                    $facilities = select($facilitiesQ,[$room['sr_no']],'i');
                                    
                                    while($row = mysqli_fetch_assoc($facilities)) {
                                        $facility = $row['name'];
                                        echo <<<data
                                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">
                                               $facility
                                            </span>
                                        data;
                                    }
                                ?>
                            </div>
                            <div class="guests mb-4">
                                <h6 class="mb-1">Guests</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap"><?=$room['adult']?> Adults</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap"><?=$room['children']?> Children</span>
                            </div>
                            <div class="ratings mb-4">
                                <h6 class="mb-1">Rating</h6>
                                <span class="badge rounded-pill bg-light">
                                    <?php for($ratingIndex = 0; $ratingIndex <= 5; $ratingIndex++): ?>
                                        <i key="<?=$ratingIndex?>" class="bi bi-star-fill text-warning"></i>
                                    <?php endfor;?>
                                </span>
                            </div>
                            <div class="d-flex justify-content-evenly gap-1 mb-2">
                                <a href="room-details.php?id=<?=$room['sr_no']?>" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                                <a href="room-details.php?id=<?=$room['sr_no']?>" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <div class="col-lg-12 text-center mt-5">
                <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms</a>
            </div>
        </div>
    </div>
</section>