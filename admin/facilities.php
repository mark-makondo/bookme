<?php
    include "inc/essentials.php";
    include 'inc/db_config.php';
    
    verifyUserDashboard();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "inc/head-meta.php" ?>
        <title>Admin Panel - Facilities</title>

        <?php include "inc/links.php" ?>

        <?php include "inc/scripts.php" ?>
        <script src="js/facilities-script.js" defer></script>
    </head>
    <body class="bg-light admin-panel-facilities">
        <?php include 'inc/header.php' ?>
        <div class="container-fluid admin-panel-facilities__main-content" id="admin-panel-content">
            <div class="row main-content">
                <div class="col-lg-10 ms-auto p-4">

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title mb-0">Facilities</h5>
                                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#facilities-modal-setting">
                                    <span class="d-flex gap-1 align-items-center justify-content-between"><i class="bi bi-plus-square"></i> Add</span>
                                </button>
                            </div>
                            
                            <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                                <table class="table table-hover border">
                                    <thead class="sticky-top">
                                        <tr class="bg-dark text-light">
                                            <th scope="col">#</th>
                                            <th scope="col">Icon</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="facility-table-body">
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

<!-- FACILTIIES MODAL -->
<div class="modal fade" id="facilities-modal-setting" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form name="facilities-modal-setting-form" id="facilities-modal-setting-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="facility-name" class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Icon</label>
                        <input type="file" accept="[.svg]" name="facility-icon" class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea type="text" name="facility-description" class="form-control shadow-none" rows='3'></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>