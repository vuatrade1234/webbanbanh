<?php
//code thanh toan vnpay
date_default_timezone_set('Asia/Ho_Chi_Minh');

$vnp_TmnCode = "PP1CM5WJ"; //Replace with your Terminal Id
$vnp_HashSecret = "AUAOEZDXLQXYALVMDFJZWQHZBAOLZSBN"; //Replace with your Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/webmypham/onlinepayment.php";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
// $vnp_apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

$vnp_TxnReft =time();
$vnp_OrderInfo = 'Thanh toán đơn hàng vnpay';
$vnp_OrderType = 'other';
$vnp_Amount = $_POST['total_congthanhtoan']*100;
$vnp_Locale = 'vn';
$vnp_BankCode = 'NCB';
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

$inputData = array(
    'vnp_Version' => '2.1.0',
    'vnp_TmnCode' => $vnp_TmnCode,
    'vnp_Amount' => $vnp_Amount,
    'vnp_Command' => 'pay',
    'vnp_CreateDate' => date('YmdHis'),
    'vnp_CurrCode' => 'VND',
    'vnp_IpAddr' => $vnp_IpAddr,
    'vnp_Locale' => $vnp_Locale,
    'vnp_OrderInfo' => $vnp_OrderInfo,
    'vnp_OrderType' => $vnp_OrderType,
    'vnp_ReturnUrl' => $vnp_Returnurl,
    'vnp_TxnRef' => $vnp_TxnReft

);


if(isset($vnp_BankCode) && $vnp_BankCode!= ""){
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}

ksort($inputData);
$query = "";
$i = 0;
$hashdata="";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}
$returnData = array('code' => '00', 'message' => 'success', 'data' => $vnp_Url);
if(isset($_POST['redirect'])){
    header('Location: ' . $vnp_Url);
    die();
}else{
    echo json_encode($returnData);
}
?>

<!-- http://localhost/webmypham/onlinepayment.php?
vnp_Amount=25000000&
vnp_BankCode=NCB&
vnp_BankTranNo=VNP14181677&
vnp_CardType=ATM&
vnp_OrderInfo=Thanh+to%C3%A1n+%C4%91%C6%A1n+h%C3%A0ng+vnpay&vnp_PayDate=20231115144742&vnp_ResponseCode=00&vnp_TmnCode=PP1CM5WJ&vnp_TransactionNo=14181677&vnp_TransactionStatus=00&vnp_TxnRef=1700034377&vnp_SecureHash=ad22956c43f32e879694841244f080aaf15004bc530aec0874860566aec8e025a60ea149d8c80bdedf7fc515fc4805591b685f6f022622f7507a4e683d9b53cb -->
