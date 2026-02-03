<?php 
    //Bao gồm file constant.php
    include('../config/constants.php');
    //1. Hủy Session
    session_destroy(); //Unsets $_SESSION['user']
    //2. Chuyển đến trang đăng nhập
    header('location:'.SITEURL.'admin/login.php');

?>