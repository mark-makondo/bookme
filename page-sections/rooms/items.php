<div class="container">
    <div class="row">
        <?php include 'filters.php'?>

        <div class="col-lg-9 col-md-12 px-4">
            <?php while($room = mysqli_fetch_assoc($rooms)):?>
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <?php
                                $img = findItem($images, fn($data)=> 
                                    ($data['room_id'] ==  $room['sr_no']) && ($data['thumb'] == 1));
                                $path = ROOMS_IMG_PATH;
                                
                                if(isset($img['image'])) 
                                    $img = $img['image'];
                                else
                                    $img = 'thumbnail.jpg';

                                echo <<< data
                                    <img src="$path$img" class="img-fluid rounded" alt=""">
                                data;
                            ?>
                        </div>
                        <div class="col-md-5 px-lg-3 px-md-3 px-0 gap-2">
                            <h5><?=$room['name']?></h5>
                            <div class="features mb-3">
                                <h6 class="mb-1">Features</h6>
                                <div class="d-flex gap-1 flex-wrap">
                                    <?php
                                        $featuresQ = "SELECT `name` from `features` f INNER JOIN `room_features` rf ON f.sr_no = rf.feature_id WHERE rf.room_id=?";
                                        $features = select($featuresQ,[$room['sr_no']],'i');

                                        while($row = mysqli_fetch_assoc($features)) {
                                            $feature = $row['name'];
                                            echo <<<data
                                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                                $feature
                                                </span>
                                            data;
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="facilities mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                <div class="d-flex gap-1 flex-wrap">
                                    <?php
                                        $facilitiesQ = "SELECT `name` from `facilities` f INNER JOIN `room_facilities` rf ON f.sr_no = rf.facilities_id WHERE rf.room_id=?";
                                        $facilities = select($facilitiesQ,[$room['sr_no']],'i');
                                        
                                        while($row = mysqli_fetch_assoc($facilities)) {
                                            $facility = $row['name'];
                                            echo <<<data
                                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                                $facility
                                                </span>
                                            data;
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="guests mb-3">
                                <h6 class="mb-1">Guests</h6>
                                <div class="d-flex gap-1 flex-wrap">
                                    <span class="badge rounded-pill bg-light text-dark text-wrap"><?=$room['adult']?> Adults</span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap"><?=$room['children']?> Children</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <h6 class="mb-4"><?=$room['price']?>/ Night</h6>
                            <?php if($isShutdown) :?>
                                <button class="btn btn-sm text-white w-100 btn-secondary shadow-none mb-2" disabled><i class="bi bi-x-circle-fill"></i> Unavailable</button>
                            <?php else: ?>
                                <a href="<?=$room["sr_no"]?>" class="btn btn-sm text-white w-100 custom-bg shadow-none mb-2">Book Now</a>
                            <?php endif?>
                            <a href="room-details.php?id=<?=$room["sr_no"]?>" class="btn btn-sm btn-outline-dark w-100 shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile;?>
        </div>
    </div>
</div>