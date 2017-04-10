<?php require_once('includes/connect.php'); ?>
<?php require_once('includes/functions.php'); ?>
<?php find_selected_sub(); ?>
<?php include('includes/header.php'); ?>
<?php
//Form Validation
if(isset($_POST['add_nav'])){
	$errors = [];

	if(empty($errors)){
		$nav_link = $_POST['nav_link'];
		$position = $_POST['position'];
		$visible = $_POST['visible'];

		$query = "INSERT INTO main_nav
			(link, position, visible)
			VALUES 
			(:nav_link, :position, :visible)";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':nav_link', $nav_link);
		$stmt->bindParam(':position', $position);
		$stmt->bindParam(':visible', $visible);
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
			<h2>Create A New Navigation Link</h2>
			<!-- Form for creating a new navigation link -->
			<!-- Required information will be the name of the link, the position it is to appear in the order and if it is visible to everyone -->
			<?php include('nav_form.php'); ?>
		</div>
		<div class='col-md-2' id='nav'>
			<?php echo navigation($sel_main_table, $sel_sub_table); ?>
		</div>
	</div>
</div>
<?php include('includes/footer.php'); ?>