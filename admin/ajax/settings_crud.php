<?php
    include "../inc/essentials.php";
    include '../inc/db_config.php';

    verifyUserDashboard();

    $isGetGeneralRequest = isset($_POST['getGeneral']);
    $isUpdateGeneralRequest = isset($_POST['updateGeneral']);
    $isUpdateShutdownRequest = isset($_POST['updateShutdown']);
    $isGetContactRequest = isset($_POST['getContact']);
    $isUpdateContactRequest = isset($_POST['updateContactSettings']);

    if($isGetGeneralRequest) {
        $q = "SELECT * FROM `settings` WHERE `sr_no`=?";
        $values = [1];
        $res = select($q, $values, "i");
        $data = mysqli_fetch_assoc($res);
        $json_data = json_encode($data);
        echo $json_data;
    }
    if($isUpdateGeneralRequest) {
        $frm_data = filteration($_POST);
        $q = "UPDATE `settings` SET `site_title`=?,`site_about`=? WHERE `sr_no`=?";
        $values = [$frm_data['site_title'], $frm_data['site_about'],1];
        $res = update($q, $values, "ssi");
        echo $res;
    }
    if($isUpdateShutdownRequest) {
        $frm_data = ($_POST['updateShutdown'] == 0) ? 1 : 0;
        $q = "UPDATE `settings` SET `shutdown`=? WHERE `sr_no`=?";
        $values = [$frm_data,1];
        $res = update($q, $values, "ii");
        echo $res;
    }

    if($isGetContactRequest) {
        $q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
        $values = [1];
        $res = select($q, $values, "i");
        $data = mysqli_fetch_assoc($res);
        $json_data = json_encode($data);
        echo $json_data;
    }
    if($isUpdateContactRequest) {
        $frm_data = filteration($_POST);
        
        $q = "UPDATE `contact_details` 
            SET `address`=?,`email`=?,`gmap`=?,`pn1`=?,`pn2`=?,`iframe`=?,`facebook`=?,`twitter`=?, `instagram`=?
            WHERE `sr_no`=?";

        $values = [
            $frm_data['address'], $frm_data['email'],$frm_data['gmap'], $frm_data['pn1'],
            $frm_data['pn2'], $frm_data['iframe'],$frm_data['facebook'], $frm_data['twitter'],
            $frm_data['instagram'], 1
        ];
        $res = update($q, $values, "sssssssssi");
        echo $res;
    }
?>