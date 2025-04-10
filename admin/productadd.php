<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/product.php';
    include '../classes/brand.php';
    include '../classes/category.php';
    

?>
<?php 
	$privil = new privileges();
	$regexResult=$privil->checkPrivileges();
?>
<?php
    $product = new product();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $insertProduct = $product->insert_product($_POST, $_FILES);
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
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="productname" placeholder="Nhập tên sản phẩm..." class="medium" />
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
                            <option value=" <?php echo $result['MaDM'] ?>"><?php echo $result['TenDM'] ?></option>
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
                            <option value="<?php echo $result['id'] ?>"><?php echo $result['TenTH'] ?></option>
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
                        <textarea name="productdesc" class="tinymce"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Xuất xứ</label>
                    </td>
                    <td>
                        <input type="text" name="origin" placeholder="Nhập xuất xứ..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ngày sản xuất</label>
                    </td>
                    <td>
                        <input type="date" name="dateofanufacture" placeholder="Nhập ngày sản xuất..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Khối lượng</label>
                    </td>
                    <td>
                    <input type="text" name="weight" placeholder="Nhập khối lượng..." class="medium" />

                </tr>
                <tr>
                    <td>
                        <label>Hạn sử dụng</label>
                    </td>
                    <td>
                        <input type="text" name="expiry" placeholder="Nhập HSD..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Nhập giá..." class="medium" />
                    </td>

                </tr>
                <tr>
                    <td>
                        <label>Số lượng</label>
                    </td>
                    <td>
                        <input type="text" name="quantity" placeholder="Nhập số lượng..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <option value="0">Nổi bật</option>
                            <option value="1">Không nổi bật</option>
                        </select>
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


