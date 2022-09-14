<?php 
    // FRONTEND DATA
    define('SITE_URL', 'http://127.0.0.1/book-me/');
    define('MEMBERS_IMG_PATH', SITE_URL.'images/members/');
    define('CAROUSEL_IMG_PATH', SITE_URL.'images/carousel/');
    define('FACILITIES_IMG_PATH', SITE_URL.'images/facilities/');
    define('ROOMS_IMG_PATH', SITE_URL.'images/rooms/');

    // BACKEND PROCESS DATA
    define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'].'/book-me/images/');
    define('MEMBERS_FOLDER', 'members/');
    define('CAROUSEL_FOLDER', 'carousel/');
    define('FACILITIES_FOLDER', 'facilities/');
    define('ROOMS_FOLDER', 'rooms/');

    function redirect($url) {
        echo "<script>
            window.location.href = `$url`;
        </script>";
        exit;
    }
    
    function verifyUserDashboard() {
        session_start();

        $isValidUser = isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true;

        if(!($isValidUser)) {
            redirect('index.php');
        };
    }

    function customAlert(string $message,string $class,string $type = 'success') {
        $typeClass = ($type == 'success') ? "alert-success" : 'alert-warning'; 

        echo <<< alert
            <div class="alert $typeClass alert-dismissible fade show $class" role="alert">
                $message
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div
        alert;
    }

    function uploadImage($image, $folder, $customMime = []) {
        $validMime = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        $imageMime = $image['type'];
        
        if(count($customMime)) {
            $validMime = $customMime; 
        }

        if(!in_array($imageMime, $validMime)) {
            return 'inv_img';   // invalid mime type
        } else if(($image['size']/(1024 * 1024)) > 2){
            return 'inv_size';  // size greated than 2mb   
        } else {
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".$ext";
            $imgPath = UPLOAD_IMAGE_PATH.$folder.$rname;
            
            if(move_uploaded_file($image['tmp_name'], $imgPath)) {
                return $rname;
            }else {
                return 'upd_failed';
            }
        }
    }
    
    function uploadSVGImage($image, $folder) {
        $validMime = ['image/svg+xml'];
        return uploadImage($image, $folder, $validMime);
    }

    function deleteImage(string $image,string $folder) {
        if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)) 
            return true;
        return false;
    }

    function checkMissingItems($tempArray, $findKey, $findArray) {
        $foundItems = [];
        $missing = [];
        
        foreach ($tempArray as $data) {
            $toFind = isset($data[$findKey]) ? $data[$findKey] : $findKey;
            $found = findItem($findArray, fn($el) => ($el == $toFind));

            if($found) array_push($foundItems, $found);
            else array_push($missing, $toFind);
        }

        return ['found'=>$foundItems, 'missing'=>$missing];
    }
    
    function findItem($temp, $callback) {
        $found = false;

        foreach ($temp as $value) {
            $isFound = $callback($value);
        
            if($isFound) $found = $value;
        }
        return $found;
    }
?>