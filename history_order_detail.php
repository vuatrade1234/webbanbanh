<?php
    include 'inc/header.php';
?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check==false){
        header('Location:login.php');
    }
?>
<style>
    th{
        text-align: center;
        font-size: 1.9rem;
    }
    td{
        font-size: 1.6rem;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Lịch sử chi tiết đơn hàng</h3>
                </div>
                <div class="clear"></div>
                
                <table class="table table-trip table-hover" id="example">
					<thead>
						<tr>
							<th>Tên sản phẩm</th>
                            <th>Hình ảnh sản phẩm</th>
							<th>Giá sản phẩm </th>
							<th>Số lượng sản phẩm</th>
							<th>Thành tiền</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $order_code = $_GET['order_code'];
                    $get_order = $cs->show_order($order_code);
                    if($get_order){
                        $subtotal = 0;
                        $total = 0;
                        while($result = $get_order->fetch_assoc()){
                            $subtotal = $result['SoLuong'] * $result['Gia'];
                            $total += $subtotal;
                ?>
                    <tr class="odd gradeX">
						<td><center><?php echo $result['TenSP'] ?></center></td>
                        <td class="center"><center><img src="admin/uploads/<?php echo $result['hinhanh'] ?>" width="50" alt=""></center></td>
                        <td><center><?php echo number_format($result['Gia'],0,',','.') ?></center></td>
                        <td><center><?php echo $result['SoLuong'] ?></center></td>
                        <td><center><?php echo number_format($subtotal,0,',','.') ?></center></td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                    <tr>
                        <td colspan="5">Tổng tiền: <?php echo number_format($total,0,',','.') ?></td>
                    </tr>
					</tbody>
				</table>
            </div>
        </div>
    </div>

</div>