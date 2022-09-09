<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'book-me';

    $connect = mysqli_connect($host, $username, $password, $db);

    if(!$connect) {
        die("Cannot connect to database".mysqli_connect_error());
    };

    function filteration($data) {
        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
            $data[$key] = stripslashes($value);
            $data[$key] = htmlspecialchars($value);
            $data[$key] = strip_tags($value);
        }
        return $data;
    }
    function select($sql, $values, $datatypes) {
        $conn = $GLOBALS['connect'];
        $stmt = mysqli_prepare($conn, $sql);

        if($stmt) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            $execute = mysqli_stmt_execute($stmt);

            if($execute) {
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Select");
            }
            
        }else {
            die("Query cannot be prepared - Select");
        }

        return false;
    }
    function selectAll($table) {
        $con = $GLOBALS['connect'];
        $res = mysqli_query($con, "SELECT * FROM $table");
        return $res;
    }
    function update($sql, $values, $datatypes) {
        $conn = $GLOBALS['connect'];
        $stmt = mysqli_prepare($conn, $sql);

        if($stmt) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            $execute = mysqli_stmt_execute($stmt);

            if($execute) {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Update");
            }
            
        }else {
            die("Query cannot be prepared - Update");
        }

        return false;
    }
    function insert($sql, $values, $datatypes) {
        $conn = $GLOBALS['connect'];
        $stmt = mysqli_prepare($conn, $sql);

        if($stmt) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            $execute = mysqli_stmt_execute($stmt);

            if($execute) {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Insert");
            }
            
        }else {
            die("Query cannot be prepared - Insert");
        }

        return false;
    }
    function delete($sql, $values, $datatypes) {
        $conn = $GLOBALS['connect'];
        $stmt = mysqli_prepare($conn, $sql);

        if($stmt) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            $execute = mysqli_stmt_execute($stmt);

            if($execute) {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Delete");
            }
            
        }else {
            die("Query cannot be prepared - Delete");
        }

        return false;
    }


?>