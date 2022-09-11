<?php
    include "inc/essentials.php";
    include 'inc/db_config.php';
    
    verifyUserDashboard();

    $isCurrentSeen = isset($_GET);
    
    if($isCurrentSeen) {
        $frmData = filteration($_GET);

        $isDelExist = isset($frmData['del']);
        $isSeenExist = isset($frmData['seen']);

        if($isSeenExist) {
            $seenValue = $frmData['seen'];
            $isSeenAll = $seenValue == 'all';
            
            $dataType = 'ii';
            $val = $seenValue > 0 ? 1 : 0;
            $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
            $values = [$val, $seenValue];

            if($isSeenAll) {
                $q = "UPDATE `user_queries` SET `seen`=?";
                $dataType = 'i';
                $values = [$val];
            }

            $res = update($q, $values, $dataType);

            if($res) {
                header("Location: userQueries.php");
            }
        }

        if($isDelExist) {
            $delValue = $frmData['del'];
            $isDelAll = $delValue == 'all';

            $q = "DELETE from `user_queries` WHERE `sr_no`=?";
            $res = delete($q, [$delValue], 'i');

            if($isDelAll) {
                $q = "DELETE from `user_queries`";
                $res = simpleQuery($q);
            }

            if($res) {
                header("Location: userQueries.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "inc/head-meta.php" ?>
        <title>Admin Panel - User Queries</title>

        <?php include "inc/links.php" ?>
        <?php include "inc/scripts.php" ?>
        
        <link rel="stylesheet" href="stylesheet/dashboard.css">
    </head>
    <body class="bg-light admin-panel-dashboard">
        <?php include 'inc/header.php' ?>
       
        <div class="container-fluid admin-panel-dashboard__main-content" id="admin-panel-content">
            <div class="row main-content">
                <div class="col-lg-10 ms-auto p-4">
                    <h3 class="mb-4">User Queries</h3>
                    <div class="card general-settings border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="text-end mb-4">
                                <a href="?seen=all" class="btn btn-dark rounded-pill shadow-none"><i class="bi bi-check-all"></i> Mark all read</a>
                                <a href="?del=all" class="btn btn-danger rounded-pill shadow-none"><i class="bi bi-trash-fill"></i> Delete All</a>
                            </div>
                            <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                                <table class="table table-hover border">
                                    <thead class="sticky-top">
                                        <tr class="bg-dark text-light">
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col" width="20%">Subject</th>
                                            <th scope="col" width="20%">Message</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $q = selectAllByOrder('user_queries', 'sr_no', 'DESC');
                                            $index = 1;
                                            while($row = mysqli_fetch_assoc($q)) {
                                                $seen = $row['seen'] !=1  ?
                                                    "<a style='min-width: 4rem;' href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary d-flex justify-content-center'> 
                                                    Mark</a>" : "" ;
                                                    
                                                $delete = "<a style='min-width: 4rem;' href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mt-2 d-flex justify-content-center'>
                                                    Delete</a>" ;
                                                
                                                echo <<<data
                                                    <tr>
                                                        <th scope="row">$index</th>
                                                        <td>$row[name]</td>
                                                        <td>$row[email]</td>
                                                        <td>$row[subject]</td>
                                                        <td>$row[message]</td>
                                                        <td>$row[date]</td>
                                                        <td>
                                                            <div class="d-flex flex-column align-items-center">
                                                                $seen
                                                                $delete 
                                                            </div>
                                                        </td>
                                                    </tr>
                                                data;
                                                $index++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>