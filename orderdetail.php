

<?php
	include 'inc/header.php';
?>
<?php
    $customer_id = Session::get('customer_id');
	if($customer_id == NULL){
		header('Location:login.php');
	}
?>
<?php
    $ct = new cart();
    if(isset($_GET['confirmid'] )){
		$id  =$_GET['confirmid'];
		$price = $_GET['Gia'];
		$time = $_GET['ngaymua'];
		
		$shifted_confirm = $ct->shifted_confirmd($id, $price, $time);
	}
    if(isset($_GET['delid'] )){
		$id  =$_GET['delid'];
		$price = $_GET['Gia'];
		$time = $_GET['ngaymua'];
		
		$del_shifted = $ct->del_shifted($id, $price, $time);
	}
?>
<style>
    .box-left{
        width: 100%;
        border: 1px solid #000;
        padding: 15px;

    }
    .submit_order {
        display: inline-block;
        padding: 6px 20px;
        font-size: 20px;
        color: white;
        background-color: #4CAF50; /* Màu nền của nút */
        border: none;
        border-radius: 5px; /* Bo góc cho nút */
        text-decoration: none; /* Loại bỏ gạch chân */
    }

    .submit_order:hover {
        background-color: #45a049; /* Màu nền khi di chuột qua nút */
    }
    .shopping .shopleft a, .shopping .shopright a {
		display: inline-block;
		background: linear-gradient(to top, #602d8d, #c53985a8); /* Gradient từ màu nhạt sang màu đậm */
		color: white; /* Màu chữ của nút */
		text-align: center;
		padding: 15px 32px; /* Đệm cho nút */
		text-decoration: none; /* Loại bỏ gạch chân */
		font-size: 16px; /* Kích thước chữ */
		margin: 4px 2px;
		cursor: pointer; /* Biến đổi con trỏ khi di chuột qua nút */
		border-radius: 4px; /* Bo góc cho nút */
	}

	.shopping .shopleft a:hover, .shopping .shopright a:hover {
		background: linear-gradient(to top, #602d8d, #c53985a8); /* Gradient từ màu đậm sang màu nhạt khi di chuột qua */
	}
</style>
<form action="" method="post">

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="heading">
                <h3>Đơn đặt hàng</h3>
            </div>
            <div class="clear"></div>

                <div class="box-left">
                    <div class="cartpage">
						<table class="tblone">
							<tr>
                                <th>STT</th>
								<th>Tên sản phẩm</th>
								<th>Hình ảnh</th>
								<th>Giá</th>
								<th>Số lượng</th>
                                <th>Tình trạng đơn hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Xoá</th>
							</tr>
							<?php
                                $customer_id = Session::get('customer_id');
								$get_cart_ordered = $ct->get_cart_ordered($customer_id);
                                $id=0;
								if($get_cart_ordered){
                                    
									while($result = $get_cart_ordered->fetch_assoc()){
                                        $id++;
										
								?>
								<tr style="font-size:15px">
                                    <td><?php echo $id ?></td>
									<td><?php echo $result['TenSP'] ?></td>
									<td><img src="admin/uploads/<?php echo $result['hinhanh'] ?>" alt=""/></td>
									<td><?php echo $fm->format_currency($result['Gia'])." "."VND" ?></td>
									<td>
										<?php echo $result['SoLuong'] ?>
									</td>
                                    <td>
                                        <?php
                                            if($result['tinhtrang'] =='0'){
                                                echo 'Đang xử lý';
                                            }elseif ($result['tinhtrang'] =='1') {
                                        ?>
                                        <span>Đang vận chuyển</span>
                                        <?php
                                            } elseif ($result['tinhtrang'] =='2'){     
                                                echo 'Đã nhận hàng';

                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $fm-> formatDate($result['ngaymua']) ?></td>
                                    
                                    <?php 
                                        if($result['tinhtrang'] =='0'){ 
                                    ?>
                                       <td><a href="orderdetail.php?delid=<?php echo $result['id'] ?>&Gia=<?php echo $result['Gia'] ?>&ngaymua=<?php echo $result['ngaymua'] ?>"><i class="fa fa-trash"></i></a></td>
                                    <?php
                                        }elseif($result['tinhtrang'] =='1'){
                                    ?>
                                        <td>
                                            <a href="orderdetail.php?confirmid=<?php echo $customer_id ?>&Gia=<?php echo $result['Gia'] ?>&ngaymua=<?php echo $result['ngaymua'] ?>">Đã nhận hàng</a>
                                        </td>

                                    <?php
                                        }else{
                                    ?>
>
                                        <td><?php echo 'Đã nhận hàng' ?></td>

                                    <?php
                                        }
                                    ?>
                                </tr>
								<?php
									}
								}
								?>
					   </table>
    			    </div> 
				</div>
                <div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" />Tiếp tục mua hàng</a>
						</div>
					</div>
            </div>
		</div>
    </div>
</div>
</form>
<?php
	include 'inc/footer.php';
?>


   