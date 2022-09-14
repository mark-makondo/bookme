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
            <div class="row main-content">
                <div class="col-lg-10 ms-auto p-4">
                    <h3 class="mb-4">SETTINGS</h3>

                    <!-- GENERAL SETTINGS -->
                    <div class="card general-settings border-0 shadow-sm mb-4">
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
                    <div class="card shutdown-settings border-0 shadow-sm mb-4">
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

                    <!-- CONTACT SETTINGS -->
                    <div class="card general-settings border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title mb-0">Contact Settings</h5>
                                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#contact-setting-edit">
                                    <span class="d-flex gap-1 align-items-center justify-content-between"><i class="bi bi-pencil-square"></i> Edit</span>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <h6 class="card-subtitle mb-2 fw-bold">Address</h6>
                                        <p class="card-text" id="address"></p>
                                    </div>
                                    <div class="mb-4">
                                        <h6 class="card-subtitle mb-2 fw-bold">Google Map</h6>
                                        <p class="card-text" id="gmap"></p>
                                    </div>
                                    <div class="mb-4">
                                        <h6 class="card-subtitle mb-2 fw-bold">Phone Numbers</h6>
                                        <div class="d-flex flex-column gap-1">
                                            <p class="card-text m-0" id="phone">
                                                <i class="bi bi-telephone-fill"></i>
                                                <span id="pn1"></span>
                                            </p>
                                            <p class="card-text m-0" id="phone">
                                                <i class="bi bi-telephone-fill"></i>
                                                <span id="pn2"></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <h6 class="card-subtitle mb-2 fw-bold">Email</h6>
                                        <p class="card-text" id="email">
                                            <i class="bi bi-envelope-fill"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <h6 class="card-subtitle mb-2 fw-bold">Social Links</h6>
                                        <div class="d-flex flex-column gap-1">
                                            <p class="card-text mb-1" id="phone">
                                                <i class="bi bi-facebook"></i> 
                                                <span id="facebook"></span>
                                            </p>
                                            <p class="card-text mb-1" id="phone">
                                                <i class="bi bi-twitter"></i> 
                                                <span id="twitter"></span>
                                            </p>
                                            <p class="card-text" id="phone">
                                                <i class="bi bi-instagram"></i> 
                                                <span id="instagram"></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <h6 class="card-subtitle mb-1 fw-bold">iFrame</h6>
                                        <iframe id="iframe" class="border p-2 w-100" src="" frameborder="0" loading="lazy"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <!-- MANAGE TEAM SETTINGS -->
                    <div class="card general-settings border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title mb-0">Team Management</h5>
                                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-team-setting">
                                    <span class="d-flex gap-1 align-items-center justify-content-between"><i class="bi bi-plus-square"></i> Add</span>
                                </button>
                            </div>
                            <div class="row" id="team-data">
                                <!-- LOGIC DATA WILL AUTO INSERT VALUES HERE -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>

<!-- GENERAL SETTINGS MODAL -->
<div class="modal fade" id="general-setting-edit" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form name="form-settings" id="general-settings-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">View/Update General Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Site Title</label>
                            <input type="text" name="site_title" class="form-control shadow-none" id="site-title-content-input" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">About us</label>
                            <textarea name="site_about" class="form-control shadow-none" rows="6" id="site-about-content-input" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="onGeneralSettingsModalCancel(site_title, site_about)" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- CONTACT SETTINGS MODAL -->
<div class="modal fade" id="contact-setting-edit" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form name="form-contact-settings" id="contact-settings-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">View/Update Contact Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control shadow-none" id="email-input">
                            </div>
                            <div class="social-link mb-3">
                                <label class="form-label fw-bold">Phone Numbers (With Country Code)</label>
                                <div class="socials d-flex flex-column gap-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                        <input type="text" name="pn1" class="form-control shadow-none" id="pn1-input">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                        <input type="text" name="pn2" class="form-control shadow-none" id="pn2-input">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Google Map Link</label>
                                <input type="text" name="gmap" class="form-control shadow-none" id="gmap-input">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">iFrame Link</label>
                                <input type="text" name="iframe" class="form-control shadow-none" id="iframe-input">
                            </div>
                            <div class="social-link mb-3">
                                <label class="form-label fw-bold">Social Link</label>
                                <div class="socials d-flex flex-column gap-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                        <input type="text" name="facebook" class="form-control shadow-none" id="facebook-input">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                                        <input type="text" name="twitter" class="form-control shadow-none" id="twitter-input">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                        <input type="text" name="instagram" class="form-control shadow-none" id="instagram-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label fw-bold">Address</label>
                                <textarea type="text" name="address" class="form-control shadow-none" rows="4" id="address-input"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button 
                        type="button" 
                        onclick="onContactSettingsModalCancel(email, pn1, pn2, gmap, iframe, facebook, twitter, instagram, address)" 
                        class="btn text-secondary shadow-none" 
                        data-bs-dismiss="modal"
                    >CANCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- MANAGE TEAM SETTINGS MODAL -->
<div class="modal fade" id="add-team-setting" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form name="form-team-add-settings" id="manage-team-settings-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Team Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="member_name" class="form-control shadow-none" id="member-name-input" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Picture</label>
                            <input type="file" accept="[.jpg, .png, .webp, .jpeg]" name="member_picture" class="form-control shadow-none" id="member-picture-input" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="onAddTeamSettingsModalCancel(member_name, member_picture)" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>
