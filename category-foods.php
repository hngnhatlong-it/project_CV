     <?php include('partials-front/menu.php'); ?>
    <?php 
        //Kiểm tra xem ID đã được truyền hay chưa        
        if(isset($_GET['category_id']))
        {
            //ID danh mục được thiết lập và lấy ID
            $category_id = $_GET['category_id'];
            //Lấy tiêu đề danh mục dựa trên ID danh mục 
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

            //Thực hiện truy vấn
            $res = mysqli_query($conn, $sql);

            //Lấy giá trị từ cơ sở dữ liệu
            $row = mysqli_fetch_assoc($res);
            $category_title = $row['title'];
        }
        else
        {
            //Danh mục chưa được lấy và di chuyển về lại trang Index
            header('location:'.SITEURL);
        }
    ?>
    <!-- Thanh tìm kiếm thức ăn -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Các món ăn thuộc danh mục: <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- Menu món ăn -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Danh sách món ăn</h2>
            <?php         
                //Tạo truy vấn SQL để lấy món ăn dựa trên danh mục đã chọn
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
                //Truy vấn
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                //Kiểm tra xem có món ăn hay không
                if($count2>0)
                {
                    //Món ăn có sẵn
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>                        
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    if($image_name=="")
                                    {
                                        //Hình ảnh không tồn tại
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
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Đặt hàng ngay</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    //Món ăn không tồn tại
                    echo "<div class='error'>Món ăn không tồn tại!</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <?php include('partials-front/footer.php'); ?>