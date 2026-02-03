<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Thêm danh mục</h1>
        <br><br>
        <?php       
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }       
        ?>
        <br><br>
        <!-- Bắt đầu form thêm danh mục -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Tiêu đề: </td>
                    <td>
                        <input type="text" name="title" placeholder="Tên danh mục ...">
                    </td>
                </tr>
                <tr>
                    <td>Chọn Hình: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Yêu thích: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr>
                <tr>
                    <td>Hoạt động: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Thêm danh mục" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Kết thúc form thêm danh mục -->
        <?php 
        //Kiểm tra xem nút Gửi đã được nhấp hay chưa
            if(isset($_POST['submit']))
            {
                //xuất ra echo "đã nhấp"

                //1. Lấy giá trị từ biểu mẫu danh mục
                $title = $_POST['title'];
                //Đối với đầu vào Radio thì cần kiểm tra xem nút có được chọn hay không
                if(isset($_POST['featured']))
                {
                    //Lấy giá trị từ form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Đặt giá trị mặc định
                    $featured = "No";
                }
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }
                //Kiểm tra xem hình ảnh có được chọn hay không và đặt giá trị cho tên hình ảnh theo đó
                //print_r($_FILES['image']);
                if(isset($_FILES['image']['name']))
                {
                    //Tải ảnh lên
                    //Để tải ảnh lên, chúng ta cần tên ảnh, đường dẫn nguồn và đường dẫn đích
                    $image_name = $_FILES['image']['name'];    
                    //Chỉ tải hình ảnh lên nếu hình ảnh được chọn
                    if($image_name != "")
                    {
                        //Tự động đổi tên hình ảnh
                        $ext = end(explode('.', $image_name));
                        //Đổi tên ảnh
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; 
  
                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Cuối cùng tải ảnh lên
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // //Kiểm tra xem hình ảnh đã được tải lên hay chưa và nếu hình ảnh chưa được tải lên thì sẽ dừng quá trình và chuyển hướng với thông báo lỗi
                        if($upload==false)
                        {
                            //Đặt tin nhắn
                            $_SESSION['upload'] = "<div class='error'>Lỗi khi tải hình ảnh!</div>";
                            //Chuyển hướng đến thêm trang danh mục
                            header('location:'.SITEURL.'admin/add-category.php');
                            //Dừng quá trình
                            die();
                        }
                    }
                }
                else
                {
                    //Không tải hình ảnh lên và đặt giá trị image_name thành trống
                    $image_name="";
                }
                //2. Tạo truy vấn SQL để chèn danh mục vào cơ sở dữ liệu
                $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";
                //3. Thực hiện truy vấn và lưu vào cơ sở dữ liệu
                $res = mysqli_query($conn, $sql);
                //4. Kiểm tra xem truy vấn có được thực hiện hay không và dữ liệu có được thêm vào hay không
                if($res==true)
                {
                    //Truy vấn được thực hiện và danh mục được thêm vào
                    $_SESSION['add'] = "<div class='success'>Thêm danh mục thành công!</div>";
                    //Chuyển hướng đến trang quản lý danh mục
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Lỗi khi thêm danh mục
                    $_SESSION['add'] = "<div class='error'>Lỗi khi thêm danh mục. Vui lòng kiểm tra lại!</div>";
                    //Chuyển hướng đến trang quản lý danh mục
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>