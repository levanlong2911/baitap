<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/baitap/baitap3/DatabaseConnectUtil.php';
    session_start();
    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách User</title>
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
    <h2>Danh sách thành viên</h2>
    <table class="table" border="1">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = 'SELECT * FROM user';
                $result = $mysqli->query($query);
                while($users = mysqli_fetch_assoc($result)){
                    $id = $users['id'];
                    $name = $users['name'];
                    $email = $users['email'];
                    $password = $users['password'];
                
            ?>
            <tr>
                <td scope="row"><?php echo $id; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $email; ?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    
</body>
</html>