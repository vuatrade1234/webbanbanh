 <?php
	include_once 'inc/header.php'
?>
<?php
	$cs = new customer();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/";

	if (!preg_match($pattern, $password)) {
		$login_check = "<p style='color:rgb(54, 51, 218);'>Mật khẩu mới phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.</p>";
	} else {
		$password = md5($password);
		$login_check = $cs->resetPassword_customer($email, $password); 
	}
}
?>
 <style>
   .background-image {
      background-image: url('https://chiaki.vn/upload/news/content/2021/08/thuong-hieu-my-pham-han-quoc-innisfree-jpg-1629689166-23082021102606.jpg');
      background-size: contain;
      background-position: center;
    }


    #radius-shape-1 {
      height: 220px;
      width: 220px;
      top: -60px;
      left: -130px;
      background: radial-gradient(#44006b, #ad1fff);
      overflow: hidden;
    }

    #radius-shape-2 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -60px;
      right: -110px;
      width: 300px;
      height: 300px;
      background: radial-gradient(#44006b, #ad1fff);
      overflow: hidden;
    }

    .bg-glass {
      background-color: hsla(0, 0%, 100%, 0.9) !important;
      backdrop-filter: saturate(200%) blur(25px);
    }
	.form-outline {
      position: relative;
    }

    .form-outline input:not(:placeholder-shown) ~ label,
    .form-outline input:focus ~ label {
	top: -20px;
    font-size: 1.7rem;
      color: #495057;
    }

    .form-outline label {
      position: absolute;
      top: 0;
      left: 0;
      pointer-events: none;
      transition: 0.2s ease all;
    }
	.form-control {
    font-size: 16px;
    	margin-top: 2%;
    	margin-bottom: 12%;
	}
	.bg-glass {
		padding-top: 14%;
		padding-bottom: 14%;
	}
	.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
	background: linear-gradient(to top, #237823, #fff); 
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 1.25rem;
    width: 79%;
	}
	h3{
		font-size: 1.9rem;
	}
  </style>
<section class="background-image">
  <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center mb-5">
		<div class="col-lg-6 mb-5 mb-lg-0"  style="z-index: 10; background: rgb(5 5 5 / 71%);">
      <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(0deg 0% 99.38%);">
          HOME MADE CAKE <br />
          <span style="color: hsl(218, 81%, 75%)">Thank you !</span>
        </h1>
        <p class="mb-4 opacity-70" style="color: hsl(0deg 0% 99.38%);; text-align: justify; font-size: 16px">
        Chào mừng bạn đến với trang web bán bánh hàng đầu của chúng tôi! Chúng tôi tự hào cung cấp một loạt các sản phẩm bánh chất lượng cao từ các thương hiệu uy tín trên toàn thế giới. <br>

        Đây là một sự kết hợp ngon ngọt hài hòa giữa hương vị caramen đậm đà và hương vị đắng của cà phê, tạo ra một trải nghiệm thưởng thức độc đáo và sảng khoái. Với lớp kem mịn màng và một chút gia vị hạt cà phê trên trên cùng, bánh này chắc chắn sẽ làm say lòng bất kỳ ai đang tìm kiếm một trải nghiệm mới mẻ và đầy đặn. Hãy đến và thử ngay hôm nay!
        <br>
        Chúng tôi cam kết mang đến cho bạn những sản phẩm tốt nhất, với giá cả cạnh tranh và dịch vụ khách hàng tận tâm. Hãy khám phá trang web của chúng tôi và tìm kiếm sản phẩm hoàn hảo cho bạn ngay hôm nay! 
        <br>
        Chúng tôi rất mong được phục vụ bạn.
        </p>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

        <div class="card bg-glass">
		<h3>Lấy lại mật khẩu</h3>
		<?php
			if(isset($login_check)){
				echo $login_check;
			}
		?>
          <div class="card-body px-4 py-5 px-md-5">
            <form action="" method="POST">
              <div class="form-outline mb-4">
                <input type="email" name="email" id="email" class="form-control"/>
				
                <label class="form-label" for="form3Example3">Email</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" name="password" id="password" class="form-control" oninput="checkPassword()" />
                <label class="form-label" for="form3Example4">Password</label>
				<i class="fas fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 10px; cursor: pointer;"></i>
					<p id="message"></p>
              </div>
			  
				<input class="grey" type="submit" value="Đặt lại mật khẩu" name="login"></input>              
            </form>
          </div>
		  <div>
			<a href="login.php" style="font-size: 17px; color:#d30eda">Đăng nhập</a>

			</div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
    function checkPassword() {
        var password = document.getElementById("password").value;
        var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
        if (regex.test(password)) {
            document.getElementById("message").style.color = "green";
            document.getElementById("message").style.fontSize = "15px";
            document.getElementById("message").innerHTML = "Mật khẩu hợp lệ";
        } else {
            document.getElementById("message").style.color = "red";
            document.getElementById("message").style.fontSize = "15px";
            document.getElementById("message").innerHTML = "Mật khẩu không hợp lệ. Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, ký tự đặc biệt và số.";
        }
    }
	var togglePassword = document.getElementById("togglePassword");
    var password = document.getElementById("password");

    togglePassword.addEventListener("click", function() {
        if (password.type === "password") {
            password.type = "text";
            togglePassword.classList.remove("fa-eye");
            togglePassword.classList.add("fa-eye-slash");
        } else {
            password.type = "password";
            togglePassword.classList.remove("fa-eye-slash");
            togglePassword.classList.add("fa-eye");
        }
    });
</script>
<?php
	// include_once 'inc/footer.php'
?>
