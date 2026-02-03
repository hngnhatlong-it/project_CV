<?php
ob_start(); //Bắt đầu bộ đệm đầu ra, dùng cho wamp
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Thêm món ăn</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">       
            <table class="tbl-30">
                <tr>
                    <td>Tiêu đề: </td>
                    <td>
                        <input type="text" name="title" placeholder="Tên món ăn ...">
                    </td>
                </tr>
                <tr>
                    <td>Mô tả: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Mô tả về món ăn ..."></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Giá: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Chọn hình: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Danh mục: </td>
                    <td>
                        <select name="category">
                            <?php 
                                //Tạo Mã PHP để hiển thị các danh mục từ cơ sở dữ liệu
                                //1. Tạo SQL để lấy tất cả các danh mục đang hoạt động từ cơ sở dữ liệu
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";                                
                                //Thực hiện truy vấn
                                $res = mysqli_query($conn, $sql);
                                //Tạo biến đếm để kiểm tra xem chúng ta có danh mục hay không
                                $count = mysqli_num_rows($res);
                                //Nếu biến đếm lớn hơn 0, chúng ta có các danh mục, nếu không thì chúng ta không có danh mục
                                if($count>0)
                                {
                                    //Có danh mục
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //Lấy thông tin về chi tiết danh mục
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //Không có danh mục
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                } 
                            ?>
                        </select>
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
                        <input type="submit" name="submit" value="Thêm món ăn" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>      
        <?php 
            //Kiểm tra xem nút đã được nhấp hay chưa
            if(isset($_POST['submit']))
            {
                //Thêm món ăn vào cơ sở dữ liệu và echo ra để thông báo      
                //1. Lấy dữ liệu từ Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                //Kiểm tra xem nút radio cho tính năng và hoạt động có được chọn hay không
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //Thiết lập giá trị mặc định
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //TThiết lập giá trị mặc định
                }
                //2. Tải ảnh lên nếu đã chọn
                if(isset($_FILES['image']['name']))
                {
                    //Nhận thông tin chi tiết của hình ảnh đã chọn
                    $image_name = $_FILES['image']['name'];

                    //Kiểm tra xem hình ảnh đã được chọn hay chưa và chỉ tải hình ảnh lên nếu đã chọn
                    if($image_name!="")
                    {
                        //Hình ảnh đã được chọn
                        //A. Đổi tên hình ảnh
                        $ext = end(explode('.', $image_name));
                        //Tạo tên mới cho hình ảnh
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; 
                        //B. Tải ảnh lên 
                        //Lấy đường dẫn nguồn và đường dẫn đích
                        //Đường dẫn nguồn là vị trí hiện tại của hình ảnh
                        $src = $_FILES['image']['tmp_name'];
                        //Đường dẫn đích để tải hình ảnh lên
                        $dst = "../images/food/".$image_name;
                        //Cuối cùng tải hình ảnh món ăn lên
                        $upload = move_uploaded_file($src, $dst);
                        //Kiểm tra xem hình ảnh đã được tải lên chưa
                        if($upload==false)
                        {
                            //Không tải được hình ảnh
                            //Chuyển hướng đến trang thêm món ăn với thông báo lỗi
                            $_SESSION['upload'] = "<div class='error'>Lỗi khi tải hình ảnh lên!</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //Kết thúc tiến trình
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = ""; //Đặt giá trị mặc định là trống
                }
                //3. Chèn vào cơ sở dữ liệu
                //Tạo truy vấn SQL để lưu hoặc thêm món ăn
                //Đối với số không cần truyền giá trị bên trong dấu ngoặc kép '' nhưng còn đối với giá trị chuỗi thì bắt buộc phải thêm dấu ngoặc kép ''
                $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";
                //Thực hiện truy vấn
                $res2 = mysqli_query($conn, $sql2);
                //Kiểm tra dữ liệu đã được chèn hay chưa
                //4. Chuyển hướng bằng tin nhắn đến trang quản lý món ăn
                if($res2 == true)
                {
                    //Dữ liệu đã được chèn thành công
                    $_SESSION['add'] = "<div class='success'>Thêm món ăn thành công!</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Không chèn được dữ liệu
                    $_SESSION['add'] = "<div class='error'>Lỗi khi thêm món ăn. Vui lòng kiểm tra lại!</div>";
                    //header('location:'.SITEURL.'admin/add-food.php');
                }             
            }
        ?>
    </div>
</div>
<?php
include('partials/footer.php');
ob_end_flush(); //Kết thúc bộ đệm
?>