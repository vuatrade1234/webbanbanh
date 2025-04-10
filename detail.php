

<?php
	include 'inc/header.php';
?>
<?php
	 if(!isset($_GET['proid'] ) || $_GET['proid']==NULL){
        echo "<script>window.location = '404.php'</script>";
    }else{
        $id = $_GET['proid'];
    }
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$quantity = $_POST['quantity'];
        $customer_id = Session::get('customer_id');
		$addtocart = $ct->add_to_cart($quantity, $id, $customer_id);
	}
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])){
        $productid = $_POST['productid'];
        $customer_id = Session::get('customer_id');
        $insertWishlist = $product->insertWishList($productid, $customer_id);
    }
    if(isset($_POST['binhluan_submit'])){
        $insert_binhluan = $cs->insert_binhluan( $customer_id, $id );
    }
?>
<?php
    if(isset($_GET['blid'])){
		$blid = $_GET['blid'];
		$delbl = $cs->del_binhluan($blid);
        if($delbl){
            // Chuyển hướng người dùng về trang hiện tại
            header("Location: detail.php?proid=$id");
            exit;
        }

	}
?>
<style>
body {
    font-size: 16px;
}

h2 {
    color: #000;
    font-size: 24px;
}

.desc {
    font-size: 18px;
}

.product-desc {
    font-size: 18px;
    width: 100%;
    margin-left:20%;
}

.rightsidebar span_3_of_1 ul li a {
    font-size: 16px;
}

.section.group {
    display: flex;
    flex-wrap: wrap;
}

.grid_1_of_4.images_1_of_4 {
    display: flex;
    flex-direction: column;
}

