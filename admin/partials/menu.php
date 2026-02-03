<?php 
    include('../config/constants.php'); 
    include('login-check.php');
?>
<html>
    <head>
        <title>Quản trị</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <!-- Bắt đầu phần menu -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="manage-admin.php">Quản trị viên</a></li>
                    <li><a href="manage-category.php">Danh mục</a></li>
                    <li><a href="manage-food.php">Món ăn</a></li>
                    <li><a href="manage-order.php">Đơn hàng</a></li>
                    <li><a href="logout.php">Đăng xuất</a></li>
                    <li><a href="http://localhost:8080/WebSite_FastFood/">Quay lại</a></li>
                </ul>
            </div>
        </div>
    </body>
</html>
        <!-- Kết thúc phần menu -->