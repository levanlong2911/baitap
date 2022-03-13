<?php
    // $localhost = 'localhost';
    // $username = 'root';
    // $password = '';
    // $database = 'signup'; 
    
    $localhost = "remotemysql.com";
    $username = "rMEt9axaDn";
    $password = "70xIYdFRXw";
    $database = "rMEt9axaDn";

    $mysqli = new mysqli($localhost, $username, $password, $database);
    if(mysqli_connect_errno()){
        echo 'Lổi kết nối: ' . mysqli_connect_error();
        die();
    }

?>