.grid_1_of_4.images_1_of_4 img {
    flex-grow: 1;
    object-fit: cover;
}
.grid_1_of_4.images_1_of_4 img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.row {
    width: 100%;
    display: flex;
    /* justify-content: center;
    align-items: center; */
}
.col-md-6 {
    margin-top: 5%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
/* binh luan */
.form-control {
    height: calc(1.5em + 0.75rem + 8px);
    font-size: 1.5rem;
}
.btn-primary {
    font-size: 15px;
}
.container {
    max-width: 87%; 
}
.product-desc p {
    font-size: 0.9em;
    color: #403838;
}
.mt-0, .my-0 {
    font-size: 0.9em;
}
.product-comment h2, .product-tags h2 {
    padding: 8px 20px;
    border-bottom: 1px solid #86121c;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    -o-border-radius: 5px;
    font-family: 'Monda', sans-serif;
    font-size: 1.2em;
    color: #66b015;
    text-transform: uppercase;
    text-shadow: 0 1px 5px rgba(34, 34, 34, 0.17);
}
/* CSS cho ảnh nhỏ */
.grid img.small-image {
        width: 15%; /* Điều chỉnh kích thước của ảnh nhỏ */
        display: block;
        margin-top: 20px; /* Khoảng cách từ trên xuống */
        margin-left: auto; /* Canh chỉnh ảnh nhỏ giữa */
        margin-right: auto;
    }

    .grid p.small-image-label {
        text-align: center; /* Canh chỉnh chú thích của ảnh nhỏ */
    }
    .sale{
    margin-left: 8px;
        background-color: yellow;
}

</style>
<div class="main">
    <div class="content">
    <div class="section group">
    <?php 
        $get_product_details = $product->get_details($id);
        if($get_product_details) {
            while( $result_details = $get_product_details->fetch_assoc() ) {
    ?>
    <!-- Hàng 1 -->
    <div class="row">
        <!-- Cột 1: Ảnh -->
        <div class="col-md-6">
            <div class="grid images_3_of_3">
                <!-- Khung hiển thị ảnh lớn -->
                <img id="main-image" style="width:50%; float:right" src="admin/uploads/<?php echo $result_details['hinhanh'];?>" alt="" />

                <!-- Danh sách ảnh nhỏ -->
                <?php 
                    $get_images_product= $product->show_inages_product($id);
                    if($get_images_product) {
                        while( $result_images = $get_images_product->fetch_assoc() ) {
                ?>
                <div class="small-images">
                    <img class="small-image" src="admin/uploads/<?php echo $result_images['ct_hinhanh'];?>" alt="" />
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
        <!-- Cột 2: Mô tả và giỏ hàng -->
        <div class="col-md-6">
            <div class="desc span_3_of_3">
                <h2><?php echo $result_details['TenSP'];?></h2>
                           
                <div class="price">
                    <?php
                        $originalPrice = $result_details['Gia']; // Giá gốc
                        $salePercentage = $result_details['GiaSale']; // Phần trăm giảm giá

                        if ($salePercentage > 0) {
                        $salePrice = $originalPrice - ($originalPrice * ($salePercentage / 100));

                        echo '<div class="price-container">';
                        echo 'Giá gốc: <span style="text-decoration: line-through; color: gray;">' . $fm->format_currency($result_details['Gia']) . ' VND</span>';
                        echo '<span class="sale">' . $salePercentage . '%</span>';

                            
                            echo '<br>Giá sale: <span>' . $fm->format_currency($salePrice) . ' VND</span>';
                            
                        } else {
                            echo 'Giá: <span>'. $fm->format_currency($originalPrice) . ' VND</span>';
                        }
                    ?>
                    <p>Danh mục: <span><?php echo $result_details['TenDM'] ?></span></p>
                    <p>Thương hiệu: <span><?php echo $result_details['TenTH']?></span></p>
                </div>
                        <div class="add-cart">
                            <form action="" method="post">
                                <input type="number" class="buyfield" name="quantity" value="1" min="1" max="<?php echo $result_details['SoLuong']?>"/>
                                <input type="submit" style = "margin-bottom: 2%;" class="buysubmit" name="submit" value="Mua hàng"/>

                            </form>
                            <?php
                                if(isset($addtocart)){
                                    echo $addtocart;
                                }
                            ?>
                            
                                <br>
                            <form action="" method="post">
                                <input type="hidden" class="buyfield" name="productid" value="<?php echo $result_details['MaSP'] ?>"/>

                                <?php
                                    $login_check = Session::get('customer_login');
                                    if($login_check){
                                        echo '<input type="submit" style="margin-bottom: 2%;" class="buysubmit" name="wishlist" value="Lưu sản phẩm yêu thích" <i class="fas fa-heart"></i> </input> ';
                                        
                                    }
                                ?>
                               
                            </form>
                            <?php
                                    if(isset($insertWishlist)){
                                        echo $insertWishlist;
                                    }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hàng 2 -->
            <div class="row">
                <!-- Cột 1: Chi tiết sản phẩm -->
                <div class="col-md-6">
					
                    <div class="product-desc">
                        <h2>Chi tiết sản phẩm</h2>

							<p>Ngày sản xuất: <span><?php echo $result_details['NgaySX']?></span></p>
							<p>Hạn sử dụng: <span><?php echo $result_details['HanSD']?></span></p>
							<p>Khối lượng: <span><?php echo $result_details['KhoiLuong']?></span></p>
							<p>Loại sản phẩm: <span><?php echo $result_details['TenDM']?></span></p>
							<p>Thương hiệu: <span><?php echo $result_details['TenTH']?></span></p>
							<p>Xuất xứ: <span><?php echo $result_details['XuatXu']?></span></p>
							<p>Số lượng: <span> <?php echo $result_details['SoLuong']?> </span></p>  
							<p><?php echo $result_details['MoTa']?></p>   

                    </div>
                </div>
                 <!-- Cột 3: Xem sản phẩm -->
                 <div class="col-md-6">
                    <div class="rightsidebar span_3_of_3">
                        <h2>Xem sản phẩm</h2>
                        <ul class="list-group">
                            <?php
                                $getall_category = $cat ->show_category_fontend();
                                if($getall_category){
                                    while($result = $getall_category->fetch_assoc()){
                            ?>
                            <li class="list-group-item"><a href="productbycat.php?catid=<?php echo $result['MaDM'] ?>"><?php echo $result['TenDM'] ?></a></li>
                            <?php
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <?php
                    }
                }
            ?>
        </div>

        <?php
$login_check = Session::get('customer_login');

if ($login_check) {
    $customer_id = Session::get('customer_id');

    echo '
    <div class="row">
        <div class="col-md-6">
            <div class="product-comment">
                <h2>Bình Luận</h2>
            </div>
            <ul>';

    if (Session::get('customer_id')) {
        $customer_id = Session::get('customer_id');
        $get_star = $product->get_star($id, $customer_id);
        $tongsao = 0;
        $trungbinhsao = 0;
        $solan = 0;

        if ($get_star) {
            while ($result_star = $get_star->fetch_assoc()) {
                $tongsao += $result_star['sosao'];
                $solan += 1;
                $trungbinhsao = $tongsao / $solan;
            }
        }
    }

    $check_order_status = $product->get_ktdadathang($id, $customer_id);

    if ($check_order_status !== false && $check_order_status->num_rows > 0) {
        $get_product_details_2 = $product->get_details($id);

        if ($get_product_details_2) {
            while ($result_details = $get_product_details_2->fetch_assoc()) {
                echo '<li class="rating"';
                for ($count = 1; $count <= 5; $count++) {
                    if ($count <= round($trungbinhsao)) {
                        $color = '#ffcc00';
                    } else {
                        $color = '#ccc';
                    }

                    echo '<span id="' . $result_details['MaSP'] . '-' . $count . '" class="star" style="cursor:pointer; font-size:30px; color: ' . $color . '" data-product_id="' . $result_details['MaSP'] . '" data-customer_id="' . Session::get('customer_id') . '" data-index="' . $count . '">&#9733;</span>';
                }

                echo '</li>';
                echo '<p>Đã đánh giá: ' . round($trungbinhsao) . '/5</p>';
                echo '</ul>
                <div class="container">';
            }
        }
    } else {
        echo '<li class="rating">';
        for ($count = 1; $count <= 5; $count++) {
            $color = '#ccc'; // Màu xám cho sao
            echo '<span class="star-disabled" style="font-size:30px; color: ' . $color . '" data-index="' . $count . '">&#9733;</span>';
        }
        echo '</li>';

        echo '</ul>
        <div class="container">';
    }

    if (isset($insert_binhluan)) {
        echo $insert_binhluan;
    }

    echo '
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Họ tên:</label>';

    $getcustomer = $cs->show_customer_detail($customer_id);

    if ($getcustomer) {
        while ($result_customer = $getcustomer->fetch_assoc()) {
            echo '<input type="text" class="form-control" id="name" value="' . $result_customer['HoTen'] . '" placeholder="Nhập tên của bạn" name="tennguoibinhluan">';
        }
    }

    echo '
            </div>
            <div class="form-group">
                <input type="hidden" name="product_id_binhluan" value="' . $id . '">
                <label for="comment">Bình Luận:</label>
                <textarea class="form-control" rows="5" id="comment" name="binhluan"></textarea>
            </div>';
    // Kiểm tra nếu đã đăng nhập thì hiển thị nút Gửi Bình Luận
    echo '
            <input type="submit" name="binhluan_submit" class="btn btn-primary" value="Gửi Bình Luận">
        </form>
    </div>
    </div>
</div>';
} else {
    // Hiển thị form bình luận, nhưng không cho phép gửi khi chưa đăng nhập
    echo '
    <div class="row">
        <div class="col-md-6">
            <div class="product-comment">
                <h2>Bình Luận</h2>
            </div>
            <ul>';
    // Hiển thị sao và biểu mẫu, không cho phép đánh giá
    $get_product_details_2 = $product->get_details($id);

    if ($get_product_details_2) {
        while ($result_details = $get_product_details_2->fetch_assoc()) {
            echo '<li class="rating"';
            for ($count = 1; $count <= 5; $count++) {
                $color = '#ccc'; // Màu xám cho sao
                echo '<span id="' . $result_details['MaSP'] . '-' . $count . '" class="star" style="font-size:30px; color: ' . $color . '">&#9733;</span>';
            }

            echo '</li>';
            echo '</ul>
            <div class="container">';
        }
    }

    // Hiển thị form bình luận và thông báo khi nhấn nút "Gửi Bình Luận"
    echo '
    <form action="" method="post" id="commentForm">
    <div class="form-group">
        <label for="name">Họ tên:</label>';

    $getcustomer = $cs->show_customer_detail($customer_id);

    if ($getcustomer) {
        while ($result_customer = $getcustomer->fetch_assoc()) {
            echo '<input type="text" class="form-control" id="name" value="' . $result_customer['HoTen'] . '" placeholder="Nhập tên của bạn" name="tennguoibinhluan">';
        }
    }

    echo '
    </div>
    <div class="form-group">
        <input type="hidden" name="product_id_binhluan" value="' . $id . '">
        <label for="comment">Bình Luận:</label>
        <textarea class="form-control" rows="5" id="comment" name="binhluan"></textarea>
    </div>';
    // Kiểm tra nếu đã đăng nhập thì hiển thị nút Gửi Bình Luận
    echo '
    <input type="submit" name="binhluan_submit" class="btn btn-primary" value="Gửi Bình Luận">
    </form>
    </div>
    </div>
    </div>';
}
?>



        <?php
            $login_check = Session::get('customer_login');
            $customer_id = Session::get('customer_id');
            if($login_check){
                echo '
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-comment">
                            <h2>Xem bình luận </h2>
                        </div>
                        <div class="container">
                            ';
                            $getcomment = $cs->show_binhluan_customerid($id,$customer_id);
                            if($getcomment){
                                while($result_comment = $getcomment->fetch_assoc()){
                                    echo '          
                                        <div class="media mb-4">
                                            <div class="media-body">
                                                <h5 class="mt-0">'.$result_comment['TenNBL'].'
                                                </h5>
                                                <p>'.$result_comment['binhluan'].'</p>
                                            </div>
                                        </div>
                                        <div class="media mb-4">
                                            <div class="media-body">
                                                <h5 class="mt-0"> Admin </h5>';
                                    if(empty($result_comment['TraLoi_BL'])) {
                                        echo '<p style="color: green">Cảm ơn bạn đã gửi phản hồi</p>';
                                    } else {
                                        echo '<p>'.$result_comment['TraLoi_BL'].'</p>';
                                    }
                                    echo '</div></div>';
                                }
                            }
                echo '
                        </div>
                    </div>
                </div>
                ';
            }else{
                echo '
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-comment">
                            <h2>Xem bình luận </h2>
                        </div>
                        <div class="container">
                            ';
                            $getcomment = $cs->show_binhluan($id);
                            if($getcomment){
                                while($result_comment = $getcomment->fetch_assoc()){
                                    echo '          
                                    <div class="media mb-4">
                                        <div class="media-body">
                                            <h5 class="mt-0">'.$result_comment['TenNBL'].'
                                            </h5>
                                            <p>'.$result_comment['binhluan'].'</p>
                                        </div>
                                    </div>
                                    ';
                                }
                            }
                echo '
                        </div>
                    </div>
                </div>
                ';
            }
        ?>


        <div class="content_top">
        <div class="heading">
			<h3 style="width:300px;">Sản phẩm tương tự</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php
$get_product_details = $product->get_details_product($id);
if ($get_product_details) {
    while ($result = $get_product_details->fetch_assoc()) {
?>
        <div class="grid_1_of_4 images_1_of_4">
            <a href="preview-3.php"><img src="admin/uploads/<?php echo $result['hinhanh'] ?>" alt="" /></a><br><br>
            <h2 style="font-size: 18px"><?php echo $result['TenSP'] ?></h2><br><br>

            <?php
                $originalPrice = $result['Gia']; // Giá gốc
                $salePercentage = $result['GiaSale']; // Phần trăm giảm giá

                if ($salePercentage > 0) {
                    $salePrice = $originalPrice - ($originalPrice * ($salePercentage / 100));

                    echo '<div class="price-container">';
                echo '<span class="price" style="text-decoration: line-through; color: gray; font-size:17px">' . $fm->format_currency($result['Gia']) . ' VND</span>';
                echo '<span class="sale">' . $salePercentage . '%</span>';
                echo '</div>';
                    echo '<span class="sale-price" style="color: red; font-size:17px">' . $fm->format_currency($salePrice) . ' VND</span>';
                } else {
                    echo '<span class="price" style="color: red; font-size:17px">'. $fm->format_currency($originalPrice) . ' VND</span>';
                }
            ?>

            <div class="button"><span><a href="detail.php?proid=<?php echo $result['MaSP'] ?>" class="details">MUA NGAY</a></span></div>

        </div>
<?php
    }
} else {
    echo '<span style="font-size:15px">Không có sản phẩm nào</span>';
}
?>
</div>

    </div>
</div>
<script>
document.getElementById('commentForm').addEventListener('submit', function(event) {
    var loginCheck = "<?php echo $login_check; ?>";
    if (loginCheck !== "1") { // Kiểm tra trạng thái đăng nhập
        event.preventDefault(); // Ngăn chặn hành động mặc định của nút submit
        alert("Vui lòng đăng nhập để bình luận."); // Hiển thị thông báo yêu cầu đăng nhập
    }
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Bắt sự kiện khi click vào ảnh nhỏ
        $('.small-image').click(function() {
            // Lấy đường dẫn của ảnh nhỏ được chọn
            var smallImageSrc = $(this).attr('src');

            // Thay đổi đường dẫn của ảnh lớn thành ảnh nhỏ được chọn
            $('#main-image').attr('src', smallImageSrc);
        });
    });
</script>
<script>
function remove_background(product_id, index) {
    for (var count = index + 1; count <= 5; count++) {
        $('#' + product_id + '-' + count).css('color', '#ccc');
    }
}
//hover chuot danh gia
$(document).on('mouseenter', '.rating span', function() {
    var index = $(this).data('index');
    var product_id = $(this).data('product_id');

    remove_background(product_id, index);
    for (var count = 1; count <= index; count++) {
        $('#' + product_id + '-' + count).css('color', '#ffcc00');
    }
});

$(document).on('mouseleave', '.rating', function() {
    var product_id = $(this).data('product_id');
    var rating = $(this).data("rating");
    remove_background(product_id, rating);
});
</script>
<script>
$('.rating span').click(function(){
    var index = $(this).data('index');
    var loginCheck = "<?php echo $login_check; ?>";
    var orderCompleted = "<?php echo ($check_order_status !== false && $check_order_status->num_rows > 0) ? '1' : '0'; ?>";

    if (loginCheck !== "1") {
        alert("Vui lòng đăng nhập để đánh giá sao."); // Hiển thị thông báo yêu cầu đăng nhập
    } else if (orderCompleted !== "1") {
        alert("Bạn chỉ có thể đánh giá cho đơn hàng đã hoàn thành.");
    } else {
        var product_id = $(this).data('product_id');
        var customer_id = $(this).data('customer_id');
        $.ajax({
            url:'ajax/rating.php',
            data: {index:index, product_id:product_id, customer_id:customer_id},
            type: 'POST',
            success:function(data){
                alert('Đánh giá '+ index + ' sao thành công');
            },
            error: function(xhr, status, error) {
                alert("Lỗi: " + error);
            }
        });
    }
});
</script>
<?php
	include 'inc/footer.php';
?>

   