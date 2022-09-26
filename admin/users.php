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
        <link rel="stylesheet" href="stylesheet/dashboard.css">

        <?php include "inc/scripts.php" ?>
        <script src="js/users-script.js" defer></script>
    </head>
    <body class="bg-light admin-panel-dashboard">
        <?php include 'inc/header.php' ?>
        <div class="container-fluid admin-panel-dashboard__main-content" id="admin-panel-content">
            <div class="row main-content">
                <div class="col-lg-10 ms-auto p-4">
                    <h3 class="mb-4">USERS</h3>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <input type="text" oninput="onUserSearch(this.value)" class="form-control shadow-none w-25 ms-auto mb-3" placeholder="Search users">
                            <div class="table-responsive" style="height: 450px;">
                                <table class="table table-hover border" style="min-width: 1300px; overflow: scroll;">
                                    <thead class="sticky-top">
                                        <tr class="bg-dark text-light">
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Birthday</th>
                                            <th scope="col" style='text-align: center;'>Verified</th>
                                            <th scope="col" style='text-align: center;'>Status</th>
                                            <th scope="col" style='text-align: center;'>Date Created</th>
                                            <th scope="col" style='text-align: center;'>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="users-table-body">
                                        <!-- CONTENT WILL BE INSERTED HERE DYNAMICALLY -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>