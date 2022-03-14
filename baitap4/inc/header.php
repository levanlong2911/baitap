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
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="../assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/themify-icons.css" rel="stylesheet">
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
                        Xin chào, <b><?php echo $_SESSION['email']; ?></b> &nbsp;<a href="../logout.php" class="btn btn-danger square-btn-adjust">Đăng xuất</a>
                    </div>
                    <?php } ?>
                </div>
            </nav>