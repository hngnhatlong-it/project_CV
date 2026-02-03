<?php 
    //Bao gồm file constants
    include('../config/constants.php');
    if(isset($_GET['id']) && isset($_GET['image_name'])) //Sử dụng '&&' hoặc 'AND'
    { 
        //1.  Lấy ID và tên ảnh
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        //2. Kiểm tra xem hình ảnh có sẵn hay không và chỉ xóa nếu có
        if($image_name != "")
        {
           // Nó có hình ảnh và cần xóa khỏi thư mục
           // Lấy đường dẫn hình ảnh       
            $path = "../images/food/".$image_name;
            //Xóa tệp hình ảnh khỏi thư mục
            $remove = unlink($path);
            //Kiểm tra xem hình ảnh đã được xóa hay chưa
            if($remove==false)
            {
                //Lỗi khi xóa ảnh
                $_SESSION['upload'] = "<div class='error'>Lỗi khi xóa file hình ảnh. Vui lòng kiểm tra lại!</div>";
                //Chuyển hướng đến quản lý món ăn
                header('location:'.SITEURL.'admin/manage-food.php');
                //Dừng tiến trình
                die();
            }
        }
        //3. Xóa món ăn ra khỏi Database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //Thực hiện truy vấn
        $res = mysqli_query($conn, $sql);
        //Kiểm tra xem truy vấn có được thực hiện hay không và đặt thông báo
        //4. Chuyển hướng đến Quản lý thực phẩm với Session
        if($res==true)
        {
            //Xóa món ăn
            $_SESSION['delete'] = "<div class='success'>Xóa món ăn thành công!</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Lỗi khi xóa món ăn
            $_SESSION['delete'] = "<div class='error'>Lỗi khi xóa món ăn. Vui lòng kiểm tra lại!</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
    else
    {
        //Chuyển hướng đến trang quản lý món ăn
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>