<?php
    session_start();
    ob_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/baitap/baitap3/DatabaseConnectUtil.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <h1>Đăng nhập</h1>
    <?php
        // if(isset($_GET['msg'])){
        //     echo $_GET['msg'];
        // }
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
            $result = $mysqli->query($query);
            if(mysqli_num_rows($result) > 0){
                $ar_user = mysqli_fetch_assoc($result);
                // $_SESSION['ar_user'] = $ar_user;
                header('location: save.php?msg=Đăng nhập thành công');
            }else{
                echo 'Sai tên đăng nhập hoặc password';
            }
            $_SESSION['email'] = $email;
        }
    ?>
    
    <form action="" method="post">
        <div class="form-group">
          <label for="">Email</label>
          <input type="email" class="form-control" name="email" id="" placeholder="Nhập email">
        </div>
        <div class="form-group">
          <label for="">Password</label>
          <input type="password" class="form-control" name="password" id="" placeholder="Password">
        </div>
        <button type="submit" name="submit">Đăng nhập</button>
    </form>
    
</body>
</html>
<?php
 ob_end_flush();
?>