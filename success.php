

<?php
	include 'inc/header.php';
?>

<style>
    h2.success_order{
        text-align: center;
        color: #4CAF50;
    }
    p{
        font-size:18px;
        text-align: center;
    }
</style>
<form action="" method="post">

<div class="main">
    <div class="content">
        <div class="section group">
            <h2 class="success_order">Đặt hàng thành công</h2>
            <?php
		    $customer_id=Session::get('customer_id');
            $get_amount = $ct->getAmountPrice($customer_id);
            if($get_amount){
                $price = 0;
                while($result= $get_amount->fetch_assoc()){
                    $price += $result['Gia'];
                }
            }
            ?>
            <p>Tổng tiền sản phẩm: <?php echo $fm->format_currency($price); ?> VND </p>
            <p><a href="history_order.php">Xem đơn đặt hàng</a></p>
        
        </div>
    </div>
</div>
</form>

<?php
	include 'inc/footer.php';
?>

   