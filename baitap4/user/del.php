<?php
    require '../database.php';
    session_start();
    ob_start();
    if(!isset($_SESSION['email'])){
        header('location: ../login.php');
    }
?>
<?php
    require '../inc/header.php';
?>        
<?php
    $id = $_GET['id'];
    $query = "DELETE FROM users WHERE id = '$id'";
    $result = $mysqli->query($query);
    if($result){
        header('location: list.php?msg=Xóa thành công');
        die();
    }else{
        echo 'Đã có lổi khi xóa';
        die();
    }
?>
<?php
    require '../inc/footer.php';
?>