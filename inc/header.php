<?php
    include 'lib/session.php';
    Session::init();
?>
<?php
	include_once 'lib/database.php';
	include_once 'helpers/format.php';

	spl_autoload_register(function($className)
	{
		include_once "classes/".$className.".php";

	});
	$db = new Database();
	$fm = new Format();
	$cs = new customer();
	$product = new product();
	$cat = new category();
	$brand = new brand();
	$ct = new cart();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?><!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.min.css" />
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>

<style>
  .header_top {
    background-color: pink; /* Change header background color to pink */
  }
  
</style>

</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo"
				<a href="index.php" style="display: flex; align-items: center; font-size: 25px; font-family: ui-sans-serif; font-weight: 800; color:#163f18bf;"><img style="width:30%" src="images\logo2.jpg" alt="" />HOME MADE CAKE </a>
				
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="post">
				    	<input type="text" placeholder="Tìm kiếm sản phẩm" name="tukhoa">	<input type="submit" name="search_product" value="Tìm Kiếm">
				    </form>
			    </div>
				
			    <div class="shopping_cart">
				<a href="cart.php" title="View my shopping cart">
					<img src="images/shopping-online.png" alt="">
					<span class="num_items">
						<?php
							$customer_id = Session::get('customer_id');
							$check_cart = $ct->check_cart($customer_id);
							if($check_cart){
								$qty_cart = Session::get("qty");
								echo $qty_cart;
							}else{
								echo 0;
							}
						?>
					</span>
				</a>
			</div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li style="float:right;">
	  <?php
			if(isset($_GET['customer_id'])){
				Session::destroy();
			}
			// var_dump($_SESSION);
	  ?>
	  <?php
	  $login_check = Session::get('customer_login');
		if($login_check == false){
			echo ' <a href="login.php">Đăng nhập</a> ';
		}
		else{
			echo '<a href="?customer_id='.Session::get('customer_id').'">Đăng xuất</a>';
			
		}
		?>
	</li>
	<li style="font-size: 15px; font-family: Times New Roman"><a href="#">DANH MỤC</a>
	<?php
	$getproductbycat = $cat->show_category_all();
		if ($getproductbycat) {
			?>
			<ul>
				<?php
				while ($result = $getproductbycat->fetch_assoc()) {
					$categoryId = $result['MaDM'];
					$categoryName = $result['TenDM'];
				?>
					<li>
						<a style=" font-family: Arial, sans-serif;" href="productbycat.php?catid=<?php echo $categoryId; ?>"><?php echo $categoryName; ?></a>
					</li>
				<?php
				}
				?>
			</ul>
	<?php
	}
	?>
	</li>
	<li><a href="contact.php">LIÊN HỆ</a> </li>
	  
	<?php
	  $login_check = Session::get('customer_login');
		if($login_check==false){
			echo '';
		}else{
			echo '<li><a href="profile.php">Thông tin cá nhân</a></li>';
			echo '<li><a href="history_order.php">Lịch sử đơn hàng</a></li>';
		}
	?>
	<?php
		$customer_id = Session::get('customer_id');
	  	$login_check = $ct->check_order($customer_id);
		if($login_check==false){
			echo '<li><a href="wishlist.php">Sản phẩm yêu thích</a></li>';
		}else{
			echo '<li><a href="wishlist.php">Sản phẩm yêu thích</a></li>';
		}
	?>
	  <div class="clear"></div>
	</ul>
</div>