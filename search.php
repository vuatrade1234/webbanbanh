<?php
	include 'inc/header.php';
	include 'inc/slider.php';
?>

<style>
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
    height: 200px;
    object-fit: cover;
}

</style>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
			<?php
				    if($_SERVER['REQUEST_METHOD'] == 'POST'){
						$tukhoa = $_POST['tukhoa'];
						$search_product = $product->search_product($tukhoa);
					}
				
			?>
    			<h3>Tìm kiếm:	<?php echo $tukhoa ?></h3>

    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php
				if($search_product){
					while($result = $search_product->fetch_assoc()){
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/uploads/<?php echo $result['hinhanh'] ?>" alt="" /></a><br><br>
					 <h2 style="font-size: 18px"><?php echo $result['TenSP'] ?></h2><br><br>
					 <p><span class="price"><?php echo $result['Gia']."VND" ?></span></p>
				     <div class="button"><span><a href="detail.php?proid=<?php echo $result['MaSP'] ?>" class="details">MUA NGAY</a></span></div>
				</div>
			<?php
					}
				}else{
					echo '<span style="font-size:15px">Không có sản phẩm nào</span>';
				}
			?>
		</div>	
    </div>
 </div>
<?php
	include 'inc/footer.php';
?>



