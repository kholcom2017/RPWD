<?php
	//Main Navigation Links
	function get_main_nav(){
		global $con;
		$query = "SELECT * FROM main_nav ORDER BY position ASC";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $results;
	}

	function get_sub_nav($main_id){
		global $con;
		$query = "SELECT * FROM sub_nav WHERE main_id = :main_id ORDER BY position ASC";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':main_id', $main_id);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $results;
	}

	function get_main_by_id($main_id){
		global $con;
		$query = "SELECT * FROM main_nav WHERE id = :main_id LIMIT 1";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':main_id', $main_id);
		$stmt->execute();
		$results = $stmt->fetch(PDO::FETCH_ASSOC);

		return $results;
	}

	function get_sub_by_id($sub_id){
		global $con;
		$query = "SELECT * FROM sub_nav WHERE id = :sub_id LIMIT 1";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':sub_id', $sub_id);
		$stmt->execute();
		$results = $stmt->fetch(PDO::FETCH_ASSOC);

		return $results;
	}

	function find_selected_sub(){
		global $con;
		global $sel_main_table;
		global $sel_sub_table;

		if(isset($_GET['main'])){
			$sel_main_table = get_main_by_id($_GET['main']);
			$sel_sub_table = NULL;
		}if(isset($_GET['sub'])){
			$sel_sub_table = get_sub_by_id($_GET['sub']);
			$sel_nav_table = NULL;
		}else{
			$sel_nav_table = NULL;
			$sel_sub_table = NULL;
		}
		
	}

	function navigation($sel_main_table, $sel_sub_table){
		$output = "<ul class='main_nav'>";
		$main_nav = get_main_nav();
		foreach($main_nav as $link){
			$output .= "<li ";
			if($link['id'] == $sel_main_table['id']){
				$output .= "class='selected'";
			}
			$output .= "><a href='admin_panel.php?main=" . $link['id'] . "'>" . $link['link'] . "</a></li>";
			$sub_nav = get_sub_nav($link['id']);
			$output .= "<ul class='sub_nav'>";
			foreach($sub_nav as $sub_link){
				$output .= "<li ";
				if($sub_link['id'] == $sel_sub_table['id']){
					$output .= "class='selected'";
				}
				$output .= "><a href='admin_panel.php?sub=" . $sub_link['id'] . "''>" . $sub_link['sub_link'] . "</a></li>";
			}
			$output .= "</ul>";
		}

		$output .= "</ul>
		<br />
		<br />
		<a href='create_nav_link.php'>New Navigation Link</a>";

		return $output;
	}
?>