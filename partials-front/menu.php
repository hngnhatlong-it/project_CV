<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast Food Store</title>
    <!-- Kết nối file Css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Phần logo + hình giới thiệu ngay khung search -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo1.jpg" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Trang chủ</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>introduce.php">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Danh mục món</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Các món ăn</a>
                    </li>
                    <li>
                    <a href="<?php echo SITEURL; ?>contact.php">Liên hệ</a>
                    </li>
                    <li>
                    <a href="<?php echo SITEURL; ?>admin/login.php">Truy cập trang quản trị</a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
