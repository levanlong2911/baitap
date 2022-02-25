<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/baitap/baitap3/DatabaseConnectUtil.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
</head>
<body>
    <?php
        if(isset($_GET['msg'])){
            echo $_GET['msg'];
        }
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            // if($name == ''){
            //     $errorName = '<style color="red">Vui lòng nhập name</style>';
            // }
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $query = "INSERT INTO user(name, email, password) VALUES ('$name', '$email', '$password')";
            $result = $mysqli->query($query);
            if($result){
                header("Location: /dangky.php?msg=Đăng ký thành công");
            }else{
                echo 'Đã có lổi khi đăng ký';
            }
        }
    ?>
    <h1>Đăng ký</h1>
    <form action="" method="post">
        <div class="form-group">
          <label for="">Họ và tên</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="Nhập họ và tên">
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Nhập email">
        </div>
        <div class="form-group">
          <label for="">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <button type="submit" name="submit">Đăng ký</button>
    </form>
    
</body>
</html>