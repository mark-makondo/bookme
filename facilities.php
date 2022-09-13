<?php
  include 'admin/inc/db_config.php';
  include 'admin/inc/essentials.php';

  $query = selectAll('facilities');
  $path = FACILITIES_IMG_PATH;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'inc/head-meta.php' ?>
        <?php include 'inc/links.php' ?>
        <?php include 'inc/scripts.php' ?>
                
        <link href="stylesheet/facilities.css" rel="stylesheet" type="text/css">
    </head>
    <body class="p-facilities bg-light">
        <?php include 'inc/header.php' ?>
        <div class="main-content">
            <div class="my-5 px-4">
                <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
                <div class="h-line bg-dark"></div>
                <p class="text-center mt-3">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Sed, quae. Rem ab sed quidem aperiam tenetur, veritatis libero suscipit sequi optio, 
                    exercitationem doloremque soluta. Unde, sunt. Corrupti necessitatibus laudantium nulla?
                </p>
            </div>
            
            <div class="container">
                <div class="row">
                    <?php while($facility = mysqli_fetch_assoc($query)): ?>
                        <div class="col-lg-4 col-md-6 mb-5 px-4">
                            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                                <div class="d-flex align-items-center mb-2 gap-2">
                                    <img src="<?=$path?><?=$facility['icon']?>" width="40px">
                                    <h5 class="m-0"><?=$facility['name']?></h5>
                                </div>
                                <p><?=$facility['description']?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            
            <?php include 'inc/footer.php' ?>
        </div>
    </body>
</html>