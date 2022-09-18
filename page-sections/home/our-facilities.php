<?php
    $query = selectAll('facilities');
    $path = FACILITIES_IMG_PATH;
?>

<section class="our-facilities">
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>

    <div class="container mt-5">
        <div class="row justify-content-evenly gap-1">
            <?php while($facility = mysqli_fetch_assoc($query)): ?>
                <div class="col-lg-2 col-md-3 text-center bg-white rounded shadow py-4 my-3" style="max-width:350px;">
                    <img class="p-md-1" src="<?=$path?><?=$facility['icon']?>" width="55px"  class="card-img-top">
                    <h5 class="mt-3"><?=$facility['name']?></h5>
                </div>
            <?php endwhile; ?>
            
            <div class="col-lg-12 text-center mt-5">
                <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facility</a>
            </div>
        </div>
    </div>
</section>