<?php 
    //Bao gồm tệp constants.php ở đây
    include('../config/constants.php');
    // 1. Lấy ID của đơn hàng cần xóa
    $id = $_GET['id'];
    //2. Tạo truy vấn SQL để xóa Đơn hàng
    $sql = "DELETE FROM tbl_order WHERE id=$id";
    //Thực hiện truy vấn
    $res = mysqli_query($conn, $sql);
    //Kiểm tra xem truy vấn có được thực hiện thành công hay không
    if($res==true)
    {
        //Truy vấn được thực hiện thành công và quản trị viên đã xóa đơn hàng
        //Tạo biến Session để hiển thị thông báo
        $_SESSION['delete'] = "<div class='success'>Đã xóa đơn hàng thành công!.</div>";
        //Chuyển hướng đến trang quản lý đơn hàng
        header('location:'.SITEURL.'admin/manage-order.php');
    }
    else
    {
        //Không xóa được đơn hàng và echo ra thông báo
        $_SESSION['delete'] = "<div class='error'>Lỗi khi xóa đơn hàng. Vui lòng kiểm tra lại!</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
    //3. Chuyển hướng đến trang quản lý đơn hàng với thông báo thành công hoặ lỗi
?>

if($res==true)
    {
        //Truy vấn được thực hiện thành công và quản trị viên đã xóa
        //echo "Đã xóa Admin thành công!";
        //Tạo biến Session để hiển thị thông báo
        $_SESSION['delete'] = "<div class='success'>Đã xóa Admin thành công!.</div>";
        //Chuyển hướng đến trang quản lý Admin
        header('location:'.SITEURL.'admin/manage-admin.php');
    }