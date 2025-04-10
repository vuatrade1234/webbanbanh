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
    if(isset($_GET['proid'])){
        $customer_id = Session::get('customer_id');
        $proid = $_GET['proid'];
        $delwlist = $product->del_wlist($proid, $customer_id);
    }
?>
<style>
	.shopping .shopleft a, .shopping .shopright a {
		display: inline-block;
		background: linear-gradient(to top, #602d8d, #c53985a8); /* Gradient từ màu nhạt sang màu đậm */
		color: white; /* Màu chữ của nút */
		text-align: center;
		padding: 15px 32px; /* Đệm cho nút */
		text-decoration: none; /* Loại bỏ gạch chân */
		font-size: 16px; /* Kích thước chữ */
		margin: 4px 2px;
		cursor: pointer; /* Biến đổi con trỏ khi di chuột qua nút */
		border-radius: 4px; /* Bo góc cho nút */
	}

	.shopping .shopleft a:hover, .shopping .shopright a:hover {
		background: linear-gradient(to top, #602d8d, #c53985a8); /* Gradient từ màu đậm sang màu nhạt khi di chuột qua */
	}
    .cartpage h2 {
    width: 100%;
}
</style>

 <div class="main">
    <div class="content">
    <div class="content_top">
  <div class="heading">
    <h3>Sản phẩm yêu thích</h3>
  </div>
  <div class="clearfix"></div>
</div>
    	<div class="cartoption">		
			<div class="cartpage">
						<table class="tblone">
							<tr>
                                <th>STT</th>
								<th>Tên sản phẩm</th>
								<th>Hình ảnh</th>
								<th>Giá</th>
								<th>Xóa</th>
                                <th>Mua</th>
							</tr>
							<?php
								$customer_id = Session::get('customer_id');
                                $get_wishlist = $product->get_wishlist($customer_id);
                                if($get_wishlist){
                                    $i=0;
                                    while($result = $get_wishlist->fetch_assoc()){
                                        $i++;
                            ?>
								<tr style="font-size:15px">
                                    <td><?php echo $i; ?></td>
									<td><?php echo $result['TenSPYT'] ?></td>
									<td><img src="admin/uploads/<?php echo $result['hinhanh'] ?>" alt=""/></td>
									<td><?php echo $fm->format_currency($result['Gia'])." "."VND"?></td>
									
									<td>
                                    <a href="?proid=<?php echo $result['MaSP']?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>

                                    </td>
									</td>
									<td><a href="detail.php?proid=<?php echo $result['MaSP']?>">Mua ngay</a></td>
								</tr>
								<?php
									}
								}
								?>
							</table>
					
       <div class="clear"></div>
    </div>
 </div>
</div><br><br><br><br><br><br>
<?php
	include 'inc/footer.php';
?> 