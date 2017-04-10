<?php require_once('includes/connect.php'); ?>
<?php require_once('includes/functions.php'); ?>
<?php find_selected_sub(); ?>
<?php include('includes/form_functions.php'); ?>
<?php include('includes/header.php'); ?>
<?php
//Form Validation
if(isset($_POST['edit_nav'])){
	$errors = [];

	$required_fields = ['nav_link', 'position', 'visible'];
	$errors = array_merge($errors, check_req_fields($required_fields));

	$fields_with_lengths = ['nav_link' => 30];
	$errors = array_merge($errors, check_length_fields($fields_with_lengths));

	if(empty($errors)){
		$id = $_GET['main'];
		$nav_link = $_POST['nav_link'];
		$position = $_POST['position'];
		$visible = $_POST['visible'];

		$query = "UPDATE main_nav SET
			link = :nav_link,
			position = :position,
			visible = :visible WHERE 
			id = :id";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':nav_link', $nav_link);
		$stmt->bindParam(':position', $position);
		$stmt->bindParam(':visible', $visible);
		$stmt->bindParam(':id', $id);
		if($stmt->execute()){
			header("Location:admin_panel.php?main={$id}");
			exit;
		}else{
			echo "<p>Navigation Link Creation Failed.</p>";
		}
	}
}
?>
<div class='container-fluid'>
	<div class='row'>
		<!-- Main Content -->
		<div class='col-md-10' style='float:right; padding:1em 3em;' id='main'>
			<h2>Edit: <?php echo $sel_main_table['link']; ?> </h2>
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