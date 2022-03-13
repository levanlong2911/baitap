<?php
    session_start();
    ob_start();
    include 'database.php';
    if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
        $ck_email = $_COOKIE['email'];
        $ck_password = $_COOKIE['password'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Đăng nhập</title>
    <style>
        span{
            color: red;
            display: block;
        }
    </style>
    <script type="text/javascript">
        // Lấy giá trị của 1 ô input
        function getValue(id){
            return document.getElementById(id).value.trim();
        }
        // hiển thị thông báo lổi
        function showError(key, msg){
            document.getElementById(key + '_error').innerHTML = msg;
        }
        function validate(){
            
            var flag = true;
            // kiểm tra email
            var email = getValue('email');
            var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if(email == ''){
                flag = false;
                showError('email', 'Vui lòng nhập email');
            }else if(!mailformat.test(email)){
                flag = false;
                showError('email', 'Vui lòng nhập lại email đúng định dạng');
            }else{
                showError('email', '');
            }
            // Kiểm tra password
            var password = getValue('password');
            
            // Tối thiểu tám và tối đa 20 ký tự, ít nhất một chữ cái viết hoa, một chữ cái viết thường, một số và một ký tự đặc biệt:
            var passformat = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/;
            if(password == ''){
                flag = false;
                showError('password', 'Vui lòng nhập mật khẩu');
            }else if(!passformat.test(password)){
                flag = false;
                showError('password', 'Vui lòng nhập mật khẩu tối thiểu 8 và tối đa 20 ký tự, ít nhất một chữ cái viết hoa, một chữ cái viết thường, một số và một ký tự đặc biệt.');
            }else{
                showError('password', '');
            }

            return flag;
        }
    </script>
</head>
<body>
<div class="wraper">
        <div class="container">
            <div class="row justify-content-center my-5 form-signup">
                <form action="" method="post" class="col-md-6 bg-light p-3" onsubmit="return validate()">
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
                                        if(isset($_POST['ghinho']) && ($_POST['ghinho'])){
                                            setcookie('email', $email, time() + (86400*30));
                                            setcookie('password', $password, time() + (86400*30));
                                        }
                                        header('location: ./user/list.php');
                                    }else{
                                        echo '<strong style="color:red">Email hoặc password nhập sai</strong>';
                                    }
                                }
                            }else{
                                echo '<strong style="color:red">Tài khoản không tồn tại, vui lòng đăng ký để tiếp tục đăng nhập</strong>';
                            }
                            
                        }
                    ?>
                    <h1 class="text-center text-uppercase h3 py-3">ĐĂNG NHẬP</h1>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="1234@gmail.com" value="<?php if(isset($ck_email)) echo $ck_email;?>">
                        <span id="email_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="VD: Nguyenvanan11@" value="<?php if(isset($ck_password)) echo $ck_password;?>">
                        <span id="password_error"></span>
                    </div>
                    <input type="checkbox" name="ghinho"> Ghi nhớ tài khoản?
                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Đăng nhập">
                    <a href="signup.php" style="text-decoration: none;" class="row justify-content-center">Tạo tài khoản</a>
                    <a href="forgotPass.php" style="text-decoration: none;" class="row justify-content-center">Quên mật khẩu</a>
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>
<?php
    ob_end_flush();
?>