<?php
    include "inc/essentials.php";
    include 'inc/db_config.php';
    
    verifyUserDashboard();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "inc/head-meta.php" ?>
        <title>Admin Panel - Feaures</title>

        <?php include "inc/links.php" ?>
        <?php include "inc/scripts.php" ?>
        <script src="js/features-script.js" defer></script>
    </head>
    <body class="bg-light admin-panel-features">
        <?php include 'inc/header.php' ?>
        <div class="container-fluid admin-panel-features__main-content" id="admin-panel-content">
            <div class="row main-content">
                <div class="col-lg-10 ms-auto p-4">
                    <h3 class="mb-4">FEATURES</h3>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-end mb-3">
                                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#feature-modal-setting">
                                    <span class="d-flex gap-1 align-items-center justify-content-between"><i class="bi bi-plus-square"></i> Add</span>
                                </button>
                            </div>
                            <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                                <table class="table table-hover border">
                                    <thead class="sticky-top">
                                        <tr class="bg-dark text-light">
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="feature-table-body">
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

<!-- FEATURE MODAL -->
<div class="modal fade" id="feature-modal-setting" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form name="feature-modal-setting-form" id="feature-modal-setting-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Feature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="feature-name" class="form-control shadow-none" id="feature-name-input" required>
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