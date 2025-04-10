
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
include ($filepath.'/../lib/sesion.php');
$db = new Database();

if(isset($_POST['index'])){
    $index = $_POST['index'];
    $product_id = $_POST['product_id'];
    $customer_id = $_POST['customer_id'];
    $query = "INSERT INTO danhgiasao(sosao, MaSP, MaKH) VALUES ('$index', '$product_id', '$customer_id')";
    $result = $db->insert($query);
}
?>