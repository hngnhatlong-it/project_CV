<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>      
        <div class="login">
        <a href="../index.php" style="text-decoration: none; color: #007BFF; font-size: 15px; border: 2px solid transparent; border-radius: 5px; position: fixed 15px 30px" 
        onmouseover="this.style.color='white'; this.style.backgroundColor='#007BFF'; this.style.borderColor='#0056b3'" onmouseout="this.style.color='#007BFF'; this.style.backgroundColor='transparent'; 
        this.style.borderColor='transparent'">Quay lại</a>
            <h1 class="text-center">Đăng nhập</h1>
            <br><br>
            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            <!-- Bắt đầu Form đăng nhập -->
            <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Nhập Username ..."><br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Nhập Password ..."><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>
            <!-- Kết thúc form đăng nhập -->
            <p class="text-center">Created By - Fast Food Store</p>
        </div>
    </body>
</html>
<?php 
    //Kiểm tra xem Nút Gửi đã được Nhấp hay KHÔNG    
    if(isset($_POST['submit']))
    {
        //Quá trình cho đăng nhập
        //1. Lấy dữ liệu từ Form
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);      
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);
        //2. SQL sẽ kiểm tra để xem người dùng quản trị có tên người dùng và mật khẩu có tồn tại hay không
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        //3. Thực thi dữ liệu
        $res = mysqli_query($conn, $sql);
        //4. Tạo biến đếm để xem người dùng quản trị có tồn tại hay không
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            //Người dùng quản trị tồn tại và đăng nhập thành công
            $_SESSION['login'] = "<div class='success'>Đăng nhập thành công!</div>";
            $_SESSION['user'] = $username; //Kiểm tra xem người dùng đã đăng nhập hay chưa và đăng xuất
            //Đi đến trang chủ
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //Người dùng quản trị không tồn tại và đăng nhập thất bạn
            $_SESSION['login'] = "<div class='error text-center'>Username hoặc Password không hợp lệ!</div>";
            //Đi đến trang chủ
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>