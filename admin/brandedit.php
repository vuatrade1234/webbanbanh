<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php
	$brand = new brand();
    if(!isset($_GET['brandid'] ) || $_GET['brandid']==NULL){
        echo "<script>window.lobrandion = 'brandlist.php'</script>";
    }else{
        $id = $_GET['brandid'];
        
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $brandname = $_POST['brandname'];
        $update_brand = $brand->update_brand($brandname, $id);
    }
    
?>

        <div class="grid_10">
            <div class="box round first grid">
            <a href="brandlist.php" style="display: flex; align-items: center;" class="iconh2">
                <i class="fas fa-arrow-left" style="margin-right: 10px; color:#ab1a27c4"></i>
                <h3>Sửa thương hiệu</h3>
            </a>

               <div class="block copyblock"> 
               <?php
                    if(isset($update_brand)){
                        echo $update_brand;
                    }
                ?>
                <?php
                    $get_brand_name = $brand->getbrandbyId($id);
                    if($get_brand_name){
                        while($result = $get_brand_name->fetch_assoc()){
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['TenTH'] ?>" name="brandname" placeholder="Thêm thương hiệu sản phẩm..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Sửa" />
                            </td>
                        </tr>
                    </table>
                </form>

                <?php
                        }
                    }   
                ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>