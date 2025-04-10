<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/customer.php');
	include_once ($filepath.'/../helpers/format.php');

?>
<?php 
	$privil = new privileges();
	$regexResult=$privil->checkPrivileges();
?>
<?php
    $cs = new customer();
    if($_SERVER['REQUEST_METHOD']=='POST'){
		var_dump($_POST);
        $reply = $_POST["reply"];
        $MaBL = $_POST["MaBL"];
        $updatetCart = $cs->update_comment($MaBL, $reply); 
    }


    // $ct = new cart();
    // if(isset($_GET['shifid'] )){
	// 	$id  =$_GET['shifid'];
	// 	$price = $_GET['Gia'];
	// 	$time = $_GET['ngaymua'];
		
	// 	$shifted = $ct->shifted($id, $price, $time);
	// }

	if(isset($_GET['blid'] )){
		$id  =$_GET['blid'];

		
		$del_shifted = $cs->del_binhluan($id);
	}
?>

        <div class="grid_10">            
            <div class="box round first grid">
			<a style="display: flex; align-items: center;" class="iconh2">
                <i style="margin-right: 10px; color:#ab1a27c4"></i>
                <h3>Hộp thư đến</h3>
            </a>
                <div class="block"> 
					<?php
						if (isset($updatetCart)){
							echo $updatetCart;
						}
					?>
					<?php
						// if (isset($del_shifted)){
						// 	echo $del_shifted;
						// }
					?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên người bình luận</th>
							<th>Nội dung</th>
							<th>Tên sản phẩm</th>
							<th>Nội dung phản hồi</th>
							
							<th>Phản hồi</th>
							
							<?php
								if($privil->checkPrivileges('blid=0')){
							?>
							<th>Xoá</th>
							<?php
								}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						
                            $cs = new customer();
							$get_binhluan = $cs->show_all_binhluan();
							if($get_binhluan) {
								$i =0;
								while($result = $get_binhluan->fetch_assoc()) {
									$i++;
						?>
						<tr class="odd gradeX">
						<td><center><?php echo $i; ?></center></td>
						<td><center><?php echo $result['TenNBL'] ?></center></td>
						<td><center><?php echo $result['binhluan'] ?></center></td>
                        <td><center><?php echo $result['TenSP'] ?></center></td>
						<td><center><?php echo $result['TraLoi_BL']?></center></td>
                        <td><center><a onclick="showDialog(<?php echo $result['MaBL'] ?>)"><i class="fas fa-comment"></i></a></center></td>
						<?php
							if($privil->checkPrivileges('blid='.$result['MaBL'])){
						?>
						<td><center><a href="?blid=<?php echo $result['MaBL'] ?>" onclick = "return confirm('Bạn có chắc muốn xóa không?')"><i class="fa fa-trash"></i></a></center></td>
						<?php
								}
						?>
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
	function showDialog(MaBL) {
		var reply = prompt("Nhập câu trả lời của bạn:", "");
		if (reply != null) {
			$.ajax({
				url: 'comment.php', 
				type: 'POST',
				data: {
					MaBL: MaBL,
					reply: reply
				},
				success: function(response) {

					console.log(response);
					location.reload();

				}
			});
		}
	}

</script>

<?php include 'inc/footer.php';?>
