<?php
    require '../database.php'; 

    $id = $_POST['del_id'];
    $query = "DELETE FROM users WHERE id = '$id'";
    $result = $mysqli->query($query);
    if($result){
        echo 'Xóa thành công';
        die();
    }else{
        echo 'Đã có lổi khi xóa';
        die();
    }
?>