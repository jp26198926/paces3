<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //get sections by gradelevel
			$gradelevel_id = $_POST['gradelevel_id'];
			
			if ($gradelevel_id){
				
				include("section_query.php");
				
				$sql .= " WHERE gradelevel_id={$gradelevel_id} ";
				$sql .= " ORDER BY section_name;";
				
				include("section_populate.php");
			}
			
			break;
			
		case 2: //add
			$gradelevel_id = $_POST['gradelevel_id'];
			$section_name = $_POST['section_name'];
			
			if ($gradelevel_id){
				if ($section_name){
					$sql = "INSERT INTO section_tbl(gradelevel_id, section_name, encoded_by)
							VALUES ({$gradelevel_id}, '{$section_name}', {$user_id});";
					
					$save = $mysqli->query($sql);
					if ($save){
						//populate update list
						include("section_query.php");
				
						$sql .= " WHERE gradelevel_id={$gradelevel_id} ";
						$sql .= " ORDER BY section_name;";
				
						include("section_populate.php");
						
					}else{
						echo "Error: " . $mysqli->error;
					}
				}else{
					echo "Error: Section name is required!";
				}
			}else{
				echo "Error: Please select Grade Level first!";
			}
			break;
		
		case 3: //get section name
			$section_id = $_POST['section_id'];
			
			if ($section_id){
				$sql = "SELECT section_name FROM section_tbl WHERE section_id={$section_id}";
				$pop = $mysqli->query($sql);
				if ($pop){
					$data = $pop->fetch_assoc();
					echo json_encode($data);
				}else{
					echo "Error: " . $mysqli->error;
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;
		
		case 4: //update
			$gradelevel_id = $_POST['gradelevel_id'];
			$section_id = $_POST['section_id'];
			$section_name = $_POST['section_name'];
			
			if ($gradelevel_id && $section_id){
				if ($section_name){
					$sql = "UPDATE section_tbl 
							SET section_name = '{$section_name}'
							WHERE section_id = {$section_id};";
					
					$update = $mysqli->query($sql);
					if ($update){
						//populate update list
						include("section_query.php");
				
						$sql .= " WHERE gradelevel_id={$gradelevel_id} ";
						$sql .= " ORDER BY section_name;";
				
						include("section_populate.php");
						
					}else{
						echo "Error: " . $mysqli->error;
					}
				}else{
					echo "Error: Section name is required!";
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;
		
		case 5: //change status
			$gradelevel_id = $_POST['gradelevel_id'];
			$section_id = $_POST['section_id'];
			$status_id = $_POST['status_id'];
			
			if ($gradelevel_id && $section_id && $status_id){
				$sql = "UPDATE section_tbl SET status_id={$status_id} WHERE section_id={$section_id};";
				
				$update = $mysqli->query($sql);
				if ($update){
					//populate update list
					include("section_query.php");
				
					$sql .= " WHERE gradelevel_id={$gradelevel_id} ";
					$sql .= " ORDER BY section_name;";
				
					include("section_populate.php");
						
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