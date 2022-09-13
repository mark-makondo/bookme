<?php
    include "../inc/essentials.php";
    include '../inc/db_config.php';

    verifyUserDashboard();

    $isGetFacilitiesRequest = isset($_POST['getFacilities']);
    $isAddFacilityRequest = isset($_POST['addFacility']);
    $isRemoveFacilityRequest = isset($_POST['removeFacility']);
    
    $frmData = filteration($_POST);

    if($isGetFacilitiesRequest) {
        $q = selectAllByOrder('facilities', 'sr_no', 'DESC');
        $index = 1;
        $path = FACILITIES_IMG_PATH;

        while($row = mysqli_fetch_assoc($q)) {
            $delete = "<a style='min-width: 4rem;' href='#' onclick='removeFacility($row[sr_no])' class='btn btn-sm rounded-pill btn-danger mt-2'>
                Delete</a>" ;
            
            echo <<<data
                <tr>
                    <th scope="row">$index</th>
                    <td><img src="$path$row[icon]" width="40"/></td>
                    <td>$row[name]</td>
                    <td>$row[description]</td>
                    <td>$delete</td>
                </tr>
            data;
            $index++;
        }
    }
    if($isAddFacilityRequest) {
        $iconRet = uploadSVGImage($_FILES['icon'], FACILITIES_FOLDER);

        if($iconRet == 'inv_img' || $iconRet == 'inv_size' || $iconRet == 'upd_fail') {
            echo $iconRet;
        }else {
            $q = 'INSERT INTO `facilities`(`name`, `description`, `icon`) VALUES (?,?,?)';
            $values = [$frmData['name'],$frmData['description'],$iconRet];
            $dataType = 'sss';

            echo insert($q, $values, $dataType);
        }
    }
    if($isRemoveFacilityRequest) {
        $frmData = filteration($_POST);
        $values = [$frmData['sr_no']];

        $selectQuery = "SELECT * FROM `facilities` WHERE `sr_no`=?";
        $deleteQuery = "DELETE FROM `facilities` WHERE `sr_no`=?";

        $selectRes = select($selectQuery, $values, 'i');
        $deleteRes = delete($deleteQuery, $values, 'i');

        $facility = mysqli_fetch_assoc($selectRes);

        if($deleteRes) {
            $deleteImageRes = deleteImage($facility['icon'], FACILITIES_FOLDER);
            if($deleteImageRes) echo 1;
            else echo 0;
        };
    }
?>