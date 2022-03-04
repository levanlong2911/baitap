<?php
    // Username: rMEt9axaDn

    // Database name: rMEt9axaDn
    
    // Password: 70xIYdFRXw
    
    // Server: remotemysql.com
    
    // Port: 3306
    
    $localhost = "remotemysql.com";
    $username = "rMEt9axaDn";
    $password = "70xIYdFRXw";
    $database = "rMEt9axaDn";

    // $localhost = 'localhost';
    // $username = 'root';
    // $password = '';
    // $database = 'login';

    $mysqli = new mysqli($localhost, $username, $password, $database);
    
    if(mysqli_connect_errno()){
        echo 'Đã có kết nối lổi: ' . mysqli_connect_error();
        die();
    }
?>