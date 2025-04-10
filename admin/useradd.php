
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/user.php';?>

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

<div class="grid_10">
    <div class="box round first grid">
    <a style="display: flex; align-items: center;" class="iconh2">
        <h3>Thêm người dùng mới</h3>
    </a>
        <div class="block">        
            <?php
                if(isset($insertUser)){
                    echo $insertUser;
                }
            ?>
         <form action="useradd.php" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Họ Tên</label>
                    </td>
                    <td>
                        <input type="text" name="name" placeholder="Nhập họ tên" class="medium" />
                    </td>  
                </tr>
                <tr>
                    <td>
                        <label>Tên đăng nhập</label>
                    </td>
                    <td>
                        <input type="text" name="username" placeholder="Nhập tên đăng nhập" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="email" name="email" placeholder="Nhập email" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Mật khẩu</label>
                    </td>
                    <td>
                        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" class="medium" oninput="validatePassword()" />
                        <p id="message"></p>
                    </td>
                </tr>
				 <tr>
                    <td></td>
                    <td style="aline">
                        <center><input type="submit" name="submit" Value="Thêm" /></center>
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<script>
function validatePassword() {
    var password = document.getElementById("password").value;
    var message = document.getElementById("message");
    var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/gm;
    if (regex.test(password)) {
        message.style.color = "green";
        message.innerHTML = "Mật khẩu hợp lệ";
    } else {
        message.style.color = "red";
        message.innerHTML = "Mật khẩu phải có ít nhất 8 kí tự bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt";
    }
}
</script>
<?php include 'inc/footer.php';?>