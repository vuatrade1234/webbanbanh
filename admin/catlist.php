<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
	$cat = new category();
	if(isset($_GET['catlist'])){
		$id = $_GET['catlist'];
		$delcat = $cat->del_category($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
			<a style="display: flex; align-items: center;" class="iconh2">
				<h3>Danh sách danh mục</h3>
			</a>
                
				<?php
					if(isset($delcat)){
						echo $delcat;
					}
				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Danh mục sản phẩm</th>
							<th>Sửa</th>
							<th>Xóa</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$show_cat = $cat->show_category();
						if($show_cat){
							$i = 0;
							while($result = $show_cat->fetch_assoc()){
								$i++;
					?>
						<tr class="odd gradeX">
							<td><center><?php echo $i ?></center></td>
							<td><center><?php echo $result['TenDM'] ?></center></td>
							<td>
							<a href="catedit.php?catid=<?php echo $result['MaDM'] ?>"><center><i class="fa fa-edit"></i></center></a>
							</td>
							<td><a href="?catlist=<?php echo $result['MaDM'] ?>" onclick = "return confirm('Bạn có chắc muốn xóa không?')"><center><i class="fa fa-trash"></i></center></a></td>
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

