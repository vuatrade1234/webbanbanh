

<?php
	include 'inc/header.php';
?>
<?php
    Session::init();
     $login_check = Session::get('customer_login');
     if($login_check==false){
       header('Location:login.php');
     }
?>
<?php
    $id = Session::get('customer_id');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
        $updateCusstomer = $cs->update_customer($_POST, $id);
    }
?>
<style>
    input[type=date], input[type=datetime-local], input[type=month], input[type=time] {
    width: 20%;
}
</style>
<br><br>
<div class="content_top">
  <div class="heading">
    <h3>Thông tin cá nhân</h3>
    <?php
        if(isset($updateCusstomer)) {
            echo $updateCusstomer;
        }
    ?>
  </div>
  <div class="clearfix"></div> <!-- Add clearfix class here -->
</div>
<div class="main">
    <div class="content">
        <div class="section group">

            <form action="profile.php" method="post">
            <table class="tblone">
                <?php
                    $id = Session::get('customer_id');

                    $get_customers = $cs->show_customers($id);
                    if($get_customers){
                        while($result = $get_customers->fetch_assoc()){
                            
                    
                ?>
                <tr style="font-size: 16px">
                    <td>Họ và tên:</td>
                    <td><input type="text" name="name" value="<?php echo $result['HoTen'] ?>"></td>
                </tr>
                <tr style="font-size: 16px">
                    <td>Username:</td>
                    <td><input type="username" name="username" value="<?php echo $result['Username'] ?>"></td>
                </tr>
                <tr style="font-size: 16px">
                    <td>Email:</td>
                    <td><input type="email" name="email" value="<?php echo $result['Email'] ?>"></td>
                </tr>
                <tr style="font-size: 16px">
                    <td>Ngày sinh:</td>
                    <td><input type="date" name="yearold" value="<?php echo $result['NgaySinh'] ?>"></td>
                </tr>
                <tr style="font-size: 16px; width: 20%">
                    <td>Số điệt thoại:</td>
                    <td><input type="number" name="phone" value="<?php echo $result['SDT'] ?>"></td>
                </tr>
                <tr style="font-size: 16px">
                    <td>Địa chỉ:</td>
                    <td><input type="text" name="address" value="<?php echo $result['DiaChi'] ?>"></td>
                </tr>
                <tr>
                    <td colspan="3" >
                            <h3><input type="submit" name="save" value="Lưu"></h3>
                    </td>
                </tr>
                <?php
                        }
                }
                ?>

            </table>
            </form>
        </div>
    </div>
</div><br><br><br>

<?php
	include 'inc/footer.php';
?>

   