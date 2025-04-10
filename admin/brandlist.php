<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php 
	$privil = new privileges();
	$regexResult=$privil->checkPrivileges();
?>

<?php
	$brand = new brand();
	if(isset($_GET['brand_id'])){
		$id = $_GET['brand_id'];
		$delbrand = $brand->del_brand($id);
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
			<a style="display: flex; align-items: center;" class="iconh2">
				<h3>Danh sách thương hiệu</h3>
			</a>
				<?php
					if(isset($delbrand)){
						echo $delbrand;
					}
				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Danh mục sản phẩm</th>
							<?php
								if($privil->checkPrivileges('brandedit.php?brandid=1')){
							?>
							<th>Sửa</th>
							<?php
								}
							?>
							<?php
								if($privil->checkPrivileges('?brand_id=1')){
							?>
							<th>Xóa</th>
							<?php
								}
							?>
						</tr>
					</thead>
					<tbody>
					<?php
						$show_brand = $brand->show_brand();
						if($show_brand){
							$i = 0;
							while($result = $show_brand->fetch_assoc()){
								$i++;
					?>
						<tr class="odd gradeX">
							<td><center><?php echo $i ?></center></td>
							<td><center><?php echo $result['TenTH'] ?></center></td>
							<td>
							<?php
								if($privil->checkPrivileges('brandedit.php?brandid='.$result['id'])){
							?>								
							<a href="brandedit.php?brandid=<?php echo $result['id'] ?>"><center><i class="fa fa-edit"></i></center></a>
							</td>
							<?php
								}
							?>
							<?php
								if($privil->checkPrivileges('?brand_id='.$result['id'])){
							?>
								<td><a href="?brand_id=<?php echo $result['id'] ?>" onclick = "return confirm('Bạn có chắc muốn xóa không?')"><center><i class="fa fa-trash"></i></center></a></td>
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

