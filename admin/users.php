<?php
    include "inc/essentials.php";
    include 'inc/db_config.php';
    
    verifyUserDashboard();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "inc/head-meta.php" ?>
        <title>Admin Panel - Users</title>

        <?php include "inc/links.php" ?>
        <?php include "inc/scripts.php" ?>
        
        <link rel="stylesheet" href="stylesheet/dashboard.css">
    </head>
    <body class="bg-light admin-panel-dashboard">
        <?php include 'inc/header.php' ?>
        <div class="container-fluid admin-panel-dashboard__main-content" id="admin-panel-content">
            <div class="row main-content">
                <div class="col-lg-10 ms-auto p-4">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas iusto error quibusdam facilis labore, 
                    libero laborum adipisci blanditiis? Quibusdam hic ratione sint non. Vitae sunt eos quidem vel incidunt ex!
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas iusto error quibusdam facilis labore, 
                    libero laborum adipisci blanditiis? Quibusdam hic ratione sint non. Vitae sunt eos quidem vel incidunt ex!
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas iusto error quibusdam facilis labore, 
                    libero laborum adipisci blanditiis? Quibusdam hic ratione sint non. Vitae sunt eos quidem vel incidunt ex!
                </div>
            </div>
        </div>
    </body>
</html>