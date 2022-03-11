<?php
    ob_start();
    include 'database.php';
    include 'PHPMailer-master/src/PHPMailer.php'; 
    include 'PHPMailer-master/src/SMTP.php'; 
    include 'PHPMailer-master/src/Exception.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Quên mật khẩu</title>
    <style>
        span{
            color:red;
            display:block;
        }
    </style>
    <script type="text/javascript">
        function getValue(id){
            return document.getElementById(id).value.trim();
        }
        function showError(key, msg){
            document.getElementById(key + '_error').innerHTML = msg;
        }
        function validate(){
            var flag = true;
            var email = getValue('email');
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
                            $query = "SELECT * FROM users WHERE email ='$email'";
                            $result = $mysqli->query($query);
                            // Kiểm tra email nếu có thì gửi email
                            if(mysqli_num_rows($result) > 0){
                                $token  = bin2hex(random_bytes(12));
                                $url = "http://localhost/baitap/baitap4/resert-password?token='.$token.'";
                                $expires = date('U') + 86400; // thời gian token sống trong vòng 1 ngày
                                $sql = "INSERT INTO tokenpass(token_email, token_hash, token_expires) VALUES ('$email', '$token', '$expires')";
                                $kq = $mysqli->query($sql);
                                $mail = new PHPMailer(true);//true:enables exceptions
                                try {
                                    $mail->SMTPDebug = 0; //0,1,2: chế độ debug. khi chạy ngon thì chỉnh lại 0 nhé
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
                                    $mail->Subject = 'Thay đổi mật khẩu';
                                    // $noidungthu = '<p>Nội dung</p>'; 
                                    $noidungthu = "<p>Vui lòng nhấn vào đường dẫn phía dưới</p>"; 
                                    $noidungthu .= "<p>Link: $url</p>"; 
                                    
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
                                    // echo 'Đã gửi mail xong';
                                } catch (Exception $e) {
                                    echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
                                }
                                echo '<strong style="color:red">Gửi mail thành công, vui lòng kiểm tra mail để thay đổi mật khẩu</strong>';
                            }else{
                                echo '<strong style="color:red">Email không tồn lại</strong>';
                            }
                        }
                    ?>
                    <h1 class="text-center text-uppercase h3 py-3">FORGOT PASSWORD</h1>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="1234@gmail.com">
                        <span id="email_error"></span>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Gửi mail">
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