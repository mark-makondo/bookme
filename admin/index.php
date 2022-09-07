<?php
    include "inc/essentials.php";
    include 'inc/db_config.php';

    session_start();
    
    $isValidUser = isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true;

    if($isValidUser) {
        redirect('dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "inc/head-meta.php" ?>
        <title>Admin Login Panel</title>

        <?php include "inc/links.php" ?>
        <?php include "inc/scripts.php" ?>

        <link rel="stylesheet" href="stylesheet/login.css">
    </head>
    <body class="admin-login-panel bg-light">
        <div class="login-form text-center rounded shadow bg-white overflow-hidden">
            <form name="admin_form" method="POST" onsubmit="(e) => {e.preventDefault();}">
                <h4 class="bg-dark text-white py-4">ADMIN LOGIN PANEL</h4>
                <div class="p-3">
                    <div class="mb-3">
                        <input name="admin_name" type="text" class="form-control shadow-none text-center" placeholder="Admin Name" required>
                    </div>
                    <div class="mb-4">
                        <input name="admin_pass" type="password" class="form-control shadow-none text-center" placeholder="Password" required>
                    </div>
                    <button name='login' type="submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
                </div>
            </form>
        </div>

        <?php
            if(isset($_POST['login'])) {
                $frmt_data = filteration($_POST);
                $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_pass`=?";
                $values = [$frmt_data['admin_name'], $frmt_data['admin_pass']];
                $datatypes = "ss";

                $res = select($query, $values, $datatypes);
                $isLoginSuccess = $res->num_rows == 1;
                
                if($isLoginSuccess) {
                    $row = mysqli_fetch_assoc($res);
                    
                    $_SESSION['adminLogin'] = true; 
                    $_SESSION['adminId'] = $row['sr_no'];

                    redirect('dashboard.php');
                    alert('success', "<strong>Login Success!</strong>", 'login-alert');
                }else {
                    alert('error', "<strong>Login Failed!</strong> Invalid username or password. Please try again.", 'login-alert');
                }
            }
        ?>
    </body>
</html>