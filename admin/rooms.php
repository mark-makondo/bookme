<?php
    include "inc/essentials.php";
    include 'inc/db_config.php';
    
    verifyUserDashboard();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "inc/head-meta.php" ?>
        <title>Admin Panel - Rooms</title>

        <?php include "inc/links.php" ?>
        <?php include "inc/scripts.php" ?>

        <script src="js/rooms-script.js" defer></script>
    </head>
    <body class="bg-light admin-panel-rooms">
        <?php include 'inc/header.php' ?>
        <div class="container-fluid admin-panel-rooms__main-content" id="admin-panel-content">
            <div class="row main-content">
                <div class="col-lg-10 ms-auto p-4">
                    <h3 class="mb-4">ROOMS</h3>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="text-end mb-3">
                                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room-modal-setting">
                                    <span class="d-flex gap-1 align-items-center justify-content-between"><i class="bi bi-plus-square"></i> Add</span>
                                </button>
                            </div>
                            
                            <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                                <table class="table table-hover border">
                                    <thead class="sticky-top">
                                        <tr class="bg-dark text-light">
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Area</th>
                                            <th scope="col">Guests</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="rooms-table-body">
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

<!-- ADD ROOM MODAL -->
<div class="modal fade" id="add-room-modal-setting" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="add-room-modal-form" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Room</h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="name" class="form-control shadow-none" placeholder="Room name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Area</label>
                            <input type="number" min="1" name="area" class="form-control shadow-none" placeholder="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Price</label>
                            <input type="number" min="1" name="price" class="form-control shadow-none" placeholder="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Quantity</label>
                            <input type="number" min="1" name="quantity" class="form-control shadow-none" placeholder="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Adult (Max.)</label>
                            <input type="number" min="1" name="adult" class="form-control shadow-none" placeholder="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Children (Max.)</label>
                            <input type="number"min="1"  name="children" class="form-control shadow-none" placeholder="1" required>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Features</label>
                            <div class="row">
                                <?php
                                    $res = selectAll('features');
                                    while($opt = mysqli_fetch_assoc($res)) {
                                        echo <<<data
                                            <div class='col-md-3'>
                                                <label>
                                                    <input type="checkbox" name="features" value='$opt[sr_no]' class="form-check-input shadow-none"> 
                                                    $opt[name]
                                                </label>
                                            </div>
                                        data;
                                    }
                                ?>
                            </div>
                        </div>
                       
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Facilities</label>
                            <div class="row">
                                <?php
                                    $res = selectAll('facilities');
                                    while($opt = mysqli_fetch_assoc($res)) {
                                        echo <<<data
                                            <div class='col-md-3'>
                                                <label>
                                                    <input type="checkbox" name="facilities" value='$opt[sr_no]' class="form-check-input shadow-none"> 
                                                    $opt[name]
                                                </label>
                                            </div>
                                        data;
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea type="text" name="description" class="form-control shadow-none" rows='3' placeholder="Room description" required></textarea>
                        </div>
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

<!-- EDIT ROOM MODAL -->
<div class="modal fade" id="edit-room-modal-setting" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="edit-room-modal-form" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Room</h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="name" class="form-control shadow-none" placeholder="Room name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Area</label>
                            <input type="number" min="1" name="area" class="form-control shadow-none" placeholder="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Price</label>
                            <input type="number" min="1" name="price" class="form-control shadow-none" placeholder="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Quantity</label>
                            <input type="number" min="1" name="quantity" class="form-control shadow-none" placeholder="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Adult (Max.)</label>
                            <input type="number" min="1" name="adult" class="form-control shadow-none" placeholder="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Children (Max.)</label>
                            <input type="number"min="1"  name="children" class="form-control shadow-none" placeholder="1" required>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Features</label>
                            <div class="row">
                                <?php
                                    $res = selectAll('features');
                                    while($opt = mysqli_fetch_assoc($res)) {
                                        echo <<<data
                                            <div class='col-md-3'>
                                                <label>
                                                    <input type="checkbox" name="features" value='$opt[sr_no]' class="form-check-input shadow-none"> 
                                                    $opt[name]
                                                </label>
                                            </div>
                                        data;
                                    }
                                ?>
                            </div>
                        </div>
                       
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Facilities</label>
                            <div class="row">
                                <?php
                                    $res = selectAll('facilities');
                                    while($opt = mysqli_fetch_assoc($res)) {
                                        echo <<<data
                                            <div class='col-md-3'>
                                                <label>
                                                    <input type="checkbox" name="facilities" value='$opt[sr_no]' class="form-check-input shadow-none"> 
                                                    $opt[name]
                                                </label>
                                            </div>
                                        data;
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea type="text" name="description" class="form-control shadow-none" rows='3' placeholder="Room description" required></textarea>
                        </div>
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

<!-- IMAGE ROOM MODAL -->
<div class="modal fade" id="image-room-modal-setting" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="image-room-name"></h5>
                <button type="button" onclick="document.getElementById('image-room-modal-form').reset()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="image-alert"></div>
                <div class="border-bottom border-3 pb-3 mb-3">
                    <form id="image-room-modal-form" class="d-flex align-items-end justify-content-between flex-wrap gap-1" autocomplete="off">
                        <div class="">
                            <label class="form-label fw-bold">Add Image</label>
                            <input type="file" accept="[.jpg, .png, .webp, .jpeg]" name="image" class="form-control shadow-none" required>
                        </div>
                        <button type="submit" class="btn custom-bg text-white shadow-none"><i class="bi bi-plus-square"></i> SUBMIT</button>   
                    </form>
                </div>
                <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                    <table class="table table-hover border text-center" style="vertical-align: middle;">
                        <thead class="sticky-top">
                            <tr class="bg-dark text-light">
                                <th scope="col" width="60%">Image</th>
                                <th scope="col">Thumb</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="image-table-body">
                            <!-- CONTENT WILL BE INSERTED HERE DYNAMICALLY -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>