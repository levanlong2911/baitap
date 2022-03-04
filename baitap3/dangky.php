<?php
    include 'DatabaseConnectUtil.php';
    ob_start();
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
            echo "<strong style='color:red'>{$_GET['msg']}</strong>";
        }
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            
            if($name == '' || $email == '' || $password == ''){
                echo "<strong style='color:red'>Vui lòng nhập đầy đủ thông tin</strong>";
            }else{
                //Kiểm tra tài khoản đã tồn tại hay chưa
                $sql = "SELECT * FROM user WHERE name = '$name' OR email = '$email'";
                $kq = $mysqli->query($sql);
                // Kiểm tra xem nếu trả về lớn 1 thì nghĩa là name hoặc email đã tồn tại
                if(mysqli_num_rows($kq) > 0){
                    echo "<strong style='color:red'>Tài khoản đã tồn tại</strong>";
                }else{
                    $query = "INSERT INTO user(name, email, password) VALUES ('$name', '$email', '$password')";
                    $result = $mysqli->query($query);
                    header('location: dangky.php?msg=Đăng ký thành công');
                }
                
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
        <a href="login.php" style="text-decoration: none;">Đăng nhập</a>
    </form>
    
</body>
</html>
<?php
 ob_end_flush();
?>