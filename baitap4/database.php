<?php
    $localhost = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'signup'; 

    $mysqli = new mysqli($localhost, $username, $password, $database);
    if(mysqli_connect_errno()){
        echo 'Lổi kết nối: ' . mysqli_connect_error();
        die();
    }

?>