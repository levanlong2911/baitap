<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lưu session</title>
</head>
<body>
    <?php
        if(isset($_GET['msg'])){
            echo $_GET['msg'];
        }
    ?>
    <?php
        if(isset($_SESSION['email'])){
    ?>
    <h3><?php echo'Tên đăng nhập của bạn là: ' . $_SESSION['email']; ?></h3>
    <?php } ?>
</body>
</html>