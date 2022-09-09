<?php
    include "../inc/essentials.php";
    include '../inc/db_config.php';

    verifyUserDashboard();

    $isGetGeneralRequest = isset($_POST['getGeneral']);
    $isUpdateGeneralRequest = isset($_POST['updateGeneral']);
    $isUpdateShutdownRequest = isset($_POST['updateShutdown']);
    $isGetContactRequest = isset($_POST['getContact']);
    $isUpdateContactRequest = isset($_POST['updateContactSettings']);
    $isAddTeamMemberRequest = isset($_POST['addMember']);
    $isGetTeamMembersRequest = isset($_POST['getMembers']);
    $isRemoveTeamMemberRequest = isset($_POST['removeMember']);

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
    if($isAddTeamMemberRequest) {
        $frm_data = filteration($_POST);

        $imgRet = uploadImage($_FILES['picture'], MEMBERS_FOLDER);
        
        if($imgRet == 'inv_img') {
            echo $imgRet;
        }else if($imgRet == 'inv_size') {
            echo $imgRet;
        }else if($imgRet == 'upd_fail') {
            echo $imgRet;
        }else {
            $q = "INSERT INTO `team_details`(`name`, `picture`) VALUES (?,?)";
            $values = [$frm_data['name'], $imgRet];
            $res = insert($q, $values, 'ss');
            echo $res;
        }

    }      
    if($isRemoveTeamMemberRequest) {
        $frm_data = filteration($_POST);
        $values = [$frm_data['removeMember']];
        $pre_q = "SELECT * FROM `team_details` WHERE `sr_no`=?";
        $res = select($pre_q, $values, 'i');
        $row = mysqli_fetch_assoc($res);
        
        if(deleteImage($row['picture'], MEMBERS_FOLDER)){
            $q = "DELETE FROM `team_details` WHERE `sr_no`=?";
            $res = delete($q,$values,'i');
            echo $res;
        }else {
            echo 0;
        }
    } 
    if($isGetTeamMembersRequest) {
        $table = 'team_details';
        $res = selectAll($table);
        $path = MEMBERS_IMG_PATH;

        while($row = mysqli_fetch_assoc($res)){
            echo <<<data
                <div class="col-md-2 mb-3">
                    <div class="card bg-dark text-white h-100">
                        <img src="$path$row[picture]" alt="" class="card-image h-100" style="min-height: 6rem;">
                        <div class="card-img-overlay text-end">
                            <button onclick="removeMember($row[sr_no])" class="btn btn-danger btn-sm shadow-none"><i class="bi bi-trash"></i> Delete</button>
                        </div>
                        <p class="card-text text-center px-3 py-2">$row[name]</p>
                    </div>
                </div>
            data;
        }
    } 
?>