<?php
	include_once 'inc/header.php'
?>

<?php
	// $cs = new customer();
	// if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
	// 	$insertCustomers = $cs->insert_customer($_POST);
	// }
?>
<?php

$cs = new customer();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $insertCustomers = $cs->insert_customer($_POST);

    if ($insertCustomers == "<span class='error'>Username hoặc email đã tồn tại</span>") {
        $_SESSION['message'] = $insertCustomers;
    } else if ($insertCustomers) {
        header('Location: login.php');
        exit;
    } 
}
?>


<section class="background-image">
<style>
    .background-image {
      background-image: url('images/Kinh-doanh-tiem-banh-ngot.png');
      background-size: contain;
      background-position: center;
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
    	margin-top: 2%;
    	margin-bottom: 12%;
      padding: 1.5rem 1rem;
      font-size: 1.35rem;
	}
	/* .bg-glass {
		padding-top: 8%;
		padding-bottom: 8%;
	} */
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
	padding-top: 23px;
  font-size: 1.9rem;
}
  </style>

  <div class="container px-3 py-4 px-md-4 text-center text-lg-start my-5">
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
			<h3>Đăng ký</h3>
			<?php
			if (isset($_SESSION['message'])) {
				echo $_SESSION['message']; // Hiển thị thông báo
				unset($_SESSION['message']); // Xóa thông báo khỏi phiên
			}
			// Mã HTML của trang đăng ký ở đây
			?>
          <div class="card-body px-4 py-5 px-md-5">
            <form action="" method="POST">
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" name="name" id="form3Example1" class="form-control" />
                    <label class="form-label" for="form3Example1">Họ tên</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="date" name="yearold" id="form3Example2" class="form-control" />
                    <label class="form-label" for="form3Example2">Ngày sinh</label>
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" name="address" id="form3Example1" class="form-control" />
                    <label class="form-label" for="form3Example1">Địa chỉ</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="number" name="phone" id="form3Example2" class="form-control" />
                    <label class="form-label" for="form3Example2">Số điện thoại</label>
                  </div>
                </div>
              </div>
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" class="form-control" />
                <label class="form-label" >Email</label>
              </div>

             <!-- username input -->
              <div class="form-outline mb-4">
                <input type="text" name="username" id="form3Example3" class="form-control" />
                <label class="form-label" for="form3Example3">Username</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" id="password" class="form-control" oninput="checkPassword()"/>
				        <i class="fas fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 10px; cursor: pointer;"></i>
				        <p id="message"></p>
                <label class="form-label" for="form3Example4">Password</label>
              </div>

			  <input type="submit" name="submit" class="grey" value="Đăng ký" ></input>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block --> 
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

