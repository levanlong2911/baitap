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

            // Kiểm tra name
            var name = getValue('name');
            if(name == ''){
                flag = false;
                showError('name', 'Vui lòng nhập họ và tên')
            }else if(name.length <= 6){
                flag = false;
                showError('name', 'Vui lòng nhập tên ít nhất 6 ký tự');
            }else if(name.length >= 32){
                flag = false;
                showError('name', 'Vui lòng nhập tên nhiều nhất 32 ký tự');
            }else{
                showError('name', '');
            }


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
                            $name = mysqli_real_escape_string($mysqli, $_POST['name']);
                            $email = mysqli_real_escape_string($mysqli, $_POST['email']);
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
                                $query = "INSERT INTO users(name, email, password) values ('$name', '$email', '$hashPass')";
                                $kq = $mysqli->query($query);
                                
                                
                                $mail = new PHPMailer(true);//true:enables exceptions
                                
                        
                                try {
                                    $mail->SMTPDebug = 2; //0,1,2: chế độ debug. khi chạy ngon thì chỉnh lại 0 nhé
                                    $mail->isSMTP();  
                                    $mail->CharSet  = "utf-8";
                                    $mail->Host = 'smtp.gmail.com';  //SMTP servers (địa chỉ email server)
                                    $mail->SMTPAuth = true; // Enable authentication (cho phép kiểm tra usernam và password có đúng hay khống)
                                    $mail->Username = 'khanhvy1212.56@gmail.com'; // SMTP username
                                    $mail->Password = 'vanlong5656';   // SMTP password
                                    $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL (thư được mã hóa dưới 2 dạng TLS/SSL)
                                    $mail->Port = 465;  // port to connect to      (port TLS/587 còn SSL/465)          
                                    $mail->setFrom('khanhvy1212.56@gmail.com', 'admin' ); 
                                    $mail->addAddress($email, 'thanhvien'); //mail và tên người nhận  
                                    $mail->isHTML(true);  // Set email format to HTML
                                    $mail->Subject = 'Thư chào mừng';
                                    // $noidungthu = '<p>Nội dung</p>'; 
                                    $noidungthu = "<p>Chúc mừng bạn đã đăng ký thành công</p>"; 
                                    
                                    $mail->Body = $noidungthu;
                                    // code chạy trên localhost khi đưa lên server thì xóa
                                    // $mail->smtpConnect( array(
                                    //     "ssl" => array(
                                    //         "verify_peer" => false,
                                    //         "verify_peer_name" => false,
                                    //         "allow_self_signed" => true
                                    //     )
                                    // ));
                                    $mail->send();
                                    echo 'Đã gửi mail xong';
                                } catch (Exception $e) {
                                    echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
                                }
                                header('location: login.php?msg=Đăng ký tài khoản thành công');
                            }
                                
                                
                            
                        }
                    ?>
                    <h1 class="text-center text-uppercase h3 py-3">ĐĂNG KÝ TÀI KHOẢN</h1>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="VD: Nguyễn Văn A">
                        <span id="name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="1234@gmail.com">
                        <span id="email_error"></span>
                    </div>
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
                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Đăng ký">
                </form>
                
            </div>
        </div>
    </div>
</body>

</html>
<?php
    ob_end_flush();
?>