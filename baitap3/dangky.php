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
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            
            if($name == '' || $email == '' || $password == ''){
                echo "<strong style='color:red'>Vui lòng nhập đầy đủ thông tin</strong>";
            }else{
                $query = "INSERT INTO user(name, email, password) VALUES ('$name', '$email', '$password')";
                $result = $mysqli->query($query);
                header('location: dangky.php?msg=Đăng ký thành công');
            }
        }
    ?>
    <h1>Đăng ký</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="">Họ và tên</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nhập họ và tên">
            <p>
            <?php
            if(isset($_POST['submit'])){
                $name = $_POST['name'];
                if($name == ''){
                    echo "<strong style='color:red'>Vui lòng nhập name</strong>";
                }
            }
            ?>
            </p>
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Nhập email">
            <p>
            <?php
            if(isset($_POST['submit'])){
                $email = $_POST['email'];
                if($email == ''){
                    echo "<strong style='color:red'>Vui lòng nhập email</strong>";
                }
            }
            ?>
            </p>
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            <p>
            <?php
            if(isset($_POST['submit'])){
                $password = $_POST['password'];
                if($password == ''){
                    echo "<strong style='color:red'>Vui lòng nhập password</strong>";
                }
            }
            ?>
            </p>
        </div>
        <button type="submit" name="submit">Đăng ký</button>
    </form>
    
</body>
</html>