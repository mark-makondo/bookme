<?php
    include "inc/essentials.php";
    include 'inc/db_config.php';
    
    verifyUserDashboard();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "inc/head-meta.php" ?>
        <title>Admin Panel - Dashboard</title>

        <?php include "inc/links.php" ?>
        <?php include "inc/scripts.php" ?>
    </head>
    <body class="bg-light">
        <div class="container-fluid bg-dark text-light p-3 d-flex justify-content-between align-items-center">
            <h3 class="mb-0">ADMIN PANEL</h3>
            <a href="logout.php" class="btn btn-light btn-sm">LOG OUT</a>
        </div>
        <h1>I am dashboard</h1>
    </body>
</html>