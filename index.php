<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotel Booking</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet">
        
        <!-- Google font: Merienda & Poppins -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- My CSS -->
        <link href="stylesheet/index.css" rel="stylesheet" type="text/css">

        <!-- SwiperJs -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>

        <!-- Bootstrap: JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous" defer></script>
        <!-- SwiperJs -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js" defer></script>

        <!-- My Scripts -->
        <script src="script/swiper.js" defer></script>
    </head>
    <body class="bg-light">
        <?php include 'navbar.php'; ?>
        <?php include 'carousel.php' ?>
        <?php include 'check-booking.php' ?>
        <?php include 'our-rooms.php' ?>
        <?php include 'our-facilities.php' ?>
        <?php include 'testimonials.php' ?>
        <?php include 'reach-us.php' ?>
        <?php include 'footer.php' ?>
        <h6 class="text-center bg-dark text-white p-3 m-0">Designed & Developed by MADD.Dev</h6>
    </body>
</html>