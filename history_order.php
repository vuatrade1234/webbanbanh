

<?php
	include 'inc/header.php';
?>
<?php
    Session::init();
     $login_check = Session::get('customer_login');
     if($login_check==false){
       header('Location:login.php');
     }
    //  $ct = new cart();
    if(isset($_GET['danhanhang'] )){
		$danhanhang  =$_GET['danhanhang'];
		
		$danhanhang = $ct->danhanhang($danhanhang);
		if($danhanhang){
			echo "<script>window.location = 'history_order.php'</script>";
		}
	}

	if(isset($_GET['trahang'] )){
		$trahang  =$_GET['trahang'];
		
		$trahang = $ct->returns($trahang);
		if($trahang){
			echo "<script>window.location = 'history_order.php'</script>";
		}
	}

?>
<?php
	
	if(isset($_GET['id'] )){
		$id  =$_GET['id'];		
		$del_shifted = $ct->del_shifted($id);

		if($del_shifted){
			echo "<script>window.location = 'history_order.php'</script>";
		}
	}
?>
<style>
th{
    font-size: 1.9rem;
    text-align: center;
}
td{
    font-size: 1.6rem;
}
</style>
<div class="container">
    <div class="center">
        <div class="section group">
            <div class="section_top">
                <div class="heading">
                <br><br><h3>Lịch sử đơn hàng</h3>

                </div>
                <div class="clear"></div>
                <div class="wrapper_method">
                <table class="table table-trip table-hover" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Thời gian đặt</th>
							<th>Mã đơn hàng</th>
							<th>Tên khách hàng</th>
							<th>Chi tiết đơn hàng</th>
							<th>Tình trạng</th>
						</tr>
					</thead>
					<tbody>
						<?php
						
                            $ct = new cart();
							$fm = new Format();
                            $customer_id = Session::get('customer_id');
							$get_inbox_cart = $ct->get_inbox_cart_history($customer_id);
							if($get_inbox_cart) {
								$i =0;
								while($result = $get_inbox_cart->fetch_assoc()) {
									$i++;
						?>
						<tr class="odd gradeX">
						<td><center><?php echo $i; ?></center></td>
						<td><center><?php echo $fm->formatDate($result['date_create']) ?></center></td>
						<td><center><?php echo $result['MaDonH'] ?></center></td>
						<td><center><?php echo $result['HoTen'] ?></center></td>
						
						<td><center><a href="history_order_detail.php?customerid=<?php echo $result['MaKH']?>&order_code=<?php echo $result['MaDonH']?>">Xem chi tiết</a></center></td>
						<td>
						<?php
							if ($result['tinhtrang'] == 0) {
								?>
								<center>Chưa xử lý | <a href="history_order.php?id=<?php echo $result['MaDonH'] ?>">Huỷ đơn hàng</a></center>
								<?php
							} elseif ($result['tinhtrang'] == 1) {
								?>
								<center><a href="history_order.php?danhanhang=<?php echo $result['MaDonH'] ?>">Đã nhận hàng</a></center>
								<?php
							} elseif ($result['tinhtrang'] == 2) {
								?>
								<center>Đã hoàn tất đơn hàng | <a href="history_order.php?trahang=<?php echo $result['MaDonH'] ?>">Trả hàng</a></center>
								<?php
							}else{
								?>
								<center><?php echo 'Đã huỷ đơn hàng' ?></center>
								<center><?php echo 'Chúng tôi sẽ liên hệ trong thời gian sớm nhất' ?></center>
								<?php
						?>
						
								
						<?php
							}
						?>
								
	
						</td>
						</tr>
						<?php
								}
							}
						?>
					</tbody>
				</table>
                </div>
            </div>

        </div>
    </div>
</div><br><br><br><br><br><br>
<?php
	include 'inc/footer.php';
?>