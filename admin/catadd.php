<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php 
	$privil = new privileges();
	$regexResult=$privil->checkPrivileges();
?>
<?php
	$cat = new category();
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$catname = $_POST['catname'];
        $insertCart = $cat->insert_category($catname); 
		
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
            <a style="display: flex; align-items: center;" class="iconh2">
                <h3>Thêm danh mục</h3>
            </a>
               <div class="block copyblock"> 
               <?php
                    if(isset($insertCart)){
                        echo $insertCart;
                    }
                ?>
                 <form action="catadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catname" placeholder="Thêm danh mục sản phẩm..." class="medium" />
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