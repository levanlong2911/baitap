<?php
    include 'database.php';
    session_start();
    ob_start();
    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }
    define('ROW_COUNT', 10);
    // phân trang
    $query = "SELECT count(*) AS TSD FROM users";
    $result = $mysqli->query($query);
    $arr_user = mysqli_fetch_assoc($result);
    $tongSD = $arr_user['TSD'];
    // Số bài viết trên trang
    $row_count = ROW_COUNT;
    // Tổng số Trang
    $tongST = ceil($tongSD/$row_count);
    // Trang hiện tại
    $current_page = 1;
    if(isset($_GET['page'])){
        $current_page = $_GET['page'];
    }
    // off set 
    $offset = ($current_page -1)*$row_count;
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>admin</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../baitap4/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../baitap4/assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="../baitap4/assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../baitap4/assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="../baitap4/assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>
    <div class="wrapper">
        <div class="main-panel">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand">Trang quản trị viên</a>
                    </div>
                    <?php
                        if(isset($_SESSION['email'])){
                        
                    ?>
                    <div class="nav navbar-nav navbar-right" >
                        Xin chào, <b><?php echo $_SESSION['email']; ?></b> &nbsp;<a href="../baitap4/logout.php" class="btn btn-danger square-btn-adjust">Đăng xuất</a>
                    </div>
                    <?php } ?>
                </div>
            </nav>
            <div class="content-home">
                <h3>Quản lý người dùng</h3>
                <form action="list.php" method="post">
                    <?php
                        if(isset($_POST['submit']) && $_POST['submit']){
                            $name = $_POST['name'];
                        }else{
                            $name = '';
                        }
                    ?>
                    <input type="text" name="name" id="" placeholder="Name">
                    <input type="submit" name="submit" value="Tìm kiếm">
                    <br/><br/>
                </form>
                <table class="table table-bordered table-hover center">
                    <thead>
                        <tr>
                            <th scope="col" width="20px">id</th>
                            <th scope="col" width="400px">Name</th>
                            <th scope="col" width="400px">Email</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                            $sql = "SELECT * FROM users WHERE name like '%$name%' OR email like '%$name%' limit $offset, $row_count";
                            $kq = $mysqli->query($sql);
                            while($ar_users = mysqli_fetch_assoc($kq)){
                                $id = $ar_users['id'];
                                $name = $ar_users['name'];
                                $email = $ar_users['email'];
                                    
                        ?>
                        <tr>
                        <th scope="row"><?php echo $id; ?></th>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $email; ?></td>
                        <td>
                            <a href="" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                            
                            <a href="" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                            
                        </td>
                        </tr>
                        <?php
                            }

                        ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="row pagination justify-content-center">
                    <li class="page-item">
                        <?php
                            if($current_page > 1 && $tongST > 1){
                        ?>
                        <a class="page-link" href="list.php?page=<?php echo $current_page; ?>-1" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <?php } ?>
                    </li>
                    <?php
                        for($i=1; $i <= $tongST; $i++){
                    ?>
                        <?php
                        if($i == $current_page){
                        ?>
                        <li class="page-item"><a class="page-link"><?php echo $current_page; ?></a></li> 
                        <?php
                        }else{
                        ?>
                        <li class="page-item"><a class="page-link" href="list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li> 
                        <?php
                        }
                        ?>
                    <?php
                        }
                    ?>
                    <li class="page-item">
                        <?php
                            if($current_page < 1 && $tongST < 1){
                        ?>
                        <a class="page-link" href="list.php?page=<?php echo $current_page; ?>+1" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                        </a>
                        <?php } ?>
                    </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- left-bar -->
        <div class="sidebar" data-background-color="white" data-active-color="danger">
        <div class="sidebar-wrapper">
            <div class="logo">
                <h3>Bài tập</h3>
            </div>
            <ul class="nav">
                
                <li>
                    <a href="">
                        <p>Quản lý người dùng</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    </div>
    <!-- footer -->
</body>

    <!--   Core JS Files   -->
    <script src="../baitap4/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="../baitap4/assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="../baitap4/assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="../baitap4/assets/js/demo.js"></script>


</html>
<?php
    ob_end_flush();
?>