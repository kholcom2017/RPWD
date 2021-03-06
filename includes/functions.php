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

	function get_services(){
		global $con;
		$query = "SELECT * FROM services";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $results;
	}

	function navigation(){
		echo '<nav class="navbar navbar-default">
		    <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
				    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				    </button>
				    <a class="navbar-brand" href="#">Rising Phoenix Web Design</a>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				    <ul class="nav navbar-nav navbar-right">';
						$main_nav = get_main_nav();
						foreach($main_nav as $main){
							$sub_nav = get_sub_nav($main['id']);
							if(count($sub_nav) > 0){
								echo '<li class="dropdown">
						          <a href="#" class="dropdown-toggle links" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $main['link'] . '<span class="caret"></span></a>
						          <ul class="dropdown-menu">';
						        foreach($sub_nav as $sub){
						        	echo "<li><a href='#' class='sub_menu'>" . $sub['sub_link'] . "</a></li>";
						        }
						        echo '</ul>
						        </li>';
							}else{
								echo "<li><a href='#' class='links'>" . $main['link'] . "</a></li>";
							}
						}
				   echo "</ul>
			    </div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>";
	}

	/*function navigation($sel_main_table, $sel_sub_table){
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
	}*/
?>