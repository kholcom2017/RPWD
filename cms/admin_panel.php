<?php require_once('includes/connect.php'); ?>
<?php require_once('includes/functions.php'); ?>
<?php find_selected_sub(); ?>
<?php include('includes/header.php'); ?>
<div class='container-fluid' id='content'>
	<div class='row'>
		<div class='col-md-10' style='float:right;' id='main'>
			<?php
				if(!is_null($sel_main_table)){
					echo "<h2>" . $sel_main_table['link'] . "</h2>";
					echo "<p class='create'><a href='edit_main.php?main=" . $sel_main_table['id'] . "'>Edit Link</a> &nbsp; &nbsp; <a href='delete_main.php?main=" . $sel_main_table['id'] . "onClick='return confirm('Do you really want to do this?')>Delete Link</p>";
					echo "<hr/>";
					
					$sub_nav = get_sub_nav($sel_main_table['id']);
					if(count($sub_nav) > 0){
						echo "<h5 style='text-decoration:underline;'>Sub Navigation</h5>";
						echo "<ul class='sub_nav'>";
						foreach($sub_nav as $sub_link){
							echo "<li><a href='admin_panel.php?sub=" . $sub_link['id'] . "''>" . $sub_link['sub_link'] . "</a></li>";
						}
					}
					echo "</ul><br />";
					echo "<p class='create'><a href='create_sub_nav.php?main=" . $sel_main_table['id'] . "'>Create a Sub Link</a></p>";
				}else if(!is_null($sel_sub_table)){
					echo "<h2>" . $sel_sub_table['sub_link'] . "</h2>";
					echo "<p class='create'><a href='edit_sub.php?sub=" . $sel_sub_table['id'] . "'>Edit Link</a> &nbsp; &nbsp; <a href='delete_sub.php?sub=" . $sel_sub_table['id'] . "onClick='return confirm('Do you really want to do this?')>Delete Link</p>";
					echo "<hr/>";
					
				}else{
					echo "<h2>Welcome to Rising Phoenix Web Design</h2><br />";

					echo "<p>This is the section where you can maintain your site without outside help. <br/>Choose one of the links to the left to change information.</p>";
				}
				?>
		</div>
		<div class='col-md-2' style='float:right;' id='nav'>
			<?php echo navigation($sel_main_table, $sel_sub_table); ?>
	</div>
</div>
<?php include('includes/footer.php'); ?>