<?php if($_GET['main']){ ?>
	<form action="create_sub_nav.php?main=<?php echo $_GET['main']; ?>" method="post">
		<p>Navigation Link Name: 
			<input type='text' name='sub_link' value='' id='sub_link' class='txt_input' />
		</p>
		<p>Position:
			<?php 
				$results = get_sub_nav($_GET['main']);
				$navcount = count($results) + 1;
			?>
			<select name='position'>
				<?php if($navcount > 0){
					for($count = 1; $count < $navcount + 1; $count++){
						echo "<option value=" . $count . ">" . $count . "</option>";
					}
				}
				?>
			</select>
			
		</p>
		<p>Visible:
			<input type='radio' name='visible' value='0' /> No
			&nbsp;
			<input type='radio' name='visible' value='1' /> Yes
		</p>
		<input type='submit' name='add_sub' value='Add Navigation Link' class='btn' />
		<br /><br />
		<a href='admin_panel.php'>Cancel</a>
	</form>
<?php }else{ ?>
	<form action="edit_sub.php?sub=<?php echo $sel_sub_table['id']; ?>" method="post">
		<p>Navigation Link Name: 
			<input type='text' name='sub_link' value='<?php echo $sel_sub_table['sub_link']; ?>' id='sub_link' class='txt_input' />
		</p>
		<p>Position:
			<?php 
				$results = get_sub_nav($sel_sub_table['main_id']);
				$navcount = count($results) + 1;
			?>
			<select name='position'>
				<?php if($navcount > 0){
					for($count = 1; $count < $navcount + 1; $count++){
						echo "<option value='" . $count . "' ";
						if($count == $sel_sub_table['position']){
							echo 'selected';
						}
						echo ">" . $count . "</option>";
					}
				}
				?>
			</select>
		</p>
		<p>Visible:
			<input type='radio' name='visible' value='0' 
			<?php 
				if($sel_sub_table['visible'] == 0){
					echo 'checked ';
				}
			?>
			/> No
			&nbsp;
			<input type='radio' name='visible' value='1' 
			<?php 
				if($sel_sub_table['visible'] == 1){
					echo 'checked ';
				}
			?>
			/> Yes
		</p>
		<input type='submit' name='edit_sub' value='Edit Sub Navigation Link' class='btn' />
		<br /><br />
		<a href='admin_panel.php'>Cancel</a>
	</form>
<?php } ?>