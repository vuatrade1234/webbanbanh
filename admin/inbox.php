<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/cart.php');
	include_once ($filepath.'/../helpers/format.php');

?>
<?php 
	$privil = new privileges();
	$regexResult=$privil->checkPrivileges();
?>
<?php
$ct = new cart();
    if(isset($_GET['shifid'] )){
		$id  =$_GET['shifid'];
		
		$shifted = $ct->shifted($id);
		
		if($shifted){
			echo "<script>window.location = 'inbox.php'</script>";
		}
	}

	if(isset($_GET['delid'] )){
		$id  =$_GET['delid'];		
		$del_shifted = $ct->del_shifted($id);

		if($del_shifted){
			echo "<script>window.location = 'inbox.php'</script>";
		}
	}

?>

        <div class="grid_10">            
            <div class="box round first grid">
			<a style="display: flex; align-items: center;" class="iconh2">
                <i style="margin-right: 10px; color:#ab1a27c4"></i>
                <h3>Đơn hàng</h3>
            </a>
                <div class="block"> 
					<?php
						if (isset($shifted)){
							echo $shifted;
						}
					?>
					<?php
						if (isset($del_shifted)){
							echo $del_shifted;
						}
					?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Thời gian đặt</th>
							<th>Mã đặt hàng</th>
							<th>Tên khách hàng</th>
							<?php
								if($privil->checkPrivileges('customer.php?customerid=0&order_code=0')){
							?>
							<th>Chi tiết đơn hàng</th>
							<?php
								}
							?>
							<?php
								if($privil->checkPrivileges('inbox.php?shifid=0')){
							?>
							<th>Tình trạng</th>
							<?php
								}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						
                            $ct = new cart();
							$fm = new Format();
							$get_inbox_cart = $ct->get_inbox_cart();
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
						<?php
							if($privil->checkPrivileges('customer.php?customerid=0'.$result['MaKH'].'&order_code=0'.$result['MaDonH'])){
						?>
							<td><center><a href="customer.php?customerid=<?php echo $result['MaKH']?>&order_code=<?php echo $result['MaDonH']?>">Xem chi tiết</a></center></td>
						<?php
							}
						?>
						<?php
								if($privil->checkPrivileges('inbox.php?shifid='.$result['MaDonH'])){
							?>
						<td>
							<?php
							if ($result['tinhtrang'] == 0) {
								?>
								<center><a href="inbox.php?shifid=<?php echo $result['MaDonH'] ?>">Chưa xử lý</a></center>
								<?php
							} elseif ($result['tinhtrang'] == 1) {
								?>
								<center><?php
									echo 'Đang vận chuyển';
									?></center>
								<?php
							} elseif ($result['tinhtrang'] == 2) {
								?>
								<center><a href="inbox.php?delid=<?php echo $result['MaDonH'] ?>">Đã nhận | <i class="fa fa-trash"></i></a></center>
								<?php
							} elseif ($result['tinhtrang'] == 3) {
								?>
								<center>Yêu cầu trả hàng</center>
								<?php
							}
							?>
						</td>
						<?php
								}
						?>
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
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
