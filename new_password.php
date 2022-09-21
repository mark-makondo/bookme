<?php
    include 'admin/inc/db_config.php';
    include 'admin/inc/essentials.php';

    $GET_DATA = filteration($_GET);

    $isValid = isset($GET_DATA['change_pass']);
    $isEmail = isset($GET_DATA['email']);
    $isToken = isset($GET_DATA['token']);

    $validLink = false;

    if(!$isValid || !$isEmail || !$isToken) {
        redirect('index.php');
    }else {
        $t_date = date("Y-m-d");
        $query = select(
            "SELECT * FROM `users_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",
            [$GET_DATA['email'], $GET_DATA['token'], $t_date], 'sss'
        );
    
        if(mysqli_num_rows($query) > 0) {
            $validLink = true;
        }else {
            $validLink = false;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'inc/head-meta.php' ?>
        <title><?=$setting['site_title']?> - Change Password</title>

        <?php include 'inc/links.php' ?>
        <link href="stylesheet/home.css" rel="stylesheet" type="text/css">

        <?php include 'inc/scripts.php' ?>
        <script src="js/new-password-script.js" defer></script>
    </head>
    <body class="p-home bg-light">
        <div class="main-content">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-8 m-auto">
                        <?php if($validLink) :?>
                            <form method="POST" id="change-password-form">
                                <h5 class="mb-3 d-flex align-items-center gap-2">
                                    <i class="bi bi-person-circle fs-3"></i> Change Password
                                </h5>
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input name="newPassword" type="password" class="form-control shadow-none" placeholder="" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input name="confirmPassword" type="password" class="form-control shadow-none" placeholder="" required>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <button type="submit" class="btn btn-dark shadow-none">SUBMIT</button>
                                    <a href="index.php" type="button" class="btn text-secondary text-decoration-none shadow-none p-1">HOME</a>
                                </div>
                            </form>
                        <?php else: ?>
                                <h3 class="text-danger">Invalid link</h3>
                                <a href="index.php" class="btn text-secondary text-decoration-none shadow-none p-1">GO HOME</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>