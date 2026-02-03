<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Cập nhật đơn hàng</h1>
        <br><br>
        <?php     
            //Kiểm tra ID
            if(isset($_GET['id']))
            {
                //Nhận thông tin về chi tiết đơn hàng
                $id=$_GET['id'];
                //Lấy tất cả các chi tiết khác dựa trên ID này
                //Truy vấn SQL để lấy chi tiết đơn hàng
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                //Thực thi truy vấn
                $res = mysqli_query($conn, $sql);
                //Tạo biến đếm
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //Chi tiết có sẵn
                    $row=mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address= $row['customer_address'];
                }
                else
                {
                    //Chi tiết không có sẵn
                    //Đi đến quản lý đơn hàng
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-order.php');
            }   
        ?>
        <form action="" method="POST">      
            <table class="tbl-30">
                <tr>
                    <td>Tên món ăn</td>
                    <td><b> <?php echo $food; ?> </b></td>
                </tr>
                <tr>
                    <td>Giá</td>
                    <td>
                        <b> $ <?php echo $price; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Số lượng</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Trạng thái</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Đã đặt hàng</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">Trong chuyến giao</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Đã giao hàng</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Đã hủy đơn</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Tên khách hàng: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Liên hệ: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Địa chỉ: </td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Cập nhật đơn hàng" class="btn-secondary">
                    </td>
                </tr>
            </table>     
        </form>
        <?php 
            //Kiểm tra xem nút cập nhật đã được nhấp hay chưa
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Lấy tất cả các giá trị từ Form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];
                //Cập nhật giá trị
                $sql2 = "UPDATE tbl_order SET 
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id=$id
                ";
                //Thực thi truy vấn
                $res2 = mysqli_query($conn, $sql2);
                //Kiểm tra xem có cập nhật hay không
                //Và chuyển hướng đến quản lý đơn hàng
                if($res2==true)
                {
                    //Cập nhật thành công
                    $_SESSION['update'] = "<div class='success'>Cập nhật đơn hàng thành công!</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    //Cập nhật thất bại
                    $_SESSION['update'] = "<div class='error'>Lỗi khi cập nhật đơn hàng!</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>
