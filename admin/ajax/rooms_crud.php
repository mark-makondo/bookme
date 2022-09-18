<?php
    include "../inc/essentials.php";
    include '../inc/db_config.php';

    verifyUserDashboard();

    $isGetRoomsRequest = isset($_POST['getRooms']);
    $isGetRoomRequest = isset($_POST['getRoom']);
    $isAddRoomRequest = isset($_POST['addRoom']);
    $isDeleteRoomRequest = isset($_POST['removeRoom']);
    $isChangeStatusRoomRequest = isset($_POST['changeStatus']);
    $isUpdateRoomRequest = isset($_POST['updateRoom']);

    $isGetImagesRoomRequest = isset($_POST['getImages']);
    $isAddImageRoomRequest = isset($_POST['addImage']);
    $isRemoveImageRoomRequest = isset($_POST['removeImage']);
    $isChangeThumbRoomRequest = isset($_POST['changeThumb']);
    
    $frmData = filteration($_POST);

    if($isGetRoomRequest) {
        $roomsQ = "SELECT * FROM `rooms` WHERE `sr_no`=?";
        $featuresQ = "SELECT `feature_id` FROM `room_features` WHERE `room_id`=?";
        $facilitiesQ = "SELECT `facilities_id` FROM `room_facilities` WHERE `room_id`=?";

        $roomsRes = select($roomsQ, [$frmData['sr_no']], 'i');
        $featuresRes = select($featuresQ, [$frmData['sr_no']], 'i');
        $facilitiesRes = select($facilitiesQ, [$frmData['sr_no']], 'i');
        
        $data = [
            'room' => mysqli_fetch_assoc($roomsRes),
            'features' => mysqli_fetch_all($featuresRes),
            'facilities' => mysqli_fetch_all($facilitiesRes)
        ];
        
        echo json_encode($data);
    }
    if($isGetRoomsRequest) {
        $q = selectAllByOrder('rooms','sr_no','DESC');
        $index = 1;
        $path = FACILITIES_IMG_PATH;

        while($row = mysqli_fetch_assoc($q)) {
            $delete = "<a style='min-width: 4rem;' href='#' onclick='removeRoom($row[sr_no])' class='btn btn-sm rounded-pill btn-danger'>
                Delete</a>" ;

            if($row['status']==1) {
                $status = "<button onclick='onStatusClick($row[sr_no])' class='btn btn-warning btn-sm shadow-none'>Deactivate</button>";
            }else $status = "<button onclick='onStatusClick($row[sr_no])' class='btn btn-dark btn-sm shadow-none'>Activate</button>";

            echo <<< data
                <tr>
                    <th scope="row">$index</th>
                    <td>$row[name]</td>
                    <td>$row[area] sq. ft.</td>
                    <td>
                        <div class='d-flex flex-column gap-1 align-items-start'>
                            <span class='badge rounded-pill bg-light text-dark'>Adult: $row[adult]</span>
                            <span class='badge rounded-pill bg-light text-dark'>Children: $row[children]</span>
                        </div>
                    </td>
                    <td>$row[price] PHP</td>
                    <td>$row[quantity]</td>
                    <td>$status</td>
                    <td>
                        <button type="button" onclick="getRoom($row[sr_no])" class="btn btn-primary shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#edit-room-modal-setting">
                            <span class="d-flex gap-1 align-items-center justify-content-between"><i class="bi bi-pencil-square"></i></span>
                        </button>
                        <button type="button" onclick="onImageBtnClick('$row[sr_no]','$row[name]')" class="btn btn-info shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#image-room-modal-setting">
                            <i class="bi bi-images"></i>
                        </button>
                        <button type="button"  onclick='removeRoom($row[sr_no])' class="btn btn-danger shadow-none btn-sm">
                            <span class="d-flex gap-1 align-items-center justify-content-between"><i class="bi bi-trash-fill"></i></span>
                        </button>
                    </td>
                </tr>
            data;
            $index++;
        }
    }
    if($isAddRoomRequest) {
        $features = filteration(json_decode($_POST['features']));
        $facilities = filteration(json_decode($_POST['facilities']));
        $flag = 0;

        $vaues = [
            $frmData['name'],$frmData['area'],$frmData['price'],$frmData['quantity'],
            $frmData['adult'],$frmData['children'],$frmData['description']
        ];

        $q1 = "INSERT INTO `rooms`(`name`,`area`,`price`,`quantity`,`adult`,`children`,`description`) VALUES (?,?,?,?,?,?,?)";

        if(insert($q1, $vaues, 'siiiiis'))
            $flag = 1;

        $roomId = mysqli_insert_id($connect);

        $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";
        $q3 = "INSERT INTO `room_features`(`room_id`, `feature_id`) VALUES (?,?)";

        $flag = batchInsert($q2, $facilities, 'ii',[$roomId]);
        $flag = batchInsert($q3, $features, 'ii',[$roomId]);
            
        if($flag) echo 1;
        else echo 0;
    }
    if($isDeleteRoomRequest) {
        $checkRoomImage = "SELECT * FROM `room_images` WHERE `room_id`=?";
        $q1 = "DELETE FROM `room_features` WHERE `room_id`=?";
        $q2 = "DELETE FROM `room_facilities` WHERE `room_id`=?";
        $q3 = "DELETE FROM `rooms` WHERE `sr_no`=?";
        
        $values = [$frmData['sr_no']];
        $checkResult = select($checkRoomImage, $values, 'i');

        if(mysqli_num_rows($checkResult)) echo 'room-image-exist';
        else {
            $res = delete($q1, $values, 'i');
            $res = delete($q2, $values, 'i');
            $res = delete($q3, $values, 'i');
            
            echo $res;
        }
    }
    if($isChangeStatusRoomRequest) {
        $sr_no = $frmData['sr_no'];
        
        $statusQuery = "SELECT `status` FROM `rooms` WHERE `sr_no`=?";
        $statusResult = select($statusQuery, [$sr_no], 'i');
        $statusAssoc = mysqli_fetch_assoc($statusResult);

        $value = $statusAssoc['status'] == 1 ? 0 : 1;
        
        $updateStatusQuery = "UPDATE `rooms` SET `status`=? WHERE `sr_no`=?";
        $res = update($updateStatusQuery, [$value, $sr_no],'ii');

        if($value && $res) 
            echo 'active';
        else
            echo $res;
    }
    if($isUpdateRoomRequest) {
        $sr_no = $frmData['sr_no'];
        $flag = 0;
        $features = json_decode($_POST['features']);
        $facilities = json_decode($_POST['facilities']);

        $updateQuery = "UPDATE `rooms` SET `name`=?,`area`=?,`price`=?,`quantity`=?,`adult`=?,`children`=?,`description`=? WHERE `sr_no`=?";
        $deleteFeaturesQuery = "DELETE FROM `room_features` WHERE `room_id`=?";
        $deleteFacilitiesQuery = "DELETE FROM `room_facilities` WHERE `room_id`=?";
        $insertFacilitiesQuery = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";
        $insertFeaturesQuery = "INSERT INTO `room_features`(`room_id`, `feature_id`) VALUES (?,?)";

        $roomData =[
            $frmData['name'], $frmData['area'], $frmData['price'], $frmData['quantity'], 
            $frmData['adult'], $frmData['children'], $frmData['description'], $sr_no
        ];
        $dataType = 'siiiiisi';

        if(update($updateQuery, $roomData, $dataType))
            $flag = 1;

        $delFeatures = delete($deleteFeaturesQuery,[$sr_no], 'i');
        $delFacilities = delete($deleteFacilitiesQuery,[$sr_no], 'i');

        if(!($delFeatures && $delFacilities)) 
            $flag = 0;
       
        $flag = batchInsert($insertFacilitiesQuery, $facilities, 'ii',[$sr_no]);
        $flag = batchInsert($insertFeaturesQuery, $features, 'ii',[$sr_no]);

        if($flag) echo 1;
        else echo 0;
    }
    if($isGetImagesRoomRequest) {
        $selectQuery = "SELECT * FROM `room_images` WHERE `room_id`=?";
        $selectRes = select($selectQuery, [$frmData['sr_no']],'i');

        $path = ROOMS_IMG_PATH;

        while($row = mysqli_fetch_assoc($selectRes)) {
            if($row['thumb']==1) {
                $status = "<button type='button' onclick='onThumbClick($row[sr_no], 0)' class='btn btn-warning btn-sm shadow-none'>Unset</button>";
            }else $status = "<button type='button' onclick='onThumbClick($row[sr_no], 1)' class='btn btn-dark btn-sm shadow-none'>Set as thumb</button>";

            echo <<< data
                <tr>
                    <td><img src="$path$row[image]" width="300" class="img-fluid"/></td>
                    <td>$status</td>
                    <td>
                        <button type="button" onclick='removeImage($row[sr_no])' class="btn btn-danger shadow-none btn-sm">
                            <span class="d-flex gap-1 align-items-center justify-content-between"><i class="bi bi-trash-fill"></i></span>
                        </button>
                    </td>
                </tr>
            data;
        }
    }
    if($isAddImageRoomRequest) {
        $imageRet = uploadImage($_FILES['image'], ROOMS_FOLDER);

        if($imageRet == 'inv_img' || $imageRet == 'inv_size' || $imageRet == 'upd_fail') {
            echo $imageRet;
        }else {
            $q = 'INSERT INTO `room_images`(`room_id`, `image`) VALUES (?,?)';
            $values = [$frmData['sr_no'], $imageRet];
            $dataType = 'is';

            if(insert($q, $values, $dataType)) echo 1;
            else echo 0;
        }
    }
    if($isRemoveImageRoomRequest) {
        $frmData = filteration($_POST);
        $values = [$frmData['sr_no']];

        $selectQuery = "SELECT * FROM `room_images` WHERE `sr_no`=?";
        $deleteQuery = "DELETE FROM `room_images` WHERE `sr_no`=?";
        
        $selectRes = select($selectQuery, $values, 'i');
        $roomImage = mysqli_fetch_assoc($selectRes);
        
        $deleteRes = delete($deleteQuery, $values, 'i');

        if($deleteRes) {
            $deleteImageRes = deleteImage($roomImage['image'], ROOMS_FOLDER);
            if($deleteImageRes) echo 1;
            else echo 0;
        };
    }
    if($isChangeThumbRoomRequest) {
        $srno = $frmData['sr_no'];
        $roomId = $frmData['room_id'];
        $thumb = $frmData['thumb'];
        $res = false;

        if($thumb == 1) {
            $updateQueryDisable = "UPDATE `room_images` SET `thumb`=? WHERE `room_id`=?";
            $updateQueryResult = update($updateQueryDisable, [0, $roomId], 'ii');

            if($updateQueryDisable) {
                $updateQueryEnable = "UPDATE `room_images` SET `thumb`=? WHERE `sr_no`=?";
                $res = update($updateQueryEnable, [1, $srno],'ii');
            }
        }else {
            $updateQueryEnable = "UPDATE `room_images` SET `thumb`=? WHERE `sr_no`=?";
            $res = update($updateQueryEnable, [$thumb, $srno],'ii');
        }
        
        if($res) {
            if($thumb) echo 'set-thumb';
            else echo 'unset-thumb';
        }else echo 0;
    }
?>