<?php
    include 'database.php';
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <title>Sigup</title>
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
            // Kiểm tra password
            var password = getValue('password');
            
            // Tối thiểu tám và tối đa 20 ký tự, ít nhất một chữ cái viết hoa, một chữ cái viết thường, một số và một ký tự đặc biệt:
            var passformat = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/;
            if(password == ''){
                flag = false;
                showError('password', 'Vui lòng nhập mật khẩu');
            }else if(!passformat.test(password)){
                flag = false;
                showError('password', 'Vui lòng nhập mật khẩu tối thiểu tám và tối đa 20 ký tự, ít nhất một chữ cái viết hoa, một chữ cái viết thường, một số và một ký tự đặc biệt.');
            }else{
                showError('password', '');
            }

            // Kiểm tra xác nhận mật khẩu
            var passwordconfirm = getValue('passwordconfirm');
            if(passwordconfirm == ''){
                flag = false;
                showError('passwordconfirm', 'Vui lòng nhập lại mật khẩu');
            }else if(passwordconfirm != password){
                flag = false;
                showError('passwordconfirm', 'Mật khẩu không khớp');
            }else{
                showError('passwordconfirm', '');
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
                        if(isset($_GET['token'])){
                            $token = $_GET['token'];
                            
                            // echo $email;
                            // die();
                        }
                        $currentDate = date('U');
                        $sql = "SELECT * FROM tokenpass WHERE token_hash = '$token'";
                        $kq = $mysqli->query($sql);
                        $row = mysqli_fetch_array($kq);
                        $email = $row['token_email'];
                        $token_expires = $row['token_expires'];
                        if($token_expires >= $currentDate){
                            if(isset($_POST['submit'])){
                                $token_reset = $_POST['token'];
                                $email_reset = htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['email']));
                                $password_reset = htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['password']));
                                $pass_hash = password_hash($password_reset, PASSWORD_BCRYPT);
                                $query = "UPDATE users SET password = '$pass_hash' WHERE email = '$email_reset'";
                                $result = $mysqli->query($query);
                                if($result){
                                    echo '<strong style="color:red">Đổi mật khẩu thành công</strong>';
                                }else{
                                    echo '<strong style="color:red">Đã có lổi khi đổi mật khẩu</strong>';
                                }
                            }
                        }else{
                            echo '<strong style="color:red">Yêu cầu đặt lại mật khẩu của bạn đã hết hạn, vui lòng gửi lại yêu cầu</strong>';
                        }
                        
                    ?>
                    <h1 class="text-center text-uppercase h3 py-3">THAY ĐỔI MẬT KHẨU</h1>
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="VD: Nguyenvanan11@">
                        <span id="password_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="passwordconfirm">Password confirm</label>
                        <input type="password" name="passwordconfirm" id="passwordconfirm" class="form-control" placeholder="Xác nhận lại password">
                        <span id="passwordconfirm_error"></span>
                    </div>
                    <!-- <button type="submit" name="submit" onclick="validate();" >Đăng ký</button> -->
                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Đổi mật khẩu">
                    <a href="signup.php" style="text-decoration: none;" class="row justify-content-center">Tạo tài khoản</a>
                    <a href="login.php" style="text-decoration: none;" class="row justify-content-center">Đăng nhập</a>
                </form>
                
            </div>
        </div>
    </div>
</body>

</html>
<?php
    ob_end_flush();
?>