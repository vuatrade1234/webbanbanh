<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/user.php';?>

<?php 
   $privil = new privileges();
   $regexResult=$privil->checkPrivileges();
?>
<?php
	$us = new user();
	if($_SERVER['REQUEST_METHOD']=='POST'){
        $name = $_POST['name'];
		$username = $_POST['username'];
        $email = $_POST['email'];
		$password = md5($_POST['password']);
        $insertUser = $us->insert_user( $username, $password, $name, $email); 
	}
?>

<?php
   if(isset($_GET['del_id'])){
       $id = $_GET['del_id'];
       $delUser=$us->delete_user($id);
   }	
?>

<div class="grid_10">
   <div class="box round first grid">
   <a style="display: flex; align-items: center;" class="iconh2">
        <h3>Danh sách tài khoản</h3>
    </a>
      <div class="block">
         <?php
            if(isset($delUser)){
               echo $delUser;
            }
         ?>
         <table class="data display datatable" id="example">
            <thead>
               <tr >
                  <th>STT</th>
                  <th>Họ tên</th>
                  <th>Email</th>
                  <th>Tên đăng nhập</th>
                  <th>Mật khẩu</th>
                  <?php
                     if($privil->checkPrivileges('privilegesuser.php?taikhoan_id=1')){
                  ?>
                  
                  <?php
                     }
                  ?>
                  <?php
                      if($privil->checkPrivileges('useredit.php?user_id=0')){
                  ?>
                  <th>Sửa</th>
                  <?php
                     }
                  ?>
                  <?php
                     if($privil->checkPrivileges('?del_id=0')){
                  ?>
                  <th>Xoá</th>
                  <?php
                     }
                  ?>
               </tr>
            </thead>
            <tbody>
               <?php
                  $show_user = $us->show_user();
                  if($show_user){
                  	$i=0;
                  	while($result = $show_user->fetch_assoc()){
                  		$i++;
                  
               ?>
               <tr class="odd gradeX">
                  <td>
                     <center><?php echo $i?></center>
                  </td>
                  <td>
                     <center><?php echo $result['name']?></center>
                  </td>
                  <td>
                     <center><?php echo $result['email']?></center>
                  </td>
                  <td>
                     <center><?php echo $result['username']?></center>
                  </td>
                  <td>
                     <center><?php echo $result['password']?></center>
                  </td>
                  <?php
                     if($privil->checkPrivileges('privilegesuser.php?taikhoan_id=' . $result['adminId'])){
                  ?>
                  
                  <?php
                     }
                  ?>
                  <?php
                     if($privil->checkPrivileges('useredit.php?user_id=' . $result['adminId'])){
                  ?>
                  <td>
                     <center><a href="useredit.php?user_id=<?php echo $result['adminId']?>"><i class="fa fa-edit"></i></a> </center>
                  </td>
                  <?php
                     }
                  ?>
                   <?php
                     if($privil->checkPrivileges('?del_id=' . $result['adminId'])){
                  ?>
                  <td>
                        <center><a onclick = "return confirm('Bạn có chắc muốn xoá')" href="?del_id=<?php echo $result['adminId']?>"><i class="fa fa-trash  "></i></a></center>
                  </td>
                  <?php
                     }
                  ?>
               </tr>
               <?php
                     }
                  }
                  ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<?php include 'inc/footer.php';?>