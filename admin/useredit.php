<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/user.php';?>
 
<?php
	$us = new user();
    if(isset($_GET['user_id']) || $_GET('user_id')!=NULL){
        $id = $_GET['user_id'];
        
    }
	
    if($_SERVER['REQUEST_METHOD']=='POST'){
		$username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        $updateUser=$us->update_user($username, $name, $email, $id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
    <a href="userlist.php" style="display: flex; align-items: center;" class="iconh2">
        <i class="fas fa-arrow-left" style="margin-right: 10px; color:#ab1a27c4"></i>
        <h3>Sửa tài khoản</h3>
    </a>
        <div class="block">        
            <?php
                if(isset($updateUser)){
                    echo $updateUser;
                }
            ?>
        <?php
            $get_user = $us->getuserbyId($id);
            if($get_user){
                while($result = $get_user->fetch_assoc()){
        ?>
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td style=" padding-left : 15%;">
                        <label>Họ Tên</label>
                    </td>
                    <td>
                        <input type="text" name="name" value = "<?php echo $result['name']?>" placeholder="Nhập họ tên" class="medium" />
                    </td>  
                </tr>
                <tr>
                    <td style="padding-left : 15%;">
                        <label>Tên đăng nhập</label>
                    </td>
                    <td>
                        <input type="text" name="username" value=" <?php echo $result['username']?>" placeholder="Nhập tên đăng nhập" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td style="padding-left : 15%;">
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="email" name="email" value = "<?php echo $result['email']?>" placeholder="Nhập email" class="medium" />
                    </td>
                </tr>
                <!-- <tr>
                    <td>
                        <label>Mật khẩu</label>
                    </td>
                    <td>
                        <input type="password" name="password" placeholder="Nhập mật khẩu" class="medium" />
                    </td>
                </tr> -->
				 <tr style="aline">
                    <td>
                    
                    </td>
                    <td>
                        <div style="display: flex; justify-content: center;">
                        <input type="submit" name="submit" value="Sửa" />
                        </div>
                    </td>
                </tr>
            </table>
            </form>
            <button class="btn-huy" id="btn-huy" style="margin-right: 10px;" onclick = "window.location.href='userlist.php'">Hủy</button>

            <?php
                }
            }   
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>