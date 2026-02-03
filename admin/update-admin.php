<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Cập nhật Admin</h1>
        <br><br>
        <?php 
            //1. Lấy ID của Admin đã chọn
            $id=$_GET['id'];
            //2. Tạo truy vấn SQL để lấy thông tin chi tiết
            $sql="SELECT * FROM tbl_admin WHERE id=$id";
            //Thực thi truy vấn
            $res=mysqli_query($conn, $sql);
            //Kiểm tra xem truy vấn có được thực hiện hay không
            if($res==true)
            {
                //Kiểm tra xem dữ liệu có sẵn hay không
                $count = mysqli_num_rows($res);
                //Kiểm tra xem có dữ liệu quản trị hay không
                if($count==1)
                {
                    //Lấy thông tin chi tiết

                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //Chuyển hướng đến Quản lý trang Admin
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            } 
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Tên: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Cập nhật Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php 
    //Kiểm tra xem nút Submit đã được nhấp hay chưa
    if(isset($_POST['submit']))
    {
        //Lấy tất cả các giá trị từ form để cập nhật   
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        //Tạo truy vấn SQL để cập nhật Admin       
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
        ";
        //Thực thi truy vấn
        $res = mysqli_query($conn, $sql);
        //Kiểm tra xem truy vấn có được thực hiện thành công hay không
        if($res==true)
        {
            //Truy vấn được thực hiện và quản trị viên được cập nhật
            $_SESSION['update'] = "<div class='success'>Cập nhật Admin thành công!</div>";
            //Chuyển hướng đến trang Quản lý Admin
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Lỗi khi cập nhật Admin
            $_SESSION['update'] = "<div class='error'>Failed to Delete Admin.</div>";
            //Chuyển hướng đến trang Quản lý Admin
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>
<?php include('partials/footer.php'); ?>