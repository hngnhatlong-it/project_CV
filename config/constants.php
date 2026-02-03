<?php 
    //Bắt đầu session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    //Tự động nhận diện môi trường để tránh lỗi kết nối
    //Kiểm tra xem đang chạy trên Local hay trên Hosting
    if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1') {
        //Cấu hình localhost
        define('SITEURL', 'http://localhost:8080/WebSite_FastFood/'); 
        define('LOCALHOST', 'localhost'); 
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'food-order');
    } else {
        //Cấu hình infinity
        define('SITEURL', 'http://nhatlong.free.nf/DoAn/'); 
        define('LOCALHOST', 'sql306.infinityfree.com'); 
        define('DB_USERNAME', 'if0_40200599');
        define('DB_PASSWORD', 'nhatlong2109'); 
        define('DB_NAME', 'if0_40200599_food_order'); 
    }

    //Thực hiện kết nối
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    //Kiểm tra kết nối
    if (!$conn) {
        die("Lỗi kết nối Database. Vui lòng kiểm tra cấu hình tại constants.php");
    }
    
    //Thiết lập font chữ Tiếng Việt
    mysqli_set_charset($conn, "utf8mb4");
?>