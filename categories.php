<?php include('partials-front/menu.php'); ?>
    <!-- Bắt đầu phần danh mục -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Khám phá danh mục món ăn</h2>
            <?php 
                //Hiển thị tất cả các danh mục có trong trang web
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                //Thực hiện truy vấn
                $res = mysqli_query($conn, $sql);
                //Biến đếm
                $count = mysqli_num_rows($res);
                //Kiểm tra xem danh mục có sẵn hay không
                if($count>0)
                {
                    //Danh mục có sẵn
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Lấy giá trị
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($image_name=="")
                                    {
                                        //Hình ảnh không có sẵn
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
                    //Danh mục không tồn tại
                    echo "<div class='error'>Danh mục chưa tồn tại!</div>";
                }           
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Kết thúc -->
    <?php include('partials-front/footer.php'); ?>