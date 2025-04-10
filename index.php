<?php
	include 'inc/header.php';
	include 'inc/slider.php';

?>

<style>
.section.group {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
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
    height: 32vh;;
    object-fit: cover;
}

</style>
 <div class="main">
    <div class="content">
      <div class="content_top">
        <div class="heading">
        <h3>Sản phẩm nổi bật</h3>
        </div>
        <div class="clear"></div>
      </div>
	    <div class="section group">
			<?php
				$getproduct = $product->getproduct_feathered();
				if($getproduct){
          while($result = $getproduct->fetch_assoc()){
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/uploads/<?php echo $result['hinhanh'] ?>" alt="" /></a><br><br>
					 <h2 style="font-size: 18px"><?php echo $result['TenSP'] ?></h2><br><br>
					 <p><span class="price"><?php echo $fm->format_currency($result['Gia'])."VND" ?></span></p>
				     <div class="button"><span style="margin-left: 18px"><a href="detail.php?proid=<?php echo $result['MaSP'] ?>" class="details">XEM CHI TIẾT</a></span></div>
				</div>
			<?php
					}
				}else{
					echo '<span class="font-size:30px">Không có sản phẩm nào</span>';
				}
			?>
			</div>
			
			<div class="content">
      			<div class="content_top">
        			<div class="heading">
        				<h3>Sản phẩm mới</h3>
        			</div>
        			<div class="clear"></div>
      			</div>
      			<div class="section group">
			<?php
				    $getproduct_new = $product->getproduct_new();
				if($getproduct_new){
          while($result = $getproduct_new->fetch_assoc()){
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/uploads/<?php echo $result['hinhanh'] ?>" alt="" /></a><br><br>
					 <h2 style="font-size: 18px"s><?php echo $result['TenSP'] ?></h2><br><br>
					 <p><span class="price"><?php echo $fm->format_currency($result['Gia'])."VND" ?></span></p>

				     <div class="button"><span style="margin-left: 15px"><a href="detail.php?proid=<?php echo $result['MaSP'] ?>" class="details">XEM CHI TIẾT</a></span></div>
				</div>
			<?php
					}
				}else{
					echo '<span class="font-size:30px">Không có sản phẩm nào</span>';
				}
			?>
			</div>
			<div class="content">
      			<div class="content_top">
        			<div class="heading">
        				<h3>Sản Phẩm Giảm Giá</h3>
        			</div>
        			<div class="clear"></div>
      			</div>
      			<div class="section group">
				<?php
					$getproduct_new = $product->sale_product();
					if ($getproduct_new) {
						while ($result = $getproduct_new->fetch_assoc()) {
							$originalPrice = $result['Gia']; // Giá gốc
							$salePercentage = $result['GiaSale']; // Phần trăm giảm giá
							
							$salePrice = $originalPrice - ($originalPrice * ($salePercentage / 100)); // Tính giá sau khi giảm giá

							?>
							<div class="grid_1_of_4 images_1_of_4">
								<a href="preview-3.php"><img src="admin/uploads/<?php echo $result['hinhanh'] ?>" alt="" /></a><br><br>
								<h2 style="font-size: 18px"><?php echo $result['TenSP'] ?></h2><br><br>
								<p>
									<span class="price" style="text-decoration: line-through; color:#7e7373; font-size:15px;"><?php echo $fm->format_currency($result['Gia'])."VND" ?></span>

									<span class="price" style="background-color: yellow; padding: 2px; border-radius: 2px; font-size:15px;"><?php echo "-".$fm->format_currency($salePercentage)."%" ?></span>
								</p>
								<p><span class="price"><?php echo $fm->format_currency($salePrice)."VND" ?></span>	</p>					
								<div class="button">
									<span style="margin-left: 15px"><a href="detail.php?proid=<?php echo $result['MaSP'] ?>" class="details">XEM CHI TIẾT</a></span>
								</div>
							</div>
				<?php
					}
				}else{
					echo '<span class="font-size:30px">Không có sản phẩm nào</span>';
				}
			?>
			</div>
	
	
    </div>
 </div>
<?php
	include 'inc/footer.php';
?>



