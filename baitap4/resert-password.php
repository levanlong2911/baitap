<?php
    include 'database.php';
    include 'PHPMailer-master/src/PHPMailer.php'; 
    include 'PHPMailer-master/src/SMTP.php'; 
    include 'PHPMailer-master/src/Exception.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
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
                        if(isset($_GET['msg'])){
                            echo "<strong style='color:red'>{$_GET['msg']}</strong>";
                        }
                        if(isset($_POST['submit'])){
                            $password = mysqli_real_escape_string($mysqli, $_POST['password']);
                            $sql = "SELECT * FROM users WHERE name = '$name' OR email = '$email'";
                            $result = $mysqli->query($sql);
                            // echo '<pre>';
                            //     print_r($result);
                            // echo '</pre>';
                            // die();
                            if(mysqli_num_rows($result) > 0){
                                header('location: signup.php?msg=Tài khoản đã tồn tại');
                            }else{
                                $hashPass = password_hash($password, PASSWORD_BCRYPT);
                                $kq = $mysqli->query($query);
                                header('location: login.php?msg=Đăng ký tài khoản thành công');
                            }
                                
                                
                            
                        }
                    ?>
                    <h1 class="text-center text-uppercase h3 py-3">THAY ĐỔI MẬT KHẨU</h1>
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
                </form>
                
            </div>
        </div>
    </div>
</body>

</html>
<?php
    ob_end_flush();
?>