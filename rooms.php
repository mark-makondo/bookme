<?php
  include 'admin/inc/db_config.php';
  include 'admin/inc/essentials.php';

  $rooms = select('SELECT * FROM `rooms` WHERE `status`=? ORDER BY `sr_no` DESC', [1], 'i');
  $roomImages = selectAll('room_images');
  $images = mysqli_fetch_all($roomImages, MYSQLI_ASSOC);
  $path = ROOMS_IMG_PATH;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'inc/head-meta.php' ?>
        <?php include 'inc/links.php' ?>
        <?php include 'inc/scripts.php' ?>

    </head>
    <body class="p-rooms bg-light">
        <?php include 'inc/header.php' ?>
        <div class="main-content">
            <?php include 'page-sections/rooms/header.php' ?>
            <?php include 'page-sections/rooms/items.php' ?>
            <?php include 'inc/footer.php' ?>
        </div>
    </body>
</html>