<?php
	include '../classes/adminlogin.php';
?>
<?php
	$class = new adminlogin();
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/";

		if (!preg_match($pattern, $password)) {
			$login_check = "<p style='color:rgb(54, 51, 218);'>Mật khẩu mới phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.</p>";
		} else {
			$password = md5($password);
			$login_check = $class->resetPassword($username, $password); 
		}
	}
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Lấy lại mật khẩu</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="form-tt">
    <section id="content">
        <form action="forgotpass.php" method="post" name="dang-ky">
            <h2>Lấy lại mật khẩu</h2>
            <span style="color:rgb(54, 51, 218);"><?php
                if(isset($login_check)){
                    echo $login_check;
                }
            ?></span>

            <input type="text" name="username" placeholder="Nhập tên đăng nhập" />
            <div class="password-container">
                <input type="password" id="password-input" name="password" placeholder="Nhập mật khẩu mới" />
                <i id="toggle-password" class="fas fa-eye"></i>
            </div>
            <input type="submit" name="submit" value="Đặt lại mật khẩu" />
            <a href="login.php" style="color:rgb(28, 102, 37);" class="psw-text">Đăng nhập</a>
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#toggle-password').click(function() {
                    $(this).toggleClass('fa-eye fa-eye-slash');
                    let input = $("#password-input");
                    if (input.attr('type') == 'password') {
                        input.attr('type', 'text');
                    } else {
                        input.attr('type', 'password');
                    }
                });
            });
        </script>
    </section>
</div>
</body>
<style>
body {
	display: flex;
    justify-content: center;
    align-items: center;
    background-image: url('../images/Kinh-doanh-tiem-banh-ngot.png'); /* Thay 'background.jpg' bằng URL của hình ảnh nền bạn muốn sử dụng */
    background-size: cover;
}
* {
margin: 0;
padding: 0;
}
.form-tt {
	width: 400px;
	border-radius: 10px;
	overflow: hidden;
	padding: 55px 55px 37px;
	background: rgba(255, 105, 180, 0.8), rgba(255, 255, 255, 0.8); /* Nền màu hồng và trắng với độ trong suốt là 0.8 */
	background: -webkit-linear-gradient(top,rgba(255, 105, 180, 0.8),rgba(255, 255, 255, 0.8));
	background: -o-linear-gradient(top,rgba(255, 105, 180, 0.8),rgba(255, 255, 255, 0.8));
	background: -moz-linear-gradient(top,rgba(255, 105, 180, 0.8),rgba(255, 255, 255, 0.8));
	background: linear-gradient(top,rgba(255, 105, 180, 0.8),rgba(255, 255, 255, 0.8));
	text-align: center;
}

.form-tt h2 {
	font-size: 30px;
	color: black;
	line-height: 1.2;
	text-align: center;
	text-transform: uppercase;
	display: block;
	margin-bottom: 30px;
}

.form-tt input[type=text], .form-tt input[type=password] {
	font-family: Poppins-Regular;
	font-size: 16px;
	color: black;
	line-height: 1.2;
	display: block;
	width: calc(100% - 10px);
	height: 45px;
	background: 0 0;
	padding-left :10px; 
	border-bottom :2px solid rgba(255,255,255,.24)!important; 
	border :0; 
	outline :0; 
}
.form-tt input[type=text]::focus, .form-tt input[type=password]::focus {
	color:red; 
}
.form-tt input[type=password] {
	margin-bottom :20px; 
}
.form-tt input::placeholder {
	color:black; 
}
.checkbox {
	display:block; 
}
.form-tt input[type=submit] {
	font-size :16px; 
	color:black; 
	line-height :1.2; 
	padding :0 20px; 
	min-width :120px; 
	height :50px; 
	border-radius :25px; 
	background :#fff; 
	position :relative; 
	z-index :1; 
	border :0; 
	outline :0; 
	display:block; 
	margin :30px auto;

}
#checkbox {
	display:inline-block; 
	margin-right :10px; 
}
.checkbox-text{
	color:black; 
}
.psw-text{
	color:black; 
}

.password-container{
	position:relative; 
	display:flex; 
	align-items:center; 

}

.password-container .fa-eye, .password-container  .fas.fa-eye-slash{
	position:absolute; 
	right:10px; 
	top:40%; 
	transform: translateY(-50%); 
	cursor:pointer; 
}

.form-tt input[type=text] {
    margin-bottom: 20px;
}
</style>


</html>



