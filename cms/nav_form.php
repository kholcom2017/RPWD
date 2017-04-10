<?php if(!$_GET){?>
	<form action="create_nav_link.php" method="post">
		<p>Navigation Link Name: 
			<input type='text' name='nav_link' value='' id='nav_link' class='txt_input' />
		</p>
		<p>Position:
			<?php 
				$results = get_main_nav();
				$navcount = count($results);
			?>
			<select name='position'>
				<?php if($navcount > 0){
					for($count = 1; $count < $navcount + 2; $count++){
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
		<input type='submit' name='add_nav' value='Add Navigation Link' class='btn' />
		<br /><br />
		<a href='admin_panel.php'>Cancel</a>
	</form>
<?php }else{ ?>
	<form action="edit_main.php?main=<?php echo $sel_main_table['id']; ?>" method="post">
		<p>Navigation Link Name: 
			<input type='text' name='nav_link' value='<?php echo $sel_main_table['link']; ?>' id='nav_link' class='txt_input' />
		</p>
		<p>Position:
			<?php 
				$results = get_main_nav();
				$navcount = count($results);
			?>
			<select name='position'>
				<?php if($navcount > 0){
					for($count = 1; $count < $navcount + 2; $count++){
						echo "<option value='" . $count . "' ";
						if($count == $sel_main_table['position']){
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
				if($sel_main_table['visible'] == 0){
					echo 'checked ';
				}
			?>
			/> No
			&nbsp;
			<input type='radio' name='visible' value='1' 
			<?php 
				if($sel_main_table['visible'] == 1){
					echo 'checked ';
				}
			?>
			/> Yes
		</p>
		<input type='submit' name='edit_nav' value='Edit Navigation Link' class='btn' />
		<br /><br />
		<a href='admin_panel.php'>Cancel</a>
	</form>
<?php } ?>