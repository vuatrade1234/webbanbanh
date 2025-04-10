<?php 
    include '../classes/privileges.php';
    $privil = new privileges();
    $regexResult=$privil->checkPrivileges();
?>
<div class="grid_2">
    <div class="box sidemenu">
        <div class="block" id="section-menu">
            <ul class="section_menu">
               <li> <a class="menu_item">
                        <span style="display: flex; align-items: center;">
                        <i class="bi bi-person"></i>
                        <span>Người dùng</span>
                        <i class="bi bi-chevron-down" style="margin-left: 5%;"></i>
                        </span>
                    </a>
                    <ul class="submenu">
                        <?php
                           if($privil->checkPrivileges('userlist.php')){
                        ?>
                        <li><a href="userlist.php"><i class="bi bi-list"></i> Danh sách</a></li>
                        <?php
                           }
                        ?>
                       <?php
                           if($privil->checkPrivileges('useradd.php')){
                        ?>
                            <li><a href="useradd.php"><i class="bi bi-person-plus"></i> Thêm người dùng mới</a></li>  
                       <?php
                           }
                       ?>                     
                    </ul>
                </li>
                <li>
                 <a class="menu_item">
                        <span style="display: flex; align-items: center;">
                        <i class="bi bi-tags"></i>
                        <span>Danh mục sản phẩm</span>
                        <i class="bi bi-chevron-down" style="margin-left: 5%;"></i>
                        </span>
                    </a>
                    <ul class="submenu">
                        <?php
                           if($privil->checkPrivileges('catlist.php')){
                        ?>
                        <li><a href="catlist.php"><i class="bi bi-list"></i> Danh sách danh mục</a></li>
                        <?php
                           }
                        ?>
                        <?php
                           if($privil->checkPrivileges('catadd.php')){
                        ?>
                        <li><a href="catadd.php"><i class="bi bi-plus-square"></i> Thêm danh mục mới</a></li>
                        <?php
                           }
                        ?>
                    </ul>
                </li>
                <li>
                 <a class="menu_item">
                        <span style="display: flex; align-items: center;">
                        <i class="bi bi-bookmark"></i>
                        <span>Thương hiệu sản phẩm</span>
                        <i class="bi bi-chevron-down" style="margin-left: 5%;"></i>
                        </span>
                    </a>
                    <ul class="submenu">
                        <?php
                           if($privil->checkPrivileges('brandlist.php')){
                        ?>
                        <li><a href="brandlist.php"><i class="bi bi-list"></i> Danh sách thương hiệu</a></li>
                        <?php
                           }
                        ?>
                        <?php
                           if($privil->checkPrivileges('brandadd.php')){
                        ?>
                        <li><a href="brandadd.php"><i class="bi bi-plus-square"></i> Thêm thương hiệu mới</a></li>
                        <?php
                           }
                        ?>
                    </ul>
                </li>
				<li>
                    <a class="menu_item">
                        <span style="display: flex; align-items: center;">
                        <i class="bi bi-box"></i>
                        <span>Sản phẩm</span>
                        <i class="bi bi-chevron-down" style="margin-left: 5%;"></i>
                        </span>
                    </a>
                    <ul class="submenu">
                        <?php
                           if($privil->checkPrivileges('productlist.php')){                        
                        ?>
                        <li><a href="productlist.php"><i class="bi bi-list"></i> Danh sách sản phẩm</a> </li>
                        <?php
                            }
                        ?>
                        <?php
                           if($privil->checkPrivileges('productadd.php')){
                        ?>
                        <li><a href="productadd.php"><i class="bi bi-plus-square"></i> Thêm sản phẩm mới</a> </li>
                        <?php
                           }
                        ?>
                    </ul>
                </li>
                <?php
                    if($privil->checkPrivileges('inbox.php')){
                ?>
                <li>
                <a href="inbox.php">
                    <i class="fas fa-inbox"></i> Đơn hàng
                </a>
                </li>
                <?php
                    }
                ?>
                 <?php
                    if($privil->checkPrivileges('dashboard.php')){
                ?>
                <li>
                    <a href="dashboard.php">
                        <i class="fa fa-chart-pie"></i> Thống kê
                    </a>
                </li>
                <?php
                    }
                ?>
                <!-- <li>
                <a href="customer.php">
                    <i class="fas fa-user"></i> Tài khoản khách hàng
                </a>
                </li> -->
                <?php
                    if($privil->checkPrivileges('comment.php')){
                ?>
                <li>
                <a href="comment.php">
                    <i class="fas fa-comment"></i> Bình luận
                </a>
                </li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</div>
<style>
    .selected {
        background-color: ; /* Change this to the color you want */
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
    $('.menu_item').click(function(){
        $('.menu_item').removeClass('selected');
        $(this).addClass('selected');
        $(this).next('.submenu').slideToggle();
        $(this).find('.bi-chevron-down, .bi-chevron-up').toggleClass('bi-chevron-down bi-chevron-up');
    });
});
</script>