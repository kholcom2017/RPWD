<?php
	function check_req_fields($req_fields){
		$errors = [];
		foreach($req_fields as $field){
			if(!isset($_POST[$field]) || empty($_POST[$field])){
				$errors[] = $field;
			}
		}

		return $errors;
	}
	
	function check_length_fields($field_lengths){
		$errors = [];
		foreach($field_lengths as $field => $max){
			if(strlen(trim($_POST[$field])) > $max){
				$errors[] = $field;
			}
		}
		return $errors;
	}

	function display_errors($errors){
		echo "<p class='error'>Please correct the following fields: <br /><br />	";
		foreach ($errors as $e){
			echo " * " . $e . "<br />";
		}
		echo "</p>";
	}
?>