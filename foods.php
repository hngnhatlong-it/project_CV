<?php include('partials-front/menu.php'); ?>
<style>
    /* Thanh search món ăn */
    .food-search {
        background: #f1f1f1;
        padding: 20px 0;
    }

    .food-search .container {
        text-align: center;
    }

    .food-search input[type="search"] {
        padding: 8px;
        width: 60%;
        max-width: 400px;
        margin-right: 5px;
    }

    .food-search input[type="submit"] {
        background: #ff4757;
        color: white;
        border: none;
        padding: 8px 15px;
        cursor: pointer;
    }

    .food-search input[type="submit"]:hover {
        background: #e84118;
    }

    /* Menu */
    .food-menu {
        padding: 40px 0;
    }

    .food-menu h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .food-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
    }

    .food-item {
        flex: 1 1 calc(33.333% - 20px);
        box-sizing: border-box;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fff;
        text-align: center;
        padding: 10px;
        min-height: 350px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .food-item-img {
        width: 100%;
        height: 200px;
        overflow: hidden;
        border-radius: 8px 8px 0 0;
    }

    .food-item-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .food-item-desc {
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
    }

    .food-item-desc h4 {
        font-size: 18px;
        margin: 10px 0;
    }

    .food-item-desc .food-price {
        font-size: 16px;
        font-weight: bold;
        margin: 5px 0;
    }

    .food-item-desc .food-detail {
        font-size: 14px;
        color: #666;
        margin: 10px 0;
        flex-grow: 1;
    }

    .food-item-desc .btn {
        margin-top: auto;
        background-color: #ff4757;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 8px 15px;
        cursor: pointer;
    }

    .food-item-desc .btn:hover {
        background-color: #e84118;
    }
    
    .error {
        color: red;
        font-size: 14px;
        text-align: center;
    }
</style>
<!-- Bắt đầu thanh search -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Hãy nhập món ăn bạn muốn tìm ..." required>
            <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- Bắt đầu menu -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Danh sách món ăn</h2>
        <div class="food-container">
            <?php 
                //Truy vấn món ăn
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count > 0) {
                    while($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-item">
                            <div class="food-item-img">
                                <?php 
                                    if($image_name == "") {
                                        echo "<div class='error'>Hình ảnh không có sẵn!</div>";
                                    } else {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>">
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="food-item-desc">
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
                } else {
                    echo "<div class='error'>Món ăn không tim thấy!</div>";
                }
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
<?php include('partials-front/footer.php'); ?>
