<?php require_once('includes/connect.php'); ?>
<?php require_once('includes/functions.php'); ?>
<?php require_once('includes/form_functions.php'); ?>
<?php 
//Form Validation for Editing Navigation Links
if(intval($_GET['sub']) == 0){
	header('Location:admin_panel.php');
	exit;
}
$id = $_GET['sub'];
if($nav = get_sub_by_id($id)){
	$query = "DELETE FROM sub_nav WHERE id = :id LIMIT 1";
	$stmt = $con->prepare($query);
	$stmt->bindParam(':id', $id);
	$result = $stmt->execute();
	if(count($result) == 1){
		header('Location: admin_panel.php');
		exit;
	}else{
		echo "Information was not deleted successfully.";
		echo "<br /><a href='admin_panel.php'>Return to our Main Page</a>";
	}
}else{
	header('Location: admin_panel.php');
	exit;
}
?>