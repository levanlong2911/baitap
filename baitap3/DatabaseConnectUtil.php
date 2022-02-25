<?php
    $localhost = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'login';

    $mysqli = new mysqli($localhost, $username, $password, $database);
    $mysqli -> set_charset('utf8');
    if(mysqli_connect_errno()){
        echo 'Đã có kết nối lổi: ' . mysqli_connect_error();
        die();
    }
?>