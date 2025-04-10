<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
    $db = new Database();
    $id = $_POST['id'];
    $cart_status = $_POST['cart_status'];
    var_dump($_POST);


        $query = "UPDATE giohang SET tinhtrang = '$cart_status' WHERE MaGH = '$id'";
        $result = $db->update($query);
        if($result){
            echo 'Cập nhật công';
        }else{
            echo 'Cập nhật không thành công';
        }
    
?>