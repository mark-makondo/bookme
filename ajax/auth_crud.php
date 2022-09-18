<?php 
    include "../admin/inc/essentials.php";
    include "../admin/inc/db_config.php";
    
    require("../inc/sendgrid/sendgrid-php.php");

    $POST_DATA = filteration($_POST);

    $isRegisterRequest = isset($POST_DATA['register']);

    function sendMail($uemail, $name, $token, $APIKEY) {
        try {
            $email = new \SendGrid\Mail\Mail(); 
            $email->setFrom("markalbert.makondo@gmail.com", "MAD DEV");
            $email->setSubject("Account Verification Link");
            $email->addTo($uemail, $name);
            $email->addContent(
                "text/html", 
                "
                    Click the link to confirm email: <br>
                    <a href='".SITE_URL."email_confirm.php?confirmation='1'&email=$uemail&token=$token"."'>
                        CLICK ME
                    </a>
                "
            );
                
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

    if($isRegisterRequest) {
        $picture = 'default';

        if(!isStringEqual($POST_DATA['password'], $POST_DATA['cpassword'])) {
            echo 'pass_mismatch';
            exit;
        }

        $chkUser = select(
            "SELECT * FROM `users_cred` WHERE `email`=? AND `phonenumber`=? LIMIT 1",
            [$POST_DATA['email'],$POST_DATA['phonenumber']],'ss');

        if(mysqli_num_rows($chkUser) != 0) {
            echo mysqli_fetch_assoc($chkUser)['email'] == $POST_DATA['email'] ? 'email_exist' : 'phone_exist';
            exit;
        }

        $token = bin2hex(random_bytes(16));
        $emailVerify = sendMail($POST_DATA['email'], $POST_DATA['name'], $token, SENDGRID_API_KEY);

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
?>