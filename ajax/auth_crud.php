<?php 
    include "../admin/inc/essentials.php";
    include "../admin/inc/db_config.php";
    
    require("../inc/sendgrid/sendgrid-php.php");

    date_default_timezone_set('Asia/Qatar');

    $POST_DATA = filteration($_POST);

    $isRegisterRequest = isset($POST_DATA['register']);
    $isLoginRequest = isset($POST_DATA['login']);
    $isForgotPasswordRequest = isset($POST_DATA['forgotPassword']);
    $isNewPasswordRequest = isset($POST_DATA['changePassword']);

    function sendMail($uemail, $name, $content) {
        try {
            $APIKEY = SENDGRID_API_KEY;

            $email = new \SendGrid\Mail\Mail(); 
            $email->setFrom(SENDGRID_EMAIL, SENDGRID_NAME);
            $email->setSubject("Account Verification Link");
            $email->addTo($uemail, $name);
            $email->addContent("text/html", $content);
                
            $sendgrid = new \SendGrid($APIKEY);
            $response = $sendgrid->send($email);

            if($response) {
                return 1;
            }else {
                return 0;
            }
        } catch (Exception $e) {
            // echo 'Caught exception: '. $e->getMessage() ."\n";
            return 0;
        }
    }

    function sendVerificationEmail($uemail, $uname) {
        $token = bin2hex(random_bytes(16));

        $content = "
            Click the link to confirm email: <br>
            <a href='".SITE_URL."email_confirm.php?confirmation='1'&email=$uemail&token=$token"."'>
                CLICK ME
            </a>
        ";

        return sendMail($uemail, $uname, $content);
    }

    function sendNewPassword($uemail, $uname, $token) {
        $content = "
            Click the link to confirm email: <br>
            <a href='".SITE_URL."new_password.php?change_pass=1&email=$uemail&token=$token"."'>
                CLICK ME
            </a>
        ";

        return sendMail($uemail, $uname, $content);
    }

    function isUserExist($email, $retUser = false) {
        $q = select(
            "SELECT * FROM `users_cred` WHERE `email`=? LIMIT 1",
            [$email],'s');

        if(mysqli_num_rows($q) != 0) {
            $user = mysqli_fetch_assoc($q);
            $userEmail = $user['email'];

            if($userEmail == $email) {
                return $retUser ? $user : 'email_exist';
            } else return 0;
        }
        return 0;
    }

    if($isRegisterRequest) {
        $picture = 'default';

        if(!isStringEqual($POST_DATA['password'], $POST_DATA['cpassword'])) {
            echo 'pass_mismatch';
            exit;
        }

        if(isUserExist($POST_DATA['email'])) {
            echo isUserExist($POST_DATA['email']);
            exit;
        }

        $token = bin2hex(random_bytes(16));
        $emailVerify = sendVerificationEmail($POST_DATA['email'], $POST_DATA['name']);

        if(!$emailVerify) {
            echo 'mail_failed';
            exit;
        }

        $encPass = password_hash($POST_DATA['password'], PASSWORD_BCRYPT);

        if(isset($_FILES['picture']))
            $picture = uploadUserImage($_FILES['picture']);

        if($picture == 'inv_img' || $picture == 'inv_size' || $picture == 'upd_failed') {
            echo $picture;
            exit;
        }

        $counter = 1;
        $q = "INSERT INTO `users_cred`";
        $keys = "";
        $values = "";
        $valuesArr = [];
        $dataType = 'sssssisss';
        $exclude = ['cpassword', 'register'];

        foreach ($POST_DATA as $key => $value) {
            if(!findItem($exclude, fn($item)=>$item == $key)) {
                $isLast = $counter == (count($POST_DATA)-count($exclude)); 
                
                $keys.="`".$key."`";
                $values.="?";

                if(!$isLast) {
                    $keys.=","; 
                    $values.=",";
                } 

                if($key == 'picture') {
                    array_push($valuesArr, $picture);
                }else if($key == 'password') {
                    array_push($valuesArr, $encPass);
                } else {
                    array_push($valuesArr, $value);
                }
                $counter++;
            }
        };

        $keys = $keys.",`token`";
        $values = $values.",?";

        array_push($valuesArr, $token);
        
        $query = $q."(".$keys.")"." VALUES (".$values.")";
        $res = insert($query, $valuesArr, $dataType);

        if($res == 1) 
            echo 1;
        else 
            echo 0;
    }

    if($isLoginRequest) {
        $checkUser = isUserExist($POST_DATA['email'], true);
        
        if($checkUser) {
            $isNotVerified = $checkUser['is_verified'] != 1;
            $isNotActive = $checkUser['status'] != 1;
            $checkPass = password_verify($POST_DATA['password'], $checkUser['password']);
            
            if($isNotVerified) {
                echo 'not_verified';
            }else if($isNotActive) {
                echo 'not_active';
            }else if(!$checkPass) {
                echo 'invalid_pass';
            }else {
                $sessionInclude = ['sr_no', 'name', 'picture', 'phonenumber', 'email'];

                session_start();
                $_SESSION['login'] = true;

                foreach ($sessionInclude as $value) {
                    if($value == 'sr_no')
                        $_SESSION['uid'] = $checkUser[$value];
                    else 
                        $_SESSION[$value] = $checkUser[$value];
                }
                echo 1;
            }
        }else echo 'invalid_email';
    }

    if($isForgotPasswordRequest) {
        $checkUser = isUserExist($POST_DATA['email'], true);
        
        if($checkUser) {
            $id = $checkUser['sr_no'];
            $isVerified = $checkUser['is_verified'] == 1;
            $isActive = $checkUser['status'] == 1;

            if($isVerified && $isActive) {
                $email = $checkUser['email'];
                $name = $checkUser['name'];
                $token = bin2hex(random_bytes(16));
                
                $res = sendNewPassword($email, $name, $token);

                $date = date("Y-m-d");
                
                $query = mysqli_query($connect, "UPDATE `users_cred` SET `token`='$token', `t_expire`='$date' WHERE `sr_no`='$id'");

                if($res && $query)
                    echo 1;
                else 
                    echo 'new_pass_req_failed';
            }
            if(!$isVerified)
                echo 'not_verified';
            else if(!$isActive)
                echo 'not_active';
            else 
                echo 'new_pass_req_failed';
        }
    }

    if($isNewPasswordRequest) {
        $email = $POST_DATA['email'];
        $token = $POST_DATA['token'];
        $newPass = $POST_DATA['newPassword'];
        $confPass = $POST_DATA['confirmPassword'];

        $q = select(
            'SELECT * FROM `users_cred` WHERE `email`=? AND `token`=? LIMIT 1', 
            [$email, $token], 
            'ss'
        );

        $checkUser = mysqli_num_rows($q) > 0;

        if($checkUser) {
            $user = mysqli_fetch_assoc($q);

            if(password_verify($newPass, $user['password'])) {
                echo 'old_pass';
                exit;
            }

            if($newPass != $confPass) {
                echo 'incorrect_confirm_pass';
                exit;
            }

            $newHashedPassword = password_hash($newPass, PASSWORD_BCRYPT);
            
            $update = update(
                'UPDATE `users_cred` SET `password`=?, `t_expire`=?, `token`=? WHERE `email`=? AND `token`=?',
                [$newHashedPassword, null, null, $email, $token],'sssss'
            );

            if($update) echo 1;
            else echo 'new_pass_req_failed';
        }else echo 'new_pass_req_failed';
    }
?>