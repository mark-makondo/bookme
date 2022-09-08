<?php
    include "inc/essentials.php";
    include 'inc/db_config.php';
    
    verifyUserDashboard();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "inc/head-meta.php" ?>
        <title>Admin Panel - Settings</title>

        <?php include "inc/links.php" ?>
        <link rel="stylesheet" href="stylesheet/settings.css">

        <?php include "inc/scripts.php" ?>
        <script src="js/settings-script.js" defer></script>
    </head>
    <body class="bg-light admin-panel-settings">
        <?php include 'inc/header.php' ?>
        <div class="container-fluid admin-panel-dashboard__main-content" id="admin-panel-content">
            <div class="row">
                <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                    <h3 class="mb-4">SETTINGS</h3>

                    <!-- GENERAL SETTINGS -->
                    <div class="card general-settings border-0 shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title mb-0">General Settings</h5>
                                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-setting-edit">
                                    <span class="d-flex gap-1 align-items-center justify-content-between"><i class="bi bi-pencil-square"></i> Edit</span>
                                </button>
                            </div>
                            <div class="d-flex flex-column gap-2 ">
                                <div>
                                    <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                                    <p class="card-text" id="site-title-content"></p>
                                </div>
                                <div>
                                    <h6 class="card-subtitle mb-1 fw-bold">About us</h6>
                                    <p class="card-text" id="site-about-content"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SHUTDOWN SETTINGS -->
                    <div class="card shutdown-settings border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title mb-0">Shutdown Settings</h5>
                                <div class="form-check form-switch">
                                    <form>
                                        <input name="shutdown" onchange="onShutdownChange(this.value)" type="checkbox" class="form-check-input" id="shutdown-switch">
                                    </form>
                                </div>
                            </div>
                            <p class="card-text">
                                No customers will be allowed to book hotel room, when shutdown mode is turned on.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>


<!-- GENERAL SETTINGS MODAL -->

<div class="modal fade" id="general-setting-edit" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog">
        <form name="form-settings" onsubmit="e => e.preventDefault()">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">General Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Site Title</label>
                        <input type="text" name="site_title" class="form-control shadow-none" id="site-title-content-input">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">About us</label>
                        <textarea name="site_about" class="form-control shadow-none" rows="6" id="site-about-content-input"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="onGeneralSettingsModalCancel(site_title, site_about)" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                <button type="button" onclick="onGeneralSettingsModalSave(site_title.value, site_about.value, customAlert)" class="btn custom-bg text-white shadow-none">SUBMIT</button>
            </div>
            </div>
        </form>
    </div>
</div>