<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Thêm Admin</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['add'])) //Kiểm tra Session xem là Set hay Not
            {
                echo $_SESSION['add']; //Hiển thị thông báo nếu là Set
                unset($_SESSION['add']); //Xóa tin nhắn
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Tên: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Nhập tên của bạn ...">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Username của bạn ...">
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Password của bạn ...">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Thêm Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>
<?php 
    //Xử lý giá trị từ form và lưu vào Database
    //Kiểm tra xem nút gửi đã được nhấp vào hay chưa
    if(isset($_POST['submit']))
    {
        //Nút đã được nhấp thì echo ra để thông báo
        //1. Lấy dữ liệu từ biểu mẫu
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Mã hóa mật khẩu với MD5
        //2. Truy vấn SQL để lưu dữ liệu vào cơ sở dữ liệu
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
        //3. Thực hiện truy vấn và lưu dữ liệu vào cơ sở dữ liệu
        $res = mysqli_query($conn, $sql); //or die(mysqli_error());
        //4. Kiểm tra xem dữ liệu (Query is Executed) đã được chèn hay chưa và hiển thị thông báo phù hợp
        if($res==TRUE)
        {
            //Dữ liệu đã chèn thì echo ra thông báo
            //Tạo một biến để hiện thị tin nhắn
            $_SESSION['add'] = "<div class='success'>Đã thêm Admin thành công!</div>";
            //Chuyển hướng trang đến quản lý Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Không chèn được Data thì xuất echo ra thông báo
            //Tạo biến để hiển thị thông báo
            $_SESSION['add'] = "<div class='error'>Lỗi khi thêm Admin. Vui lòng kiểm tra lại!</div>";
            //Chuyển hướng trang để thêm Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>