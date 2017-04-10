<?php require_once('includes/connect.php'); ?>
<?php require_once('includes/functions.php'); ?>
<?php find_selected_sub(); ?>
<?php include('includes/form_functions.php'); ?>
<?php
	if(isset($_POST['edit_sub'])){
		//Form Validation
		$errors = [];
		$required_fields = ['sub_link', 'position', 'visible'];
		$errors = array_merge($errors, check_req_fields($required_fields, $_POST));

		$fields_with_lengths = ['sub_link' => 30];
		$errors = array_merge($errors, check_length_fields($fields_with_lengths, $_POST));

		$id = $_GET['sub'];
		$sub_link = $_POST['sub_link'];
		$position = $_POST['position'];
		$visible = $_POST['visible'];


		if(empty($errors)){
			$query = "UPDATE sub_nav SET 
			sub_link = :sub_link,
			position = :position,
			visible = :visible
			WHERE 
			id = :id";

			$stmt = $con->prepare($query);
			$stmt->bindParam(':sub_link', $sub_link);
			$stmt->bindParam(':position', $position);
			$stmt->bindParam(':visible', $visible);
			$stmt->bindParam(':id', $id);
			$results = $stmt->execute();
			if($results){
				$message = "Sub Link Edited Successfully.";
				header("Location: admin_panel.php?sub={$id}");
			}else{
				$message = "Sub Link did not update.";
			}
		}else{
			$message = "There were " . count($errors) . " too many errors in the form.";
		}
	}

?>
<?php include('includes/header.php'); ?>
<div class='container-fluid'>
	<div class='row'>
		<!-- Main Content -->
		<div class='col-md-10' style='float:right; padding:1em 3em;' id='main'>
			<h2>Edit: <?php echo $sel_sub_table['sub_link']; ?> </h2>
			<!-- Form for creating a new navigation link -->
			<!-- Required information will be the name of the link, the position it is to appear in the order and if it is visible to everyone -->
			<?php include('sub_nav_form.php'); ?>
		</div>
		<div class='col-md-2' id='nav'>
			<?php echo navigation($sel_main_table, $sel_sub_table); ?>
		</div>
	</div>
</div>
<?php include('includes/footer.php'); ?>