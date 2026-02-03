<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý món ăn</h1>
        <br /><br />
                <!-- Nút thêm món ăn -->
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Thêm món ăn</a>
                <br /><br /><br />
                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }               
                ?>
                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Giá</th>
                        <th>Hình ảnh</th>
                        <th>Yêu thích</th>
                        <th>Hoạt động</th>
                        <th>Trạng thái</th>
                    </tr>
                    <?php 
                        //Tạo truy vấn SQL để lấy tất cả món ăn
                        $sql = "SELECT * FROM tbl_food";
                        //Thực hiện truy vấn
                        $res = mysqli_query($conn, $sql);
                        //Tạo biến đếm để xem có thức ăn hay không
                        $count = mysqli_num_rows($res);
                        //Tạo 1 biến và cho giá trị của nó là 1
                        $sn=1;
                        if($count>0)
                        {
                            //Có món ăn trong cơ sở dữ liệu
                            //Lấy món ăn từ cơ sở dữ liệu và hiển thị
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Lấy giá trị từ các cột riêng lẻ
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $title; ?></td>
                                    <td>$<?php echo $price; ?></td>
                                    <td>
                                        <?php  
                                            //Kiểm tra xem có hình ảnh hay không
                                            if($image_name=="")
                                            {
                                                //Nếu không có hình ảnh thì xuất ra thông báo
                                                echo "<div class='error'>Chưa thêm hình ảnh!</div>";
                                            }
                                            else
                                            {
                                                //Hiển thị hình ảnh nếu có
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhật</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Xóa</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            //Món ăn chưa được thêm vào cơ sở dữ liệu
                            echo "<tr> <td colspan='7' class='error'>Thức ăn chưa được thêm vào!</td> </tr>";
                        }
                    ?>                   
                </table>
    </div>   
</div>
<?php include('partials/footer.php'); ?>