<?php 
    function redirect($url) {
        echo "<script>
            window.location.href = `$url`;
        </script>";
    }
    
    function verifyUserDashboard() {
        session_start();

        $isValidUser = isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true;

        if(!($isValidUser)) {
            redirect('index.php');
        };

        session_regenerate_id(true);
    }

    function customAlert($type = 'success', $message, $class) {
        $typeClass = ($type == 'success') ? "alert-success" : 'alert-warning'; 

        echo <<< alert
            <div class="alert $typeClass alert-dismissible fade show $class" role="alert">
                $message
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div
        alert;
    }

?>