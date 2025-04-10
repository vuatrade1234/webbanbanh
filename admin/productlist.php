<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include_once '../helpers/format.php';?>
<?php 
	$privil = new privileges();
	$regexResult=$privil->checkPrivileges();
?>
<?php
	$pd = new product();
	$fm = new Format();
	if(isset($_GET['productid'])){
		$id = $_GET['productid'];
		$delproduct = $pd->del_product($id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
		<a style="display: flex; align-items: center;" class="iconh2">
            <h3>Danh sách sản phẩm</h3>
        </a>
		<?php
			if(isset($delproduct)){
				echo $delproduct;
			}
		?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Sản phẩm</th>
					<th>Giá sản phẩm</th>
					<th>Xuất xứ</th>
					<th>Khối lượng</th>
					<th>Hình Ảnh</th>
					<th>Mô tả</th>
					<th>Ngày sản xuất</th>
					<th>Hạn SD</th>
					<th>Type</th>
					<th>Danh mục</th>
					<th>Thương hiệu</th>
					<?php
						if($privil->checkPrivileges('productimages.php?productid=0')){
					?>
					<th>Chi tiết ảnh</th>
					<?php
						}
					?>
					<?php
						if($privil->checkPrivileges('productedit.php?productid=0')){
					?>
					<th>Sửa</th>
					<?php
						}
					?>
					<?php
						if($privil->checkPrivileges('?productid=0')){
					?>
					<th>Xóa</th>
					<?php
						}
					?>
				</tr>
			</thead>
			<tbody>
				<?php								
					$pdlist = $pd->show_product();
					if($pdlist){
						$i = 0;
						while($result = $pdlist->fetch_assoc
						()){
							$i++;

				?>
				<tr class="odd gradeX">
					<td><center><?php echo $i ?></center></td>
					<td><center><?php echo $result['TenSP'] ?></center></td>
					<td><center><?php echo $result['Gia'] ?></center></td>
					<td><center><?php echo $result['XuatXu'] ?></center></td>
					<td><center><?php echo $result['KhoiLuong'] ?></center></td>

					
					<td class="center"><center><img src="uploads/<?php echo $result['hinhanh'] ?>" width="50" alt=""></center></td>
					<td><center><?php 
						
						echo $fm->textShorten($result['MoTa'], 5);
					?></center></td>
					<td><center><?php echo $result['NgaySX'] ?></center></td>
					<td><center><?php echo $result['HanSD']?></center></td>
					<td><center><?php 
						if($result['Type'] == 0){
							echo 'NoiBat';
						}else{
							echo 'KhongNoiBat';
						}
					?></center></td>
					<td class="center"><center><?php echo $result['TenDM']?></center></td>
					<td class="center"><center><?php echo $result['TenTH']?></center></td>
					<?php
						if($privil->checkPrivileges('productimages.php?productid='.$result['MaSP'])){
					?>
					<td class="center"><center><a href="productimages.php?productid=<?php echo $result['MaSP'] ?>">Thêm ảnh</a></center></td>
					<?php
						}
					?>
					<?php
						if($privil->checkPrivileges('productedit.php?productid='.$result['MaSP'])){
					?>
					<td><center><a href="productedit.php?productid=<?php echo $result['MaSP'] ?>"><i class="fa fa-edit"></i></a></center> </td>
					<?php
						}
					?>
					<?php
						if($privil->checkPrivileges('?productid='.$result['MaSP'])){
					?>
					<td><center><a href="?productid=<?php echo $result['MaSP'] ?>" onclick="return confirm('Bạn có muốn xóa?')"><i class="fa fa-trash"></a></center></td>
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
