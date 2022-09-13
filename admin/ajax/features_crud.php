<?php
    include "../inc/essentials.php";
    include '../inc/db_config.php';

    verifyUserDashboard();

    $isGetFeaturesRequest = isset($_POST['getFeatures']);
    $isAddFeatureRequest = isset($_POST['addFeature']);
    $isRemoveFeatureRequest = isset($_POST['removeFeature']);

    $frmData = filteration($_POST);

    if($isGetFeaturesRequest) {
        $q = selectAllByOrder('features', 'sr_no', 'DESC');
        $index = 1;
        while($row = mysqli_fetch_assoc($q)) {
                
            $delete = "<a style='min-width: 4rem;' href='#' onclick='removeFeature($row[sr_no])' class='btn btn-sm rounded-pill btn-danger mt-2'>
                Delete</a>" ;
            
            echo <<<data
                <tr>
                    <th scope="row">$index</th>
                    <td>$row[name]</td>
                    <td>$delete</td>
                </tr>
            data;
            $index++;
        }
    }
    if($isAddFeatureRequest) {
        $q = 'INSERT INTO `features`(`name`) VALUES (?)';
        $values = [$frmData['name']];
        $dataType = 's';
        
        echo insert($q, $values, $dataType);
    }
    if($isRemoveFeatureRequest) {
        $q = "DELETE FROM `features` WHERE `sr_no`=?";
        $values = [$frmData['sr_no']];
        $dataType = "i";
        
        $res = delete($q, $values, $dataType);

        echo $res;
    }
?>