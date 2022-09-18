<?php
    include 'admin/inc/db_config.php';
    include 'admin/inc/essentials.php';

    if(!isset($_GET['id'])) {
        redirect('rooms.php');
    }

    $data = filteration($_GET);
    $id = $data['id'];
    $activeRoom = 1;

    $rooms = select('SELECT * FROM `rooms` WHERE `sr_no`=? AND `status`=?', [$id, $activeRoom], 'ii');

    if(mysqli_num_rows($rooms)==0) {
        redirect('rooms.php');
    }

    $room = mysqli_fetch_assoc($rooms);
    $images = select('SELECT `image` FROM `room_images` WHERE `room_id`=?', [$id], 'i');
    $path = ROOMS_IMG_PATH;
    $index = 0;

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

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'inc/head-meta.php' ?>

        <title><?=$setting['site_title']?> - <?=$room['name']?></title>

        <?php include 'inc/links.php' ?>
        <?php include 'inc/scripts.php' ?>
    </head>
    <body class="p-rooms bg-light">
        <?php include 'inc/header.php' ?>
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 my-5 mb-4 px-4">
                        <h2 class="fw-bold"><?=$room['name']?></h2>
                        <div style='font-size: 14px;'>
                            <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                            <span class="text-secondary"> > </span>
                            <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
                            <span class="text-secondary"> > </span>
                            <a href="#" class="text-secondary text-decoration-none" style="text-transform: uppercase;"><?=$room['name']?></a>
                        </div>
                    </div>
                    
                    <div class="col-lg-7 col-md-12 px-4">
                        <div id="roomCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                            <div class="carousel-inner h-100">
                                <?php 
                                    if(mysqli_num_rows($images) <=0) {
                                        $source = $path."thumbnail.jpg";
                                        echo <<< def
                                            <div class="carousel-item h-100 active">
                                                <img src="$source" class="d-block w-100 rounded h-100" alt="">
                                            </div>
                                        def;
                                    }
                                ?>
                                <?php while($img = mysqli_fetch_assoc($images)): ?>
                                    <div class="carousel-item h-100 <?=$index == 0 ? "active" : ""?>">
                                        <img src="<?=$path.$img['image']?>" class="d-block w-100 rounded h-100" alt="">
                                    </div>
                                    <?=$index++?>
                                <?php endwhile; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                                    
                    <div class="col-lg-5 col-md-12 px-4">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <h4><?=$room['price']?>/ Night</h4>
                                <div class="rating mb-3">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </div>
                                <div class="features mb-3">
                                    <h6 class="mb-1">Features</h6>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <?php
                                            $featuresQ = "SELECT `name` from `features` f INNER JOIN `room_features` rf ON f.sr_no = rf.feature_id WHERE rf.room_id=?";
                                            $features = select($featuresQ,[$id],'i');

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
                                            $facilities = select($facilitiesQ,[$id],'i');
                                            
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
                                <div class="area mb-3">
                                    <h6 class="mb-1">Area</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        <?=$room['area']?> sq. meter
                                    </span>
                                </div>     
                                <a href="<?=$id?>" class="btn w-100 text-white w-100 custom-bg shadow-none">Book Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 px-4 mt-4 room-description">
                        <div class="mb-4">
                            <h5>Description</h5>
                            <p>
                                <?=$room['description']?>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 px-4 room-review-rating">
                        <h5 class="mb-4">Reviews & Rating</h5>
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
                </div>
            </div>
            <?php include 'inc/footer.php' ?>
        </div>
    </body>
</html>