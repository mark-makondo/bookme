<?php
    include "inc/essentials.php";
    include 'inc/db_config.php';
    
    verifyUserDashboard();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "inc/head-meta.php" ?>
        <title>Admin Panel - Carousel</title>

        <?php include "inc/links.php" ?>
        <link rel="stylesheet" href="stylesheet/carousel.css">
        
        <?php include "inc/scripts.php" ?>
        <script src="js/carousel-script.js" defer></script>
    </head>
    <body class="bg-light admin-panel-carousel">
        <?php include 'inc/header.php' ?>
        <div class="container-fluid admin-panel-dashboard__main-content" id="admin-panel-content">
            <div class="row main-content">
                <div class="col-lg-10 ms-auto p-4">
                    <h3 class="mb-4">CAROUSEL</h3>
                    <div class="card general-settings border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title mb-0">Images</h5>
                                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#carousel-modal">
                                    <span class="d-flex gap-1 align-items-center justify-content-between"><i class="bi bi-plus-square"></i> Add</span>
                                </button>
                            </div>
                            <div class="row" id="carousel-data">
                                <!-- LOGIC DATA WILL AUTO INSERT VALUES HERE -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<!-- CAROUSEL MODAL -->
<div class="modal fade" id="carousel-modal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form name="carousel-form-modal" id="carousel-modal-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Picture</label>
                        <input type="file" accept="[.jpg, .png, .webp, .jpeg]" name="carousel_picture" class="form-control shadow-none" id="carousel-picture-input" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="onAddImageModalCancel(carousel_picture)" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>