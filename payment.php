

<?php
	include 'inc/header.php';
?>
<?php
    // Session::init();
    //  $login_check = Session::get('customer_login');
    //  if($login_check==false){
    //    header('Location:login.php');
    //  }
?>
<style>
    h3.payment{
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        text-decoration: underline;
    }
    a.payment_href{
        text-align: center;
        font-size: 17px;
        font-weight: bold;
    }
    div.wrapper_method{
        text-align: center;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
            <a href="cart.php"><i style="font-size: 20px; color: black" class="fa fa-arrow-left"></i> </a>
                <div class="card-header text-center">
                    <h3 class="payment">
                        Phương thức thanh toán
                    </h3>
                </div>
                <div class="card-body">
                    <div class="wrapper_method">
                        <h4 class="payment">Chọn phương thức thanh toán</h4>
                        <a class="btn btn-primary btn-block payment_href" href="offlinepayment.php">Thanh toán khi nhận hàng</a>
                        <a class="btn btn-primary btn-block payment_href" href="onlinepayment.php?congthanhtoan=vnpay">Thanh toán qua thẻ ngân hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

   