<?php include('partials/menu.php'); ?>
        <!-- Bắt đầu nội dung chính -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Xin chào bạn, chúc bạn một ngày bán hàng hiệu quả.</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>
                <div class="col-4 text-center">
                    <?php 
                        //Truy vấn SQL
                        $sql = "SELECT * FROM tbl_category";
                        //Thực hiện truy vấn
                        $res = mysqli_query($conn, $sql);
                        //Tạo biến đếm
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br />
                    Các Danh mục
                </div>
                <div class="col-4 text-center">
                    <?php 
                        //Truy vấn SQL
                        $sql2 = "SELECT * FROM tbl_food";
                        //Thực hiện truy vấn
                        $res2 = mysqli_query($conn, $sql2);
                        //Tạo biến đếm
                        $count2 = mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2; ?></h1>
                    <br />
                    Thức ăn
                </div>
                <div class="col-4 text-center">
                    <?php 
                        //Truy vấn SQL
                        $sql3 = "SELECT * FROM tbl_order";
                        //Thực hiện truy vấn
                        $res3 = mysqli_query($conn, $sql3);
                        //Tạo biến đếm
                        $count3 = mysqli_num_rows($res3);
                    ?>
                    <h1><?php echo $count3; ?></h1>
                    <br />
                    Tổng đơn hàng
                </div>
                <div class="col-4 text-center">               
                    <?php 
                        //Tạo truy vấn SQL để lấy tổng doanh thu được tạo ra 
                        //Hàm tổng hợp trong SQL
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                        //Thực hiện truy vấn
                        $res4 = mysqli_query($conn, $sql4);
                        //Lấy giá trị
                        $row4 = mysqli_fetch_assoc($res4);                      
                        //Lấy tổng doanh thu
                        $total_revenue = $row4['Total'];
                    ?>
                    <h1>$<?php echo $total_revenue; ?></h1>
                    <br />
                    Doanh thu
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Kết thúc nội dung chính -->
<?php include('partials/footer.php') ?>