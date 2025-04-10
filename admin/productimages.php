<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/product.php';
    include '../classes/brand.php';
    include '../classes/category.php';
?>
<?php
   $product = new product();
   

    if(!isset($_GET['productid'] ) || $_GET['productid']==NULL){
        echo "<script>window.lobrandion = 'productlist.php'</script>";
    }else{
        $id = $_GET['productid']; 
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $insertProduct = $product->insert_images_product($_FILES, $id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <a style="display: flex; align-items: center;" class="iconh2">
            <h3>Thêm sản phẩm mới</h3>
        </a>
        <div class="block">        
            <?php
                if(isset($insertProduct)){
                    echo $insertProduct;
                }
            ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">         
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


