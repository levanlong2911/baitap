<?php
    session_start();
    ob_start();
    include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Đăng nhập</title>
</head>
<body>
<div class="wraper">
        <div class="container">
            <div class="row justify-content-center my-5 form-signup">
                <form action="" method="post" class="col-md-6 bg-light p-3">
                    <?php
                        // if(isset($_GET['msg'])){
                        //     echo "<strong style='color:red'>{$_GET['msg']}</strong>";
                        // }
                        if(isset($_POST['submit'])){
                            $email = mysqli_real_escape_string($mysqli ,$_POST['email']);
                            $password = mysqli_real_escape_string($mysqli ,$_POST['password']);
                            $query = "SELECT * FROM users WHERE email ='$email'";
                            $result = $mysqli->query($query);
                            
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    if(password_verify($password, $row['password'])){
                                        $_SESSION['email'] = $email;
                                        header('location: list.php?msg=Đăng nhập thành công');
                                    }
                                }
                                
                            }else{
                                echo "<strong style='color:red'>Sai tên đăng nhập hoặc password</strong>";
                            }
                        }
                    ?>
                    <h1 class="text-center text-uppercase h3 py-3">ĐĂNG NHẬP</h1>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="1234@gmail.com">
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
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="VD: Nguyenvanan11@">
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
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Đăng nhập">
                    <a href="signup.php" style="text-decoration: none;" class="row justify-content-center">Tạo tài khoản</a>
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>
<?php
    ob_end_flush();
?>