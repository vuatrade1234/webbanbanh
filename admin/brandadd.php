<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php
	$brand = new brand();
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$brandname = $_POST['brandname'];
        $insertBrand = $brand->insert_brand($brandname); 
		
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
            <a style="display: flex; align-items: center;" class="iconh2">
                <h3>Thêm thương hiệu mới</h3>
            </a>
               <div class="block copyblock"> 
               <?php
                    if(isset($insertBrand)){
                        echo $insertBrand;
                    }
                ?>
                 <form action="brandadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandname" placeholder="Thêm thương hiệu sản phẩm..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Thêm" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>