<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/menu.php' ?>

<?php
	$men = new menu();

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Phân quyền thành viên</h2>
        <div class="block">        
			<?php if(!empty($_GET['action']) && ($_GET['action'] == "save")){
			$data = $_POST;
			// var_dump($data);
			$insertString = "";
			$del_user_pri = $men->delete_usr_privileges($data['taikhoan_id']);
			if (isset($data['taikhoan_id'])) {
				foreach($data['privileges'] as $insertPrivileges){
					$insertString .= !empty($insertString) ? "," :"";
					$insertString .= "(NULL, ".$data["taikhoan_id"].", ".$insertPrivileges.")";
				}
				$insertPrivileges = $men->insert_privileges($insertString);
				if($insertPrivileges){
					$error =  "Phân quyền không thành công";
				}else{
					$error = "";
				}
				// var_dump($insertPrivileges); 
			} else {
				echo "Không tìm thấy khóa 'taikhoan_id' trong dữ liệu POST";
			}

			?>
				<?php if(!empty($error)){ ?>
					<?php echo $error; ?>
				<?php } else { ?>
					Phân quyền thành công. <a href="userlist.php"><br/>Quay lại danh sách thành viên</a>
				<?php } ?>

			<?php }else{ ?>
			<?php 
				$show_user_pri = $men->show_usr_privileges();
			?>

			<?php 
				$resultuserpriList=array();
				$show_user_pri = $men->show_usr_privileges();
				if(!empty($show_user_pri)){
					foreach($show_user_pri as $resultuserpri){
						$resultuserpriList[]=$resultuserpri['phanquyen_id'];
						// var_dump($resultuserpri);
			?>
			<?php 
					}
				}
			?>

			<form action="?action=save" method="post" enctype="multipart/form-data">
				<div class="clear-both"></div>
				<input type="hidden" name="taikhoan_id" value="<?=$_GET['taikhoan_id']?>">

				<?php
					$show_menu = $men->show_menu();
					if($show_menu){
						while($resultmenu = $show_menu->fetch_assoc()){
					
				?>
				<div class="privileges-group">
					<h5><?php echo $resultmenu['name'] ?></h5>
					<ul class="group-name">
					<?php
					$show_pri = $men->show_privileges();
					if($show_pri){
						while($resultpri = $show_pri->fetch_assoc()){
				?>
				<?php
						if($resultpri['menu_id'] == $resultmenu['id'])
						{
					?>
						<li>
							<input type="checkbox"
							<?php if(in_array($resultpri['MaQuyen'], $resultuserpriList)) {?> 
								checked = "";
							<?php } ?>
							
							 value="<?=$resultpri['MaQuyen']?>" id="privileges_<?=$resultpri['MaQuyen']?>" name="privileges[]">
							<label for="privileges_<?=$resultpri['MaQuyen']?>"><?php echo $resultpri['TenQuyen'] ?></label>
						</li>
						<?php
							}
						?>					
						<?php
								}
							}
						?>
					</ul>
			</div>
			<div class="clear-both"></div>
			<?php
					}
				}
			?>
			
			
    	</div>
		<div class="btn-save" style="text-align: right; width: 70%; margin-top:3%">
				<input type="submit" name="submit" Value="Lưu" />
				
			</div>
		</form>
		<?php } ?>
    </div>
</div>

<?php include 'inc/footer.php';?>

