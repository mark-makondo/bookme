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
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);

            $data[$key] = $value;
        }
        return $data;
    }
    function simpleQuery($query) {
        $conn = $GLOBALS['connect'];
        return mysqli_query($conn, $query);
    }

    function select($sql, $values, $datatypes) {
        $conn = $GLOBALS['connect'];
        $stmt = mysqli_prepare($conn, $sql);

        try {
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
        } catch (\Throwable $th) {
            return false;
        }
    }
    function selectAll($table) {
        $con = $GLOBALS['connect'];
        try {
            $res = mysqli_query($con, "SELECT * FROM $table");
            return $res;
        } catch (\Throwable $th) {
            return false;
        }
    }
    function selectAllByOrder($table, $order, $orderType = 'ASC') {
        $con = $GLOBALS['connect'];
        $type = $orderType == 'ASC' ? 'ASC' : 'DESC';
        try {
            $res = mysqli_query($con, "SELECT * FROM $table ORDER BY $order $type");
            return $res;
        } catch (\Throwable $th) {
            return false;
        }
    }
    function update($sql, $values, $datatypes) {
        $conn = $GLOBALS['connect'];
        $stmt = mysqli_prepare($conn, $sql);

        try {
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
        } catch (\Throwable $th) {
            return false;
        }
    }
    function insert($sql, $values, $datatypes) {
        $conn = $GLOBALS['connect'];
        $stmt = mysqli_prepare($conn, $sql);

        try {
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
        } catch (\Throwable $th) {
            return false;
        }
    }
    function batchInsert($q = '', $items = [], $datatypes = '', $values = []) {
        $conn = $GLOBALS['connect'];
        $stmt = mysqli_prepare($conn, $q);

        try {
            if($stmt) {
                // take note of the order of your values. For this i made the item value last. 
                // it should also be the last key in ur db to avoid order mismatch.
                foreach($items as $item) {
                    mysqli_stmt_bind_param($stmt, $datatypes, ...[...$values, $item]);
                    mysqli_stmt_execute($stmt);
                }
                
                mysqli_stmt_close($stmt);
            }else {
                die('query cannot be prepared - insert');
                return 0;
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    function delete($sql, $values, $datatypes) {
        $conn = $GLOBALS['connect'];
        $stmt = mysqli_prepare($conn, $sql);

        try {
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
        } catch (\Throwable $th) {
            return false;
        }
    }
?>