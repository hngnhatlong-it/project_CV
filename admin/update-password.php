<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Đổi mật khẩu</h1>
        <br><br>
        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>
        <form action="" method="POST">       
            <table class="tbl-30">
                <tr>
                    <td>Mật khẩu hiện tại: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Mật khẩu cũ ...">
                    </td>
                </tr>
                <tr>
                    <td>Mật khẩu mới:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="Mật khẩu mới ...">
                    </td>
                </tr>
                <tr>
                    <td>Xác nhận mật khẩu mới: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu mới ...">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Thay đổi mật khẩu" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>
<?php 
            //Kiểm tra xem nút Gửi có được nhấp vào hay không
            if(isset($_POST['submit']))
            {
                //echo "CLicked";
                //1. Lấy dữ liệu Form
                $id=$_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);
                //2. Kiểm tra xem người dùng có ID và mật khẩu hiện tại có tồn tại hay không
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
                //Thực thi truy vấn
                $res = mysqli_query($conn, $sql);
                if($res==true)
                {
                    //Kiểm tra xem dữ liệu có sẵn hay không
                    $count=mysqli_num_rows($res);
                    if($count==1)
                    {
                        //Người dùng tồn tại và mật khẩu có thể được thay đổi
                        //echo "User FOund";
                        //Kiểm tra xem mật khẩu mới và xác nhận có khớp nhau hay không
                        if($new_password==$confirm_password)
                        {
                            //Cập nhật mật khẩu
                            $sql2 = "UPDATE tbl_admin SET 
                                password='$new_password' 
                                WHERE id=$id
                            ";

                            //Thực thi truy vấn
                            $res2 = mysqli_query($conn, $sql2);

                            //Kiểm tra xem truy vấn có được thực hiện hay không
                            if($res2==true)
                            {
                                //Chuyển hướng đến trang quản lý quản trị với thông báo thành công
                                $_SESSION['change-pwd'] = "<div class='success'>Thay đổi mật khẩu thành công!</div>";
                                //Chuyển hướng sang quản lý Admin
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                //Hiển thị thông báo lỗi
                                //Chuyển hướng đến trang quản lý Admin với thông báo
                                $_SESSION['change-pwd'] = "<div class='error'>Lỗi khi thay đổi mật khẩu!</div>";
                                //Chuyển hướng sang quản lý Admin
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                        }
                        else
                        {
                            $_SESSION['pwd-not-match'] = "<div class='error'>Mật khẩu không trùng khớp!</div>";
                            //Chuyển hướng sang quản lý Admin
                            header('location:'.SITEURL.'admin/manage-admin.php');

                        }
                    }
                    else
                    {
                        //Người dùng không tồn tại
                        $_SESSION['user-not-found'] = "<div class='error'>Lỗi dữ liệu. Vui lòng kiểm tra lại!</div>";
                        //Chuyển hướng sang quản lý Admin
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                //3. Kiểm tra xem mật khẩu mới và Xác nhận mật khẩu có khớp nhau không
                //4. Đổi mật khẩu nếu tất cả các mục trên là đúng
            }
?>
<?php include('partials/footer.php'); ?>