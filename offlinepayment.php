

<?php
	include 'inc/header.php';
?>
<?php
	 if(isset($_GET['orderid'] ) && $_GET['orderid']=='order'){
		$customer_id=Session::get('customer_id');
		$insertOrder = $ct->insertOrder($customer_id);
		$delCart = $ct->del_all_data_cart($customer_id);
		header('Location:success.php');
    }
?>
<style>
    .box-left{
        width: 49%;
        float: left;
        border: 1px solid #000;
        padding: 15px;

    }
    .box-right{
        width: 49%;
        float: right;
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
</style>
<form action="" method="post">

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="heading">
                <h3>Thanh toán khi nhận hàng</h3>
            </div>
            <div class="clear"></div>

            <div class="box-left">
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
                                <th>STT</th>
								<th>Tên sản phẩm</th>
								<th>Hình ảnh</th>
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Tổng giá</th>
							</tr>
							<?php
								$get_product_cart = $ct->get_product_cart_checkout($customer_id);
								$subtotal = 0;
								$qty = 0;

								if($get_product_cart){
                                    $i=0;
									while($result = $get_product_cart->fetch_assoc()){
                                        $i++;
										$total = $result['Gia'] * $result['SoLuong'];
										$subtotal += $total;
										$qty += $result['SoLuong']
										
								?>
								<tr style="font-size:15px">
                                    <td><?php echo $i ?></td>
									<td><?php echo $result['TenSP'] ?></td>
									<td><img src="admin/uploads/<?php echo $result['hinhanh'] ?>" alt=""/></td>
									<td><?php echo $fm->format_currency($result['Gia'])." "."VND" ?></td>
									<td>
										<?php echo $result['SoLuong'] ?>
									</td>
									<td>
										<?php
											$total = $result['Gia'] * $result['SoLuong']; echo $fm->format_currency($total)." "."VND";
										?>
									</td>
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
										echo number_format($subtotal,0,',','.')." "."VND";
										Session::set("qty", $qty);
										?>
									</td>
									
								</tr>
							<?php
								}
							?>
					   </table>
				</div>
            </div>
            <div class="box-right">
			<table class="tblone">
                <?php
                    $id = Session::get('customer_id');

                    $get_customers = $cs->show_customers($id);
                    if($get_customers){
                        while($result = $get_customers->fetch_assoc()){
                            
                    
                ?>
                <tr style="font-size: 16px">
                    <td>Họ và tên:</td>
                    <td><?php echo $result['HoTen'] ?></td>
                </tr>
                <tr style="font-size: 16px">
                    <td>Số điệt thoại:</td>
                    <td><?php echo $result['SDT'] ?></td>
                </tr>
                <tr style="font-size: 16px">
                    <td>Địa chỉ:</td>
                    <td><?php echo $result['DiaChi'] ?></td>
                </tr>
                <tr>
                    <td colspan="3" >
                            <h4><a href="editprofile.php" name="save" class="font-size:15px; cursor:pointer">Thay đổi thông tin nhận hàng</a></h4>
                    </td>
                </tr>
                <?php
                        }
                }
                ?>

            </table>
			</div>
		</div>
    </div>
		<center><a href="?orderid=order" class="submit_order">Đặt hàng</a></center>
</div><br><br><br><br>
</form>
<?php
	include 'inc/footer.php';
?>

   