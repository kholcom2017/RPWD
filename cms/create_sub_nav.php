<?php require_once('includes/connect.php'); ?>
<?php require_once('includes/functions.php'); ?>
<?php find_selected_sub(); ?>
<?php include('includes/header.php'); ?>
<?php
//Form Validation
if(isset($_POST['add_sub'])){
	$errors = [];

	if(empty($errors)){
		$sub_link = $_POST['sub_link'];
		$position = $_POST['position'];
		$visible = $_POST['visible'];
		$main_id = $_GET['main'];

		$query = "INSERT INTO sub_nav
			(sub_link, position, visible, main_id)
			VALUES 
			(:sub_link, :position, :visible, :main_id)";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':sub_link', $sub_link);
		$stmt->bindParam(':position', $position);
		$stmt->bindParam(':visible', $visible);
		$stmt->bindParam(':main_id', $main_id);
		if($stmt->execute()){
			header('Location:admin_panel.php');
			exit;
		}else{
			echo "<p>Navigation Link Creation Failed.</p>";
			$pdoerrors = $stmt->errorInfo();
			foreach($pdoerrors as $e){
				echo "<p>" . $e . "</p>";
			}
		}
	}
}
?>
<div class='container-fluid'>
	<div class='row'>
		<!-- Main Content -->
		<div class='col-md-10' style='float:right; padding:1em 3em;' id='main'>
			<h2>Create A Sub Navigation Link</h2>
			<!-- Form for creating a new navigation link -->
			<!-- Required information will be the name of the link, the position it is to appear in the order and if it is visible to everyone -->
			<?php include('sub_nav_form.php'); ?>
		</div>
		<div class='col-md-2' id='nav'>
			<ul class='main_nav'>
			<?php
				$main_nav = get_main_nav();
				foreach($main_nav as $link){
					echo "<li ";
					if($link['id'] == $sel_main_table['id']){
						echo "class='selected'";
					}
					echo "><a href='admin_panel.php?nav=" . $link['id'] . "'>" . $link['link'] . "</a></li>";
					$sub_nav = get_sub_nav($link['id']);
					echo "<ul class='sub_nav'>";
					foreach($sub_nav as $sub_link){
						echo "<li ";
						if($sub_link['id'] == $sel_sub_table['id']){
							echo "class='selected'";
						}
						echo "><a href='admin_panel.php?sub=" . $sub_link['id'] . "''>" . $sub_link['sub_link'] . "</a></li>";
					}
					echo "</ul>";
				}
			?>
			</ul>
		</div>
	</div>
</div>
<?php include('includes/footer.php'); ?>