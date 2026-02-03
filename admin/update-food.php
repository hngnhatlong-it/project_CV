<?php
ob_start(); //Bắt đầu bộ đệm đầu ra, dùng cho wamp
include('partials/menu.php');
?>
<?php 
    //Kiểm tra xem ID đã được thiết lập hay chưa    
    if(isset($_GET['id']))
    {
        //Nhận tất cả các chi tiết
        $id = $_GET['id'];
        //Truy vấn SQL để lấy món ăn đã chọn
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
        //Xử lý truy vấn
        $res2 = mysqli_query($conn, $sql2);
        //Nhận giá trị dựa trên truy vấn được thực hiện
        $row2 = mysqli_fetch_assoc($res2);
        //Nhận giá trị riêng lẻ của món ăn đã chọn
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else
    {
        //Chuyển hướng đến quản lý món ăn
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Cập nhật món ăn</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">      
        <table class="tbl-30">
            <tr>
                <td>Tiêu đề: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td>Mô tả: </td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Giá: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>
            <tr>
                <td>Hình ảnh: </td>
                <td>
                    <?php 
                        if($current_image == "")
                        {
                            //Hình ảnh không có sẵn
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            //Hình ảnh có sẵn
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Chọn hình ảnh mới: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Danh mục: </td>
                <td>
                    <select name="category">
                        <?php 
                            //Truy vấn để có được các danh mục hoạt động
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //Thực thi truy vấn
                            $res = mysqli_query($conn, $sql);
                            //Tạo biến đếm
                            $count = mysqli_num_rows($res);
                            //Kiểm tra xem có danh mục hay không
                            if($count>0)
                            {
                                //Danh mục có sẵn
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    
                                    //echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                //Danh mục không có sẵn
                                echo "<option value='0'>Danh mục không có sẵn!</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Yêu thích: </td>
                <td>
                    <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 
                    <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No"> No 
                </td>
            </tr>
            <tr>
                <td>Hoạt động: </td>
                <td>
                    <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 
                    <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No 
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                    <input type="submit" name="submit" value="Cập nhật món ăn" class="btn-secondary">
                </td>
            </tr>       
        </table>      
        </form>
        <?php       
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";
                //1. Nhận tất cả các chi tiết từ biểu mẫu
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                //2. Tải lên hình ảnh nếu được chọn
                //Kiểm tra xem nút tải lên đã được nhấp hay chưa
                if(isset($_FILES['image']['name']))
                {
                    //Đã nhấp vào nút Tải lên
                    $image_name = $_FILES['image']['name']; //Tên hình mới
                    //Kiểm tra xem tập tin có sẵn hay không
                    if($image_name!="")
                    {
                        //Hình ảnh có sẵn
                        //A. Tải lên hình ảnh mới
                        //Đổi tên hình ảnh
                        $ext = end(explode('.', $image_name)); //Nhận phần mở rộng của hình ảnh
                        $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext; //Đổi tên hình ảnh
                        //Lấy đường dẫn nguồn và đường dẫn đích
                        $src_path = $_FILES['image']['tmp_name']; //Đường dẫn nguồn
                        $dest_path = "../images/food/".$image_name; //Đường dần đích
                        //Tải ảnh lên
                        $upload = move_uploaded_file($src_path, $dest_path);
                        //Kiểm tra xem hình ảnh đã được tải lên hay chưa
                        if($upload==false)
                        {
                            //Tải lên thất bại
                            $_SESSION['upload'] = "<div class='error'>Tải ảnh mới lên thất bại!</div>";
                            //Chuyển hướng đến quản lý món ăn
                            header('location:'.SITEURL.'admin/manage-food.php');
                            //Kết thúc tiến trình
                            die();
                        }
                        //3. Xóa hình ảnh nếu hình ảnh mới được tải lên và hình ảnh hiện tại đã tồn tại
                        //B. Xóa hình ảnh hiện tại nếu có
                        if($current_image!="")
                        {
                            //Hình ảnh hiện tại có sẵn
                            //Xóa hình ảnh
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);
                            //Kiểm tra xem hình ảnh đã được xóa hay chưa
                            if($remove==false)
                            {
                                //Không thể xóa hình ảnh hiện tại
                                $_SESSION['remove-failed'] = "<div class='error'>Không thể xóa hình ảnh hiện tại.</div>";
                                //Chuyển hướng để quản lý món ăn
                                header('location:'.SITEURL.'admin/manage-food.php');
                                //Kết thúc tiến trình
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image; //Hình ảnh mặc định khi hình ảnh không được chọn
                    }
                }
                else
                {
                    $image_name = $current_image; //Hình ảnh mặc định khi nút không được nhấp
                }
                //4. Cập nhật món ăn trong cơ sở dữ liệu
                $sql3 = "UPDATE tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";
                //Thực thi truy vấn SQL
                $res3 = mysqli_query($conn, $sql3);
                //Kiểm tra xem truy vấn có được thực hiện hay không
                if($res3==true)
                {
                    //Đã thực hiện truy vấn và cập nhật món ăn
                    $_SESSION['update'] = "<div class='success'>Cập nhật món ăn thành công!</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Lỗi khi cập nhật món ăn
                    $_SESSION['update'] = "<div class='error'>Lỗi khi cập nhật món ăn!</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }    
            }       
        ?>
    </div>
</div>
<?php
include('partials/footer.php');
ob_end_flush(); //Kết thúc bộ đệm
?>