<?php include('partials-front/menu.php'); ?>

    <!-- Thanh tìm kiếm món ăn -->
    <section class="food-search text-center">
        <div class="container">
            <?php 

                //Lây kí tự search
                // $search = $_POST['search'];
                $search = mysqli_real_escape_string($conn, $_POST['search']);           
            ?>
            <h2>Tìm kiếm món ăn của bạn <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
        </div>
    </section>
    <!-- Menu món ăn -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Danh sách món ăn</h2>
            <?php 
                //Truy vấn SQL để lấy thực phẩm dựa trên từ khóa tìm kiếm
                //$search = burger '; bỏ database name;
                // "SELECT * từ tbl_food giống '%burger'%' hoặc mô tả như '%burger%'";
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%'"; //OR description LIKE '%$search%'
                //Thực thi truy vấn
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                //Kiểm tra xem có món ăn nào không
                if($count>0)
                {
                    //Có món ăn
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Nhận thông tin chi tiết
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    //Kiểm tra xem tên hình ảnh có sẵn hay không
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
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Đặt món ngay</a>
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
    </section>
    <?php include('partials-front/footer.php'); ?>