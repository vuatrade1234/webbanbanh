<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php 
	$privil = new privileges();
	$regexResult=$privil->checkPrivileges();
?>
<?php
	$cat = new category();
    if(!isset($_GET['catid'] ) || $_GET['catid']==NULL){
        echo "<script>window.location = 'catlist.php'</script>";
    }else{
        $id = $_GET['catid'];
        
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catname = $_POST['catname'];
        $update_cat = $cat->update_category($catname, $id);
    }
    
?>

        <div class="grid_10">
            <div class="box round first grid">
            <a href="catlist.php" style="display: flex; align-items: center;" class="iconh2">
                <i class="fas fa-arrow-left" style="margin-right: 10px; color:#ab1a27c4"></i>
                <h3s>Sửa danh mục</h3s>
            </a>
               <div class="block copyblock"> 
               <?php
                    if(isset($update_cat)){
                        echo $update_cat;
                    }
                ?>
                <?php
                    $get_cat_name = $cat->getcatbyId($id);
                    if($get_cat_name){
                        while($result = $get_cat_name->fetch_assoc()){
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['TenDM'] ?>" name="catname" placeholder="Thêm danh mục sản phẩm..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Sửa" />
                            </td>
                        </tr>
                    </table>
                </form>
                <button class="btn-huy" id="btn-huy" style="margin-right: 10px;" onclick = "window.location.href='catlist.php'">Hủy</button>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>