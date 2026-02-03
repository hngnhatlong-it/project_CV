<?php include('partials/menu.php'); ?>
        <!-- Bắt đầu nội dung chính -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Quản lý Admin</h1>
                <br />
                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Hiển thị tin nhắn Session
                        unset($_SESSION['add']); //Xóa tin nhắn Session
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                ?>
                <br><br><br>
                <!-- Nút thêm Admin -->
                <a href="add-admin.php" class="btn-primary">Thêm Admin</a>
                <br /><br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Username</th>
                        <th>Trạng thái</th>
                    </tr>                    
                    <?php 
                        //Truy vấn tất cả Admin
                        $sql = "SELECT * FROM tbl_admin";
                        //Thực hiện truy vấn
                        $res = mysqli_query($conn, $sql);
                        //Kiểm tra xem truy vấn có được thực hiện hay không
                        if($res==TRUE)
                        {
                            //Tạo biến đếm
                            $count = mysqli_num_rows($res); //Chức năng để lấy tất cả các hàng trong cơ sở dữ liệu
                            $sn=1; //Tạo một biến và gán giá trị
                            //Kiểm tra biến đếm
                            if($count>0)
                            {
                                //Chúng ta có dữ liệu trong cơ sở dữ liệu
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //Sử dụng vòng lặp While để lấy tất cả dữ liệu từ cơ sở dữ liệu.
                                    //Vòng lặp While sẽ chạy miễn là chúng ta có dữ liệu trong cơ sở dữ liệu
                                    //Lấy từng Data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Hiển thị tất cả giá trị trong bảng
                                    ?>                                 
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Đổi mật khẩu</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhật</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Xóa</a>
                                        </td>
                                    </tr>
                    <?php
                                }
                            }
                            else
                            {
                                //Nếu không có cơ sở dữ liệu
                            }
                        }
                    ?> 
                </table>
            </div>
        </div>
        <!-- Kết thúc nội dung chính -->
<?php include('partials/footer.php'); ?>