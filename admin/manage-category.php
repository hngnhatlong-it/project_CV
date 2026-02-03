<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý danh mục</h1>
        <br /><br />
        <?php       
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }      
        ?>
        <br><br>
                <!-- Nút thêm danh mục -->
                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Thêm danh mục</a>
                <br /><br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Hình ảnh</th>
                        <th>Yêu thích</th>
                        <th>Hoạt động</th>
                        <th>Trạng thái</th>
                    </tr>
                    <?php 
                        //Truy vấn để lấy tất cả các loại từ cơ sở dữ liệu
                        $sql = "SELECT * FROM tbl_category";
                        //Thực hiện truy vấn
                        $res = mysqli_query($conn, $sql);
                        //Tạo biến đếm
                        $count = mysqli_num_rows($res);
                        //Tạo biến và gán giá trị là 1
                        $sn=1;
                        //Kiểm tra xem chúng ta có dữ liệu trong cơ sở dữ liệu hay không
                        if($count>0)
                        {
                            //Có dữ liệu trong cơ sở dữ liệu
                            //Lấy dữ liệu và hiển thị
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $title; ?></td>
                                        <td>
                                            <?php  
                                                //Kiểm tra xem tên hình ảnh có sẵn hay không
                                                if($image_name!="")
                                                {
                                                    //Hiển thị hình ảnh
                                                    ?>                              
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" >                                                  
                                                    <?php
                                                }
                                                else
                                                {
                                                    //Hiển thị tin nhắn
                                                    echo "<div class='error'>Chưa thêm hình ảnh!</div>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhật</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Xóa</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                        else
                        {
                            //Không có data
                            //Hiển thị tin nhắn thông báo
                            ?>
                            <tr>
                                <td colspan="6"><div class="error">Không thêm được danh mục. Vui lòng kiểm tra lại!</div></td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
    </div>   
</div>
<?php include('partials/footer.php'); ?>