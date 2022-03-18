<?php
    include '../database.php';
    session_start();
    ob_start();
    if(!isset($_SESSION['email'])){
        header('location: ../login.php');
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
<?php
    include '../inc/header.php';
?>
            <div class="content-home">
                <h3>Quản lý người dùng</h3>
                <form action="" method="post">
                    <?php
                        if(isset($_GET['msg'])){
                            echo "<strong style='color:red'>{$_GET['msg']}</strong>" . '<br/>';
                        }
                        if(isset($_POST['submit']) && $_POST['submit']){
                            $name = htmlspecialchars(mysqli_real_escape_string($mysqli ,$_POST['name']));
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
                            
                            $sql = "SELECT * FROM users WHERE name like '%".$name."%' OR email like '%".$name."%' limit $offset, $row_count";
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
                        <td id="del<?php echo $id; ?>">
                            <a href="edit.php?id=<?php echo $id; ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                            
                            <a href="" title="" onclick="delUser(<?php echo $id; ?>)" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                            
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
                                $previous_page = $current_page - 1;
                        ?>
                        <a class="page-link" href="list.php?page=<?php echo $previous_page; ?>" aria-label="Previous">
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
                            if($current_page < $tongST && $tongST < 1){
                                $next_page = $current_page + 1;
                        ?>
                        <a class="page-link" href="list.php?page=<?php echo $next_page; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                        </a>
                        <?php } ?>
                    </li>
                    </ul>
                </nav>
            </div>
            <script type="text/javascript">
                function delUser(id){
                    if(confirm('Bạn có chắc chắn muốn xóa không?')){
                        $.ajax({
                            type: "POST",
                            url: "del.php",
                            data: {del_id:id},
                            success: function(data){
                                $('#del' + id).hide();
                            }
                        });
                    }
                }
            </script>
        </div>
        <!-- left-bar -->
        <?php
            include '../inc/left-bar.php';
        ?>
    <!-- footer -->
    <?php
        include '../inc/footer.php';
    ?>