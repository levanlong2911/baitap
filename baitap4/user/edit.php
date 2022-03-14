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
                            $id = $_GET['id'];
                            $sql = "SELECT * FROM users where id = '$id'";
                            $kq = $mysqli->query($sql);
                            $ar_users = mysqli_fetch_assoc($kq);
                            if(isset($_POST['submit'])){
                                $name = htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['name']));
                                $email = mysqli_real_escape_string($mysqli, $_POST['email']);
                                $password = htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['password']));
                                if($password == ''){
                                    $query = "UPDATE users SET name = '$name' where id = $id ";
                                    $result = $mysqli->query($query);
                                    if($result){
                                        header('location: list.php?msg=Sửa thành công');
                                    }else{
                                        echo '<strong style="color: red">Đã có lổi khi sửa</strong>';
                                    }
                                }else{
                                    $pass_hash = password_hash($password, PASSWORD_BCRYPT);
                                    $sql2 = "UPDATE users SET name = '$name', password = '$pass_hash' where id = $id ";
                                    $kq2 = $mysqli->query($sql2);
                                    if($kq2){
                                        header('location: list.php?msg=Sửa thành công');
                                    }else{
                                        echo 'Đã có lổi khi sửa';
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
                                <input type="password" class="form-control" name="password" id="password"  value="<?php echo $ar_users['password']; ?>">
                                <span id="password_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="passwordconfirm">Passwordconfirm</label>
                                <input type="password" class="form-control" name="passwordconfirm" id="passwordconfirm"  value="<?php echo $ar_users['password']; ?>">
                                <span id="passwordconfirm_error"></span>
                            </div>
                            <input type="submit" name="submit" value="Sửa">
                        </form>
                        
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