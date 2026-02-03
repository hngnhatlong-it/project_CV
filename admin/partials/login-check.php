<?php 
    //Kiểm soát truy cập
    //Kiểm tra xem người dùng đã đăng nhập chưa
    if(!isset($_SESSION['user'])) //Nếu người dùng chưa được thiết lập
    {
        //Người dùng chưa đăng nhập được
        //Gửi thông báo qua tin nhắn
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin.</div>";
        //Chuyển hướng đến trang đăng nhập
        header('location:'.SITEURL.'admin/login.php');
    }
?>