<?php
	include('param.php'); 
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //get sections by gradelevel
			$gradelevel_id = $_POST['gradelevel_id'];
			
			if ($gradelevel_id){
				
				include("advisory_query.php");
				
				$sql .= " WHERE s.gradelevel_id={$gradelevel_id} ";
				$sql .= " ORDER BY g.gradelevel_name, s.section_name, f.lastname, f.firstname, f.middlename;";
				
				include("advisory_populate.php");
			}
			
			break;
			
		case 2: //add
			$gradelevel_id = $_POST['gradelevel_id'];
			$section_id = $_POST['section_id'];
			$faculty_id = $_POST['faculty_id'];
			
			if ($gradelevel_id && $section_id){
				if ($faculty_id){
					$sql = "INSERT INTO advisory_tbl(gradelevel_id, section_id, faculty_id, encoded_by)
							VALUES ({$gradelevel_id}, {$section_id}, {$faculty_id}, {$user_id});";
					
					$save = $mysqli->query($sql);
					if ($save){
						//populate update list
						include("advisory_query.php");
				
						$sql .= " WHERE s.gradelevel_id={$gradelevel_id} ";
						$sql .= " ORDER BY g.gradelevel_name, s.section_name, f.lastname, f.firstname, f.middlename;";
						
						include("advisory_populate.php");
						
					}else{
						echo "Error: " . $mysqli->error;
					}
				}else{
					echo "Error: Please select an Adviser!";
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;
		
		
		
		case 3: //update
			$advisory_id = $_POST['advisory_id'];
			$faculty_id = $_POST['faculty_id'];
			$gradelevel_id = $_POST['gradelevel_id'];
			$sql = "";
			
			if ($advisory_id){
				
				if ($faculty_id){
					$sql = "UPDATE advisory_tbl 
							SET faculty_id = {$faculty_id}, updated_by = {$user_id}
							WHERE advisory_id = {$advisory_id};";
				}else{ //No Adviser
					$sql = "DELETE FROM advisory_tbl WHERE advisory_id = {$advisory_id};";
				}	
				
				$update = $mysqli->query($sql);
					
				if ($update){
					
					//populate update list
					include("advisory_query.php");
				
					$sql .= " WHERE s.gradelevel_id={$gradelevel_id} ";
					$sql .= " ORDER BY g.gradelevel_name, s.section_name, f.lastname, f.firstname, f.middlename;";
						
					include("advisory_populate.php");
				}else{
					echo "Error: " . $mysqli->error;
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;
		
		
			
		default:
			echo "Error: Critical Error Encountered!";
	}
	
	$mysqli->close();
?>