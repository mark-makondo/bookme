<?php
    include 'admin/inc/db_config.php';
    include 'admin/inc/essentials.php';

    $GET_DATA = filteration($_GET);

    $isConfirmation = isset($GET_DATA['confirmation']);
    $isEmail = isset($GET_DATA['email']);
    $isToken = isset($GET_DATA['token']);

    if($isConfirmation) {
        if(!$isEmail || !$isToken) 
            redirect('index.php');

        $q = "SELECT * FROM `users_cred` WHERE `email`=? AND `token`=? LIMIT 1";
        $checkToken = select($q,[$GET_DATA['email'],$GET_DATA['token']], 'ss');
        $res = mysqli_num_rows($checkToken);
        $fetch = mysqli_fetch_assoc($checkToken);

        if($res != 0) {
            if($fetch['is_verified'] == 1) {
                echo <<< data
                    Email is already verified. <a href="index.php">Click to go back and login.</a>
                data;
            }else {
                $updateRes = update("UPDATE `users_cred` SET `is_verified`=?",[1],'i');
                
                if($updateRes) 
                    echo <<< data
                        Verification Success. <a href="index.php">Click to go back and login.</a>
                    data;
                else {
                    echo <<< data
                        Verification failed. <a href="index.php">Click to go back and login.</a>
                    data;
                }
            }
        }else {
            echo <<< data
                Invalid link. <a href="index.php">Click to go back and register.</a>
            data;
        }
    }
?>