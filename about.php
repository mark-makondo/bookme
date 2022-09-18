<?php
  include 'admin/inc/db_config.php';
  include 'admin/inc/essentials.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'inc/head-meta.php' ?>
        <title><?=$setting['site_title']?> - About</title>
        
        <?php include 'inc/links.php' ?>
        <link href="stylesheet/about.css" rel="stylesheet" type="text/css">

        <?php include 'inc/scripts.php' ?>
    </head>
    <body class="p-about bg-light">
        <?php include 'inc/header.php' ?>
        <div class="main-content">
            <?php include 'page-sections/about/header.php' ?>
            <?php include 'page-sections/about/content.php' ?>
            <?php include 'page-sections/about/management.php' ?>
            <?php include 'inc/footer.php' ?>
        </div>
    </body>
</html>