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
        echo "<script>window.location = 'productlist.php'</script>";
    }else{
        $id = $_GET['productid'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $updateProduct = $product->update_product($_POST, $_FILES, $id);
        }
?>
<style>
    .sale-wrapper {
    display: flex;
    align-items: center;
}

.sale-wrapper p,
.sale-wrapper select {
    margin: 0 5px 0 0;
}
</style>
<div class="grid_10">
    <div class="box round first grid">
        <a href="productlist.php" style="display: flex; align-items: center;" class="iconh2">
            <i class="fas fa-arrow-left" style="margin-right: 10px; color:#ab1a27c4"></i>
            <h3>Cập nhật sản phẩm</h3>
        </a>
        <div class="block">        
            <?php
                if(isset($updateProduct)){
                    echo $updateProduct;
                }
            ?>
        <?php
            $get_product_by_id =  $product->getproductbyId($id);
                if($get_product_by_id){
                    while ($resultpro = $get_product_by_id->fetch_assoc()) {

        ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">					
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="productname" value="<?php echo $resultpro['TenSP']?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Danh mục sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Chọn danh mục</option>
                            <?php
                                $cat = new category();
                                $catlist = $cat->show_category();

                                if($catlist){
                                    while($result = $catlist->fetch_assoc()){
                                       
                                
                            ?>
                            <option 
                            <?php
                                if($result['MaDM']==$resultpro['MaDM']){
                                    echo 'selected';
                                }
                            ?>
                            value=" <?php echo $result['MaDM'] ?>"><?php echo $result['TenDM'] ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Thương hiệu sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>Chọn thương hiệu</option>

                            <?php
                                $brand = new brand();
                                $brandlist = $brand->show_brand();
                                if($brandlist){
                                    while($result = $brandlist->fetch_assoc()){
                            ?>
                            <option 
                            <?php
                                if($result['id']==$resultpro['MaTH']){
                                    echo 'selected';
                                }
                            ?>
                            value="<?php echo $result['id'] ?>"><?php echo $result['TenTH'] ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px; width: 30%">
                        <label>Mô tả</label>
                    </td>
                    <td>
                        <textarea name="productdesc"  class="tinymce"> <?php echo $resultpro['MoTa'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Xuất xứ</label>
                    </td>
                    <td>
                        <input type="text" name="origin" value = "<?php echo $resultpro['XuatXu']?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ngày sản xuất</label>
                    </td>
                    <td>
                        <input type="date" name="dateofanufacture" value = "<?php echo $resultpro['NgaySX']?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Khối lượng</label>
                    </td>
                    <td>
                    <input type="text" name="weight" value = "<?php echo $resultpro['KhoiLuong']?>" class="medium" />

                </tr>
                <tr>
                    <td>
                        <label>Hạn sử dụng</label>
                    </td>
                    <td>
                        <input type="text" name="expiry" value = "<?php echo $resultpro['HanSD']?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $resultpro['Gia']; ?>" class="medium" />
                        <div class="sale-wrapper">
                            <p for="">Sale</p>
                            <select id="salePrice" name="salePrice">
                                <?php
                                $currentSale = $resultpro['GiaSale']; // Giá trị sale hiện tại của sản phẩm
                                $saleOptions = [0, 10, 20, 30]; // Các lựa chọn sale
                                foreach ($saleOptions as $option) {
                                    $selected = ($option == $currentSale) ? 'selected' : ''; // Kiểm tra lựa chọn hiện tại
                                    echo "<option value='$option' $selected>$option%</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Số lượng</label>
                    </td>
                    <td>
                        <input type="text" name="quantity"value = "<?php echo $resultpro['SoLuong']?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $resultpro['hinhanh'] ?>" width="50" alt="">
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option value="0" <?php if($resultpro['Type']==0) echo 'selected'; ?>>Nổi bật</option>
                            <option value="1" <?php if($resultpro['Type']==1) echo 'selected'; ?>>Không nổi bật</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Cập nhật" />
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

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });

</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


