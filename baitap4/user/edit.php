<?php
    include '../database.php';
    session_start();
    ob_start();
    if(!isset($_SESSION['email'])){
        header('location: ../login.php');
    }
?>
<?php
    include '../inc/header.php';
?>
            <div class="content-home">
                <h3>Sửa người dùng</h3>
                <div class="row">
                    <div class="col-md-4">
                        <?php
                            if(isset($_GET['id'])){
                                // ép kiểu về string và int để phòng chống sql injection
                                $id = (string)(int)$_GET['id'];
                            }
                            
                            $sql = "SELECT * FROM users where id = '$id'";
                            $kq = $mysqli->query($sql);
                            $ar_users = mysqli_fetch_assoc($kq);
                            if(isset($_POST['submit'])){
                                $name = htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['name']));
                                $email = mysqli_real_escape_string($mysqli, $_POST['email']);
                                $password = htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['password']));
                                if($password == ''){
                                    $sql2 = "UPDATE users SET name = '$name' where id = $id ";
                                    $kq2 = $mysqli->query($sql2);
                                    if($kq2){
                                        header('location: list.php?msg=Sửa thành công');
                                    }else{
                                        echo '<strong style="color:red">Đã có lổi khi sửa</strong>';
                                    }
                                }else{
                                    $pass_hash = password_hash($password, PASSWORD_BCRYPT);
                                    $sql3 = "UPDATE users SET name = '$name', password = '$pass_hash' where id = $id ";
                                    $kq3 = $mysqli->query($sql3);
                                    if($kq3){
                                        header('location: list.php?msg=Sửa thành công');
                                    }else{
                                        echo '<strong style="color:red">Đã có lổi khi sửa</strong>';
                                    }
                                }
                                
                            }
                        ?>
                        
                        <form action="" method="post" onsubmit="return validate()">
                            <div class="form-group">
                                <label for="name">Họ và tên</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $ar_users['name']; ?>">
                                <span id="name_error"></span>
                            </div>
                            <!-- không cho đổi thay đổi gmail -->
                            <div class="form-group">
                                <label for="email">Email</label> 
                                <input type="text" class="form-control" name="email" id="email" readonly value="<?php echo $ar_users['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                                <span id="password_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="passwordconfirm">Passwordconfirm</label>
                                <input type="password" class="form-control" name="passwordconfirm" id="passwordconfirm">
                                <span id="passwordconfirm_error"></span>
                            </div>
                            <input type="submit" name="submit" value="Sửa">
                        </form>
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
                                // Kiểm tra password
                                var password = getValue('password');
                                
                                // Tối thiểu tám và tối đa 20 ký tự, ít nhất một chữ cái viết hoa, một chữ cái viết thường, một số và một ký tự đặc biệt:
                                // var passformat = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/;
                                // if(password == ''){
                                //     flag = false;
                                //     showError('password', 'Vui lòng nhập mật khẩu');
                                // }else if(!passformat.test(password)){
                                //     flag = false;
                                //     showError('password', 'Vui lòng nhập mật khẩu tối thiểu tám và tối đa 20 ký tự, ít nhất một chữ cái viết hoa, một chữ cái viết thường, một số và một ký tự đặc biệt.');
                                // }else{
                                //     showError('password', '');
                                // }

                                // Kiểm tra xác nhận mật khẩu
                                var passwordconfirm = getValue('passwordconfirm');
                                if(passwordconfirm != password){
                                    flag = false;
                                    showError('passwordconfirm', 'Mật khẩu không khớp');
                                }else{
                                    showError('passwordconfirm', '');
                                }

                                return flag;
                            }
                        </script>
                    </div>

                </div>
                
               
            </div>
        </div>
        <!-- left-bar -->
        <?php
            include '../inc/left-bar.php';
        ?>
    <!-- footer -->
    <?php
        include '../inc/footer.php';
    ?>