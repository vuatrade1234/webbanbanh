

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

<br><br>
<div class="content_top">
  <div class="heading">
    <h3>Thông tin cá nhân</h3>
  </div>
  <div class="clearfix"></div>
</div>
<div class="main">
    <div class="content">
        <div class="section group">

            <table class="tblone">
                <?php
                    $id = Session::get('customer_id');

                    $get_customers = $cs->show_customers($id);
                    if($get_customers){
                        while($result = $get_customers->fetch_assoc()){
                            
                    
                ?>
                <tr style="font-size: 16px">
                    <td>Họ và tên:</td>
                    <td><?php echo $result['HoTen'] ?></td>
                </tr>
                <tr style="font-size: 16px">
                    <td>Username:</td>
                    <td><?php echo $result['Username'] ?></td>
                </tr>
                <tr style="font-size: 16px">
                    <td>Ngày sinh:</td>
                    <td><?php echo $result['NgaySinh'] ?></td>
                </tr>
                <tr style="font-size: 16px">
                    <td>Số điệt thoại:</td>
                    <td><?php echo $result['SDT'] ?></td>
                </tr>
                <tr style="font-size: 16px">
                    <td>Địa chỉ:</td>
                    <td><?php echo $result['DiaChi'] ?></td>
                </tr>
                <tr>
                    <td colspan="3" >
                            <h4><a href="editprofile.php" name="save" class="font-size:15px">Sửa thông tin</a></h4>
                    </td>
                </tr>
                <?php
                        }
                }
                ?>

            </table>
        </div>
    </div>
</div><br><br><br><br>
<?php
	include 'inc/footer.php';
?>

   