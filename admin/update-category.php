<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Cập nhật danh mục</h1>
        <br><br>
        <?php     
            //Kiểm tra xem ID đã được thiết lập hay chưa
            if(isset($_GET['id']))
            {
                //Lấy ID và tất cả các chi tiết khác
                $id = $_GET['id'];
                //Tạo truy vấn SQL để lấy tất cả các chi tiết khác
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                //Thực hiện truy vấn
                $res = mysqli_query($conn, $sql);
                //tạo một biến đếm các hàng để kiểm tra xem ID có hợp lệ hay không
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //Nhận tất cả dữ liệu
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //Chuyển hướng đến quản lý danh mục
                    $_SESSION['no-category-found'] = "<div class='error'>Danh mục không tìm thấy!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-category.php');
            }    
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Tiêu đề: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Hình ảnh hiện tại: </td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                //Hiển thị hình ảnh
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Hiển thị thông báo
                                echo "<div class='error'>Hình ảnh chưa được thêm vào!</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Hình ảnh mới: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Yêu thích: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>
                <tr>
                    <td>Hoạt động: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 

                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Cập nhật danh mục" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php      
            if(isset($_POST['submit']))
            {
                //1. Lấy tất cả các giá trị từ biểu mẫu
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                //2. Cập nhật hình ảnh mới nếu được chọn
                //Kiểm tra xem hình ảnh đã được chọn hay chưa
                if(isset($_FILES['image']['name']))
                {
                    //Lấy thông tin chi tiết hình ảnh                    
                    $image_name = $_FILES['image']['name'];
                    //Kiểm tra xem hình ảnh có sẵn hay không
                    if($image_name != "")
                    {
                        //Hình ảnh có sẵn
                        //A. Tải lên hình ảnh mới
                        //Tự động sửa ảnh
                        $ext = end(explode('.', $image_name));
                        //Đổi tên ảnh
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; 
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;
                        //Sau đó đẩy ảnh lên
                        $upload = move_uploaded_file($source_path, $destination_path);
                        //Kiểm tra xem hình ảnh đã được tải lên hay chưa
                        //Và nếu hình ảnh chưa được tải lên thì chúng tôi sẽ dừng quá trình và chuyển hướng với thông báo lỗi
                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Không tải được hình ảnh lên!</div>";
                        //Chuyển hướng đến trang Thêm danh mục                           
                        header('location:'.SITEURL.'admin/manage-category.php');
                            //Dừng tiến trình
                            die();
                        }
                        //B. Xóa hình ảnh hiện tại nếu có
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
                            //Kiểm tra xem hình ảnh đã được xóa hay chưa
                            //Nếu không xóa được thì hiển thị thông báo và dừng các tiến trình
                            if($remove==false)
                            {
                                //Lỗi khi xóa ảnh
                                $_SESSION['failed-remove'] = "<div class='error'>Không thể xóa hình ảnh hiện tại!</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die(); //Dừng tiến trình
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }
                //3. Cập nhật cơ sở dữ liệu
                $sql2 = "UPDATE tbl_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";
                //Thực hiện truy vấn
                $res2 = mysqli_query($conn, $sql2);
                //4. Chuyển hướng đến quản lý danh mục
                if($res2==true)
                {
                    //Cập nhật quản lý danh mục
                    $_SESSION['update'] = "<div class='success'>Cập nhật danh mục thành công!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Lỗi cập nhật danh mục
                    $_SESSION['update'] = "<div class='error'>Cập nhật danh mục bị lỗi. Vui lòng kiểm tra lại!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }      
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>