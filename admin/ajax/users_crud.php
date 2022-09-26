<?php
    include "../inc/essentials.php";
    include '../inc/db_config.php';

    verifyUserDashboard();

    $POST_DATA = filteration($_POST);

    $isGetUsersRequest = isset($POST_DATA['getUsers']);
    $isRemoveUserRequest = isset($POST_DATA['removeUser']);
    $isToggleStatusRequest = isset($POST_DATA['toggleStatus']);
    $isSearchUserRequest = isset($POST_DATA['searchUser']);
    
    if($isGetUsersRequest) {
        $q = selectAllByOrder('users_cred','sr_no','DESC');
        $index = 1;
        $path = USERS_IMG_PATH;
        
        while($row = mysqli_fetch_assoc($q)) {
            $unverfied = "<span class='badge bg-danger'><i class='bi bi-x-lg'></i></span>";
            $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i></span>";
            $isVerified = $row['is_verified'] ? $verified : $unverfied; 
            $isStatusOk = $row['status'] ? true : false;

            $inactive = "<button onclick='onStatusToggle($row[sr_no], 1)' type='button' class='btn btn-danger btn-sm shadow-none'>Suspended</button>";
            $active = "<button onclick='onStatusToggle($row[sr_no], 0)' type='button' class='btn btn-dark btn-sm shadow-none'>Active</button>";
            $isActive = $row['status'] ? $active : $inactive;
            
            $date = date("d-m-Y", strtotime($row['date_created']));

            echo <<< data
                <tr>
                    <th scope="row">$index</th>
                    <td>
                        <img src='$path$row[picture]' width='55px'>
                        <br>
                        $row[name]
                    </td>
                    <td>$row[email]</td>
                    <td>$row[phonenumber]</td>
                    <td>$row[address] | $row[pincode]</td>
                    <td>$row[birthday]</td>
                    <td style='text-align: center;'>$isVerified</td>
                    <td style='text-align: center;'>$isActive</td>
                    <td style='text-align: center;'>$date</td>
                    <td style='text-align: center;'>
                        <button type="button" onclick="onUserRemove($row[sr_no])" class="btn btn-danger shadow-none btn-sm">
                            <span class="d-flex gap-1 align-items-center justify-content-between"><i class="bi bi-trash-fill"></i></span>
                        </button>
                    </td>
                </tr>
            data;
            $index++;
        }
    }
    if($isRemoveUserRequest) {
        $values = [$POST_DATA['sr_no']];

        $userQuery = "SELECT * FROM `users_cred` WHERE `sr_no`=? LIMIT 1";
        $users = mysqli_fetch_assoc(select($userQuery, $values, 'i'));

        $isDeletePicSuccess = deleteImage($users['picture'], USERS_FOLDER);
        
        if($isDeletePicSuccess) {
            $deleteQuery = "DELETE FROM `users_cred` WHERE `sr_no`=?";
            $res = delete($deleteQuery, $values, 'i');
            echo $res;    
        }else {
            echo 'picture_not_deleted';
        }
    }
    if($isToggleStatusRequest) {
        $id = $POST_DATA['sr_no'];
        $status = $POST_DATA['status'];

        $updateStatus = "UPDATE `users_cred` SET `status`=? WHERE `sr_no`=?";
        $isUpdateStatus = update($updateStatus, [$status, $id], 'ii');

        var_dump($isUpdateStatus);
        if($isUpdateStatus) {
            echo 1;
        }else {
            echo 0;
        }
    }
    if($isSearchUserRequest) {
        $values = ["%$POST_DATA[name]%"];
        $q = selectAllByOrder('users_cred','sr_no','DESC');

        if($POST_DATA['name'])
            $q = select("SELECT * FROM `users_cred` WHERE `name` LIKE ? ORDER BY `sr_no` DESC", $values, 's');

        $index = 1;
        $path = USERS_IMG_PATH;
        
        while($row = mysqli_fetch_assoc($q)) {
            $unverfied = "<span class='badge bg-danger'><i class='bi bi-x-lg'></i></span>";
            $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i></span>";
            $isVerified = $row['is_verified'] ? $verified : $unverfied; 
            $isStatusOk = $row['status'] ? true : false;

            $inactive = "<button onclick='onStatusToggle($row[sr_no], 1)' type='button' class='btn btn-danger btn-sm shadow-none'>Suspended</button>";
            $active = "<button onclick='onStatusToggle($row[sr_no], 0)' type='button' class='btn btn-dark btn-sm shadow-none'>Active</button>";
            $isActive = $row['status'] ? $active : $inactive;
            
            $date = date("d-m-Y", strtotime($row['date_created']));

            echo <<< data
                <tr>
                    <th scope="row">$index</th>
                    <td>
                        <img src='$path$row[picture]' width='55px'>
                        <br>
                        $row[name]
                    </td>
                    <td>$row[email]</td>
                    <td>$row[phonenumber]</td>
                    <td>$row[address] | $row[pincode]</td>
                    <td>$row[birthday]</td>
                    <td style='text-align: center;'>$isVerified</td>
                    <td style='text-align: center;'>$isActive</td>
                    <td style='text-align: center;'>$date</td>
                    <td style='text-align: center;'>
                        <button type="button" onclick="onUserRemove($row[sr_no])" class="btn btn-danger shadow-none btn-sm">
                            <span class="d-flex gap-1 align-items-center justify-content-between"><i class="bi bi-trash-fill"></i></span>
                        </button>
                    </td>
                </tr>
            data;
            $index++;
        }
    }
?>