<?php
    include "../inc/essentials.php";
    include '../inc/db_config.php';

    verifyUserDashboard();

    $isGetImagesRequest = isset($_POST['getImages']);
    $isAddImageRequest = isset($_POST['addImage']);
    $isRemoveImageRequest = isset($_POST['removeImage']);

    if($isGetImagesRequest) {
        $table = 'carousel';
        $res = selectAll($table);
        $path = CAROUSEL_IMG_PATH;

        while($row = mysqli_fetch_assoc($res)){
            echo <<<data
                <div class="col-md-4 mb-3">
                    <div class="card bg-dark text-white h-100">
                        <img src="$path$row[image]" alt="" class="card-image h-100" style="min-height: 6rem;">
                        <div class="card-img-overlay text-end">
                            <button onclick="removeImage($row[sr_no])" class="btn btn-danger btn-sm shadow-none"><i class="bi bi-trash"></i> Delete</button>
                        </div>
                    </div>
                </div>
            data;
        }
    } 
    if($isAddImageRequest) {
        $frm_data = filteration($_POST);

        $imgRet = uploadImage($_FILES['image'], CAROUSEL_FOLDER);
        
        if($imgRet == 'inv_img') {
            echo $imgRet;
        }else if($imgRet == 'inv_size') {
            echo $imgRet;
        }else if($imgRet == 'upd_fail') {
            echo $imgRet;
        }else {
            $q = "INSERT INTO `carousel`(`image`) VALUES (?)";
            $values = [$imgRet];
            $res = insert($q, $values, 's');
            echo $res;
        }
    }      
    if($isRemoveImageRequest) {
        $frm_data = filteration($_POST);
        $values = [$frm_data['removeImage']];
        $pre_q = "SELECT * FROM `carousel` WHERE `sr_no`=?";
        $res = select($pre_q, $values, 'i');
        $row = mysqli_fetch_assoc($res);
        
        if(deleteImage($row['image'], CAROUSEL_FOLDER)){
            $q = "DELETE FROM `carousel` WHERE `sr_no`=?";
            $res = delete($q,$values,'i');
            echo $res;
        }else {
            echo 0;
        }
    } 
?>