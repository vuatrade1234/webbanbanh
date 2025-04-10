

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
	if(isset($_GET['cartid'])){
		$cartid = $_GET['cartid'];
		$delCart = $ct->del_product_cart($cartid);

	}
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])){
		$cartId = $_POST['cartId'];
		$quantity = $_POST['quantity'];
		$update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId);
		echo $update_quantity_cart;
		exit;
	}
?>

<style>
	.shopping .shopleft a, .shopping .shopright a {
		display: inline-block;
		background: linear-gradient(to top, #602d8d, #c53985a8); 
		color: white; 
		text-align: center;
		padding: 15px 32px; 
		text-decoration: none; 
		font-size: 16px; 
		margin: 4px 2px;
		cursor: pointer; 
		border-radius: 4px; 
	}

	.shopping .shopleft a:hover, .shopping .shopright a:hover {
		background: linear-gradient(to top, #602d8d, #c53985a8); 
	}
</style>
 <div class="main">
    <div class="content">
	<div class="content_top">
  <div class="heading">
    <h3>Giỏ hàng</h3>
  </div>
  <div class="clearfix"></div>
</div>
    	<div class="cartoption">		
			<div class="cartpage">
			    	
					<?php
						if(isset($update_quantity_cart)){
							echo $update_quantity_cart;
						}
					?>
					<?php
						if(isset($delCart)){
							
							echo $delCart;
						}
					?>
						<table class="tblone">
							<tr>
								<th>Tên sản phẩm</th>
								<th>Hình ảnh</th>
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Giá</th>
								<th>Mua</th>
								<th>Xóa</th>
							</tr>
							<?php
								$get_product_cart = $ct->get_product_cart($customer_id);
								$subtotal = 0;
								$qty = 0;

								if($get_product_cart){

									while($result = $get_product_cart->fetch_assoc()){
										$total = $result['Gia'] * $result['SoLuong'];
										$subtotal += $total;
										$qty += $result['SoLuong'];

										$show_quantity_product = $ct->show_quantity_product_cart($result['MaSP']);
										$result_sl = $show_quantity_product->fetch_assoc();
										
								?>
								<tr style="font-size:15px">
									<td><?php echo $result['TenSP'] ?></td>
									<td><img src="admin/uploads/<?php echo $result['hinhanh'] ?>" alt=""/></td>
									<td><?php echo $fm->format_currency($result['Gia'])." "."VND" ?></td>
								
									<td>
										<form action="" method="post" id="quantityForm">
											<input type="hidden" name="cartId" value="<?php echo $result['MaGH'] ?>"/>
											<input type="number" style="width:50%" min="1" max="<?php echo $result_sl['SoLuong'] ?>" name="quantity" value="<?php echo $result['SoLuong'] ?>" onchange="this.form.submit()"/>
										</form>

									</td>
									<td>
										<?php
											$total = $result['Gia'] * $result['SoLuong']; echo $fm->format_currency($total)." "."VND";
										?>
									</td>
									<td>
										<div class="form-check">
											<input class="form-check-input buy_checked" 
											<?php
												if($result['tinhtrang'] == 1){
											?>
												checked
											<?php
												}else{

											?>
											<?php
												}
											?>
											type="checkbox" value="<?php echo $result['MaGH']?>" id="defaultCheck1">
											<label class="form-check-label" for="defaultCheck1">
										</div>
									</td>
									<td><a href="?cartid=<?php echo $result['MaGH'] ?>"><i class="fa fa-trash"></i></a></td>
								</tr>
								<?php
									}
								}
								?>
								</table>

						<table style="float:right;text-align:left;" width="40%">
							<?php
								
								if($subtotal>0){
							?>
								<tr style="font-size:15px">
									<th>Tổng: </th>
									<td>
										<?php 
										echo $fm->format_currency($subtotal)." "."VND";
										Session::set("qty", $qty);
										
										?>
									</td>
									
								</tr>
							<?php
								}
							?>
					   </table>
				</div>
					<div class="shopping">
						<div style="margin-left: 150px" class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" />Tiếp tục mua hàng</a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /><i class="fa fa-check"> Kiểm tra</i></a>
						</div>
					</div>
    			</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<script>
	document.querySelectorAll('#quantityForm').forEach(function(form) {
    form.addEventListener('change', function(e) {
        e.preventDefault();

        var quantity = this.elements['quantity'].value;
        var cartId = this.elements['cartId'].value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'cart.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (this.status == 200) {
                console.log(this.responseText);
            }
        };

        xhr.send('quantity=' + quantity + '&cartId=' + cartId + '&ajax=true');
		});
	});
</script>
<script>
$('.buy_checked').click(function(){
    var id = $(this).val();
    var cart_status = $(this).is(':checked') ? 1 : 0;

    console.log('id:', id, 'cart_status:', cart_status);

    $.ajax({
        url: 'ajax/stick_buy.php',
        data: { id: id, cart_status: cart_status },
        type: 'POST',
        success: function(data) {
            console.log('Ajax response:', data);

            // Thực hiện các thay đổi trên giao diện người dùng dựa trên kết quả AJAX
            // Ví dụ: có thể làm cho hàng được chọn có màu khác, hiển thị thông báo, vv.

            // Ví dụ đơn giản: Hiển thị thông báo nếu có lỗi
            if (data === 'Cập nhật không thành công') {
                alert(data);
            }
        },
        error: function(xhr, status, error) {
            console.error('Ajax error:', error);
        }
    });
});
</script>