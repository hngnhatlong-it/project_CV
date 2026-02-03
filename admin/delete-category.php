<?php 
    //Bao gồm file Constants
    include('../config/constants.php');
    //echo "Xóa trang";
    //Kiểm tra xem giá trị Id và image_name đã được đặt hay chưa
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Lấy giá trị và xóa
        //echo "Lấy giá trị và xóa";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        //Xóa tệp hình ảnh
        if($image_name != "")
        {
            //Hình ảnh có sẵn và hãy xóa nó
            $path = "../images/category/".$image_name;
            //Xóa hình ảnh
            $remove = unlink($path);
            //Nếu không xóa được hình ảnh thì hãy thêm thông báo lỗi và dừng quá trình
            if($remove==false)
            {
                //Đặt thông báo Session
                $_SESSION['remove'] = "<div class='error'>Lỗi khi xóa hình ảnh danh mục. Vui lòng kiểm tra lại!</div>";
                //Chuyển hướng đến trang quản lý danh mục
                header('location:'.SITEURL.'admin/manage-category.php');
                //Kết thúc tiến trình
                die();
            }
        }
        //Truy vấn SQL để xóa dữ liệu khỏi cơ sở dữ liệu
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        //Thực hiện truy vấn
        $res = mysqli_query($conn, $sql);
        //Kiểm tra xem dữ liệu có bị xóa khỏi cơ sở dữ liệu hay không
        if($res==true)
        {
            //Thiết lập thông báo thành công và chuyển hướng
            $_SESSION['delete'] = "<div class='success'>Xóa danh mục thành công!</div>";
            //Chuyển hướng đến quản lý danh mục
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Đặt thông báo lỗi và chuyển hướng
            $_SESSION['delete'] = "<div class='error'>Lỗi khi xóa danh mục. Vui lòng kiểm tra lại!</div>";
            //Chuyển hướng đến quản lý danh mục
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
    //chuyển hướng đến trang quản lý danh mục        
    header('location:'.SITEURL.'admin/manage-category.php');
    }
?>