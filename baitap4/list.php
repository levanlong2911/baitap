<?php
    session_start();
    if(isset($_SESSION['email'])){
?>
        <h3><?php echo'Email đăng nhập của bạn là: ' . $_SESSION['email']; ?></h3>
<?php
    }
?>
<a href="login.php" style="text-decoration: none;">Đăng xuất</a>
<h1>Danh sách người dùng</h1>