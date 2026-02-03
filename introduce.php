<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fast Food Online</title>
    <!--Css trực tiếp -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        /* Header */
        header {
            background-color:rgb(223, 162, 196);
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            font-size: 36px;
        }

        /* Navigation */
        nav {
            margin: 20px 0;
            text-align: center;
        }

        nav a {
            color: #333;
            font-size: 18px;
            margin: 0 20px;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
        }

        nav a:hover {
            background-color:rgb(203, 88, 143);
            color: white;
        }

        /* Giới thiệu */
        .about {
            background-color:#c8e7d8;
            padding: 40px 0;
            text-align: center;
        }

        .about h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .about p {
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        /* Dịch vụ */
        .services {
            padding: 40px 0;
            text-align: center;
        }

        .services h2 {
            font-size: 32px;
            margin-bottom: 30px;
        }

        .service {
            display: inline-block;
            width: 30%;
            text-align: center;
            margin: 10px;
        }

        .service img {
            width: 100%;
            border-radius: 10px;
        }

        .service h3 {
            font-size: 24px;
            margin-top: 15px;
        }

        .service p {
            font-size: 16px;
            color: #555;
        }

        /* Liên hệ */
        .contact {
            background-color: #f4f4f4;
            padding: 40px 0;
            text-align: center;
        }

        .contact h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .contact p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .contact ul {
            list-style: none;
            font-size: 18px;
        }

        .contact ul li {
            margin-bottom: 10px;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <h1>Fast Food Online</h1>
            <p>Đặt thức ăn nhanh trực tuyến ngay hôm nay!</p>
        </div>
    </header>
    <!-- Navigation -->
    <nav>
        <a href="index.php">Trang Chủ</a>
        <a href="foods.php">Menu</a>
    </nav>
    <!-- Giới thiệu -->
    <section class="about">
        <div class="container">
            <h2>Giới Thiệu Về Website</h2>
            <p>Chào mừng bạn đến với trang Web của Fast Food Store, nơi bạn có thể đặt những món ăn ngon miệng và tiện lợi chỉ trong vài cú click chuột. Chúng tôi cung cấp các món ăn nhanh, từ Burger, Pizza cho đến các món ăn vặt khác với chất lượng tuyệt vời và giao hàng nhanh chóng.</p>
            <p>Với đội ngũ đầu bếp chuyên nghiệp và nguyên liệu tươi ngon, chúng tôi cam kết mang đến cho bạn những món ăn hấp dẫn, ngon miệng và đảm bảo an toàn vệ sinh thực phẩm. Hãy để chúng tôi làm bạn hài lòng với những bữa ăn ngon lành!</p>
        </div>
    </section>
    <!-- Dịch vụ -->
    <section class="services">
        <div class="container">
            <h2>Chúng Tôi Cung Cấp Dịch Vụ Gì?</h2>
            <div class="service">
                <img src="./images/giaohang.png" alt="Dịch vụ giao hàng">
                <h3>Giao Hàng Nhanh Chóng</h3>
                <p>Đặt hàng trực tuyến và chúng tôi sẽ giao tận nơi trong thời gian ngắn nhất, giúp bạn tiết kiệm thời gian và thưởng thức món ăn yêu thích.</p>
            </div>
            <div class="service">
                <img src="./images/fastfood.jpg" alt="Dịch vụ menu đa dạng">
                <h3>Menu Đa Dạng</h3>
                <p>Chúng tôi cung cấp nhiều lựa chọn món ăn từ Burger, Pizza, gà rán cho đến các món ăn vặt phù hợp với mọi sở thích của bạn.</p>
            </div>
            <div class="service">
                <img src="./images//chamsockhachhang.jpg" alt="Dịch vụ khách hàng">
                <h3>Chăm Sóc Khách Hàng Tận Tình</h3>
                <p>Đội ngũ nhân viên của chúng tôi luôn sẵn sàng hỗ trợ bạn với các câu hỏi và yêu cầu đặt món, đảm bảo bạn có trải nghiệm tuyệt vời khi sử dụng dịch vụ của chúng tôi.</p>
            </div>
        </div>
    </section>
    <!-- Liên hệ -->
    <section class="contact">
        <div class="container">
            <h2>Liên Hệ Với Chúng Tôi</h2>
            <p>Để biết thêm chi tiết về các món ăn, chương trình khuyến mãi, hoặc đặt hàng, vui lòng liên hệ với chúng tôi <a href="contact.php">tại đây</a> hoặc với các thông tin của cửa hàng:</p>
            <ul>
                <li>Email: fastfood@gmail.com</li>
                <li>Hotline: 070-465-1816</li>
                <li>Địa chỉ: 533 Đường Tùng Thiện Vương, Phường 12, Quận 8, TP. Hồ Chí Minh</li>
            </ul>
            <br>
            <br>
            <footer>
        <div class="container">
            <p>&copy; 2024 Fast Food Store - Tất cả quyền được bảo vệ.</p>
            <p>Trân trọng!</p>
        </div>
    </footer>        
    </section>

  
