<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý đơn hàng</h1>
                <br /><br /><br />
                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <br><br>
                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>Món ăn</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Trạng thái</th>
                        <th>Tên khách hàng</th>
                        <th>Liên hệ</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Hoạt động</th>
                    </tr>
                    <?php 
                        //Lấy tất cả các đơn hàng từ cơ sở dữ liệu
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //Hiển thị đơn hàng mới nhất ở đầu tiên
                        //Thực hiện truy vấn
                        $res = mysqli_query($conn, $sql);
                        //Tạo biến đếm
                        $count = mysqli_num_rows($res);
                        $sn = 1; //Tạo một biến và cho giá trị nó là 1
                        if($count>0)
                        {
                            //Đơn hàng có sẵn
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Nhận tất cả chi tiết đơn hàng
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];                               
                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>
                                        <td>
                                            <?php 
                                                //Đã đặt hàng, đang giao hàng, đã giao, đã hủy
                                                if($status=="Ordered")
                                                {
                                                    echo "<label>Đã đặt hàng!</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color: orange;'>Trong chuyến giao!</label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color: green;'>Đã giao hàng!</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>Đã hủy đơn!</label>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhật đơn hàng</a>
                                            <br>
                                            <br>
                                            <a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $id; ?>" class="btn-danger">Xóa đơn hàng</a>

                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                        else
                        {
                            //Đơn hàng không có sẵn
                            echo "<tr><td colspan='12' class='error'>Đơn hàng không có sẵn!</td></tr>";
                        }
                    ?>
                </table>
    </div>   
</div>
<?php include('partials/footer.php'); ?>