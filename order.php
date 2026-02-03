<?php
ob_start(); //Bắt đầu bộ đệm đầu ra, dùng cho wamp
include('partials-front/menu.php');
?>
    <?php 
        //Kiểm tra xem ID món ăn đã được thiết lập hay chưa
        if(isset($_GET['food_id']))
        {
            //Nhận ID thực phẩm và thông tin chi tiết về món ăn đã chọn
            $food_id = $_GET['food_id'];

            //Nhận thông tin chi tiết về món ăn đã chọn
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            //Thực thi truy vấn
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            //Kiểm tra xem dữ liệu có sẵn hay không
            if($count==1)
            {
                //Lấy data từ cơ sở dữ liệu
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                //Món ăn không có sẵn và di chuyển về trang index
                header('location:'.SITEURL);
            }
        }
        else
        {
            header('location:'.SITEURL);
        }
    ?>
    <!-- Thanh tìm kiếm món ăn -->
    <section class="food-search">
        <div class="container">           
            <h2 class="text-center text-white">Hãy điền thông tin để xác nhận đơn hàng của bạn.</h2>
            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Lựa chọn món ăn</legend>
                    <div class="food-menu-img">
                        <?php 
                            //Kiểm tra xem hình ảnh có sẵn hay không
                            if($image_name=="")
                            {
                                //Hình ảnh không có sẵn
                                echo "<div class='error'>Hình ảnh không có sẵn!</div>";
                            }
                            else
                            {
                                //Hình ảnh có sẵn
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }                       
                        ?>                       
                    </div>   
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>                       
                    </div>
                </fieldset>              
                <fieldset>
                    <legend>Chi tiết giao hàng</legend>
                    <div class="order-label">Họ tên</div>
                    <input type="text" name="full-name" placeholder="Your name" class="input-responsive" required>
                    <div class="order-label">Số điện thoại</div>
                    <input type="tel" name="contact" placeholder="Your phone number" class="input-responsive" required>
                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Your email" class="input-responsive" required>
                    <div class="order-label">Địa chỉ</div>
                    <textarea name="address" rows="10" placeholder="Your Address" class="input-responsive" required></textarea>
                    <input type="submit" name="submit" value="Xác nhận đặt hàng" class="btn btn-primary">
                    <a href="http://localhost:8080/WebSite_FastFood/" style="color:black; border: 2px solid #4CAF50; padding: 4px; border-radius: 8px;  background-color: green">Quay lại</a>
                </fieldset>
            </form>
            <?php 
                //Kiểm tra xem nút gửi đã được nhấp hay chưa
                if(isset($_POST['submit']))
                {
                    //Lấy các chi tiết
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty; // tổng = price x qty 
                    $order_date = date("Y-m-d h:i:sa"); //Order DAte
                    $status = "Ordered";
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];
                    //Tạo cơ sở dữ liệu để lưu đơn hàng vào
                    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";
                    //echo $sql2; die();
                    //Thực thi truy vấn
                    $res2 = mysqli_query($conn, $sql2);
                    //Kiểm tra xem truy vấn có được thực hiện thành công hay không
                    if($res2==true)
                    {
                        //Truy vấn được thực hiện và đã được lưu
                        $_SESSION['order'] = "<div class='success text-center'>Đã đặt món ăn thành công!</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //Lỗi
                        $_SESSION['order'] = "<div class='error text-center'>Lỗi khi đặt món ăn!</div>";
                        header('location:'.SITEURL);
                    }
                }
            ?>
        </div>
    </section> 
<?php
include('partials-front/footer.php');
ob_end_flush(); //Kết thúc bộ đệm
?>