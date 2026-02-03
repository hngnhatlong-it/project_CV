    <?php include('partials-front/menu.php'); ?>
    <!-- Tìm kiếm món ăn -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="TÌm kiếm món ăn ..." required>
                <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-primary">
            </form>
  
        </div>
    </section>
    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>
    <!-- Phần danh mục -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Các món ăn</h2>
            <?php 
                //Tạo truy vấn SQL để hiển thị các danh mục từ cơ sở dữ liệu
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //Thực thi truy vấn
                $res = mysqli_query($conn, $sql);
                //Đếm số hàng để kiểm tra xem danh mục có sẵn hay không
                $count = mysqli_num_rows($res);
                if($count>0)
                {
                    //Danh mục có sẵn
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Lấy các giá trị như id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>                      
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //Kiểm tra xem hình ảnh có sẵn hay khôngt
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Hình ảnh không có sẵn!</div>";
                                    }
                                    else
                                    {
                                        //Hình ảnh có sẵn
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>
                        <?php
                    }
                }
                else
                {
                    //Danh mục không có sẵn
                    echo "<div class='error'>Danh mục chưa được thêm vào!</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Menu món ăn -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Danh sách món ăn</h2>
            <?php            
            //Lấy món ăn từ cơ sở dữ liệu đang hoạt động
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            //Thực thi truy vấn
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            //Kiểm tra xem có thức ăn hay không
            if($count2>0)
            {
                //Món ăn có sẵn
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Lấy tất cả giá trị
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="food-menu-box">
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
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Đặt món</a>
                        </div>
                    </div>
                    <?php
                }
            }
            else
            {
                //Món ăn không có sẵn
                echo "<div class='error'>Món ăn không có sẵn!</div>";
            }       
            ?>
            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="foods.php">Xem tất cả món ăn</a>
        </p>
    </section>
    <?php include('partials-front/footer.php'); ?>