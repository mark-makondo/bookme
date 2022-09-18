<?php
  include 'admin/inc/db_config.php';
  include 'admin/inc/essentials.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'inc/head-meta.php' ?>
        <title><?=$setting['site_title']?> - Home</title>

        <?php include 'inc/links.php' ?>
        <?php include 'inc/scripts.php' ?>
        
        <link href="stylesheet/home.css" rel="stylesheet" type="text/css">
    </head>
    <body class="p-home bg-light">
        <?php include 'inc/header.php' ?>
        <div class="main-content">
            <?php include 'page-sections/home/carousel.php' ?>
            <?php include 'page-sections/home/check-booking.php' ?>
            <?php include 'page-sections/home/our-rooms.php' ?>
            <?php include 'page-sections/home/our-facilities.php' ?>
            <?php include 'page-sections/home/testimonials.php' ?>
            <?php include 'page-sections/home/reach-us.php' ?>
            <?php include 'inc/footer.php' ?>
        </div>
    </body>
</html>