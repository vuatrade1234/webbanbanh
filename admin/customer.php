<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/customer.php');
	include_once ($filepath.'/../helpers/format.php');

?>
<?php
    if(!isset($_GET['customerid'] ) || $_GET['customerid']==NULL){
        echo "<script>window.location = 'inbox.php'</script>";
    }else{
        $id = $_GET['customerid'];
        $order_code = $_GET['order_code'];
    }
    $cs = new customer();
?>

        <div class="grid_10">
            <div class="box round first grid">
            <a href="inbox.php" style="display: flex; align-items: center;" class="iconh2">
                <i class="fas fa-arrow-left" style="margin-right: 10px; color:#ab1a27c4"></i>
                <h3s>Xem thông tin người đặt hàng</h3s>
            </a>
               <div class="block copyblock"> 
                <?php
                    $get_customer = $cs->show_customers($id);
                    if($get_customer){
                        while($result = $get_customer->fetch_assoc()){
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>Họ Tên:</td>
                            <td>
                                <input type="text" readonly="readonly"  value="<?php echo $result['HoTen'] ?>" name="name" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td>
                                <input type="text" readonly="readonly"  value="<?php echo $result['Username'] ?>" name="name" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Số điện thoại:</td>
                            <td>
                                <input type="text" readonly="readonly"  value="<?php echo $result['SDT'] ?>" name="name" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Ngày sinh:</td>
                            <td>
                                <input type="date" readonly="readonly"  value="<?php echo $result['NgaySinh'] ?>" name="name" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Địa chỉ:</td>
                            <td>
                                <input type="text" readonly="readonly"  value="<?php echo $result['DiaChi'] ?>" name="name" class="medium" />
                            </td>
                        </tr>
                    </table>
                </form>

                    <?php
                            }
                        }
                    ?>
                </div>
                <table class="data display datatable" id="example">
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
                        <td class="center"><center><img src="uploads/<?php echo $result['hinhanh'] ?>" width="50" alt=""></center></td>
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
<?php include 'inc/footer.php';?>