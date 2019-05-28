<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //get subjects by gradelevel
			$gradelevel_id = $_POST['gradelevel_id'];
			
			if ($gradelevel_id){
				
				include("subject_query.php");
				
				$sql .= " WHERE gradelevel_id={$gradelevel_id} ";
				$sql .= " ORDER BY subject_name;";
				
				include("subject_populate.php");
			}
			
			break;
			
		case 2: //add
			$gradelevel_id = $_POST['gradelevel_id'];
			$subject_name = $_POST['subject_name'];
			
			if ($gradelevel_id){
				if ($subject_name){
					$sql = "INSERT INTO subject_tbl(gradelevel_id, subject_name, encoded_by)
							VALUES ({$gradelevel_id}, '{$subject_name}', {$user_id});";
					
					$save = $mysqli->query($sql);
					if ($save){
						//populate update list
						include("subject_query.php");
				
						$sql .= " WHERE gradelevel_id={$gradelevel_id} ";
						$sql .= " ORDER BY subject_name;";
				
						include("subject_populate.php");
						
					}else{
						echo "Error: " . $mysqli->error;
					}
				}else{
					echo "Error: Subject name is required!";
				}
			}else{
				echo "Error: Please select Grade Level first!";
			}
			break;
		
		case 3: //get subject name
			$subject_id = $_POST['subject_id'];
			
			if ($subject_id){
				$sql = "SELECT subject_name FROM subject_tbl WHERE subject_id={$subject_id}";
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
			$subject_id = $_POST['subject_id'];
			$subject_name = $_POST['subject_name'];
			
			if ($gradelevel_id && $subject_id){
				if ($subject_name){
					$sql = "UPDATE subject_tbl 
							SET subject_name = '{$subject_name}'
							WHERE subject_id = {$subject_id};";
					
					$update = $mysqli->query($sql);
					if ($update){
						//populate update list
						include("subject_query.php");
				
						$sql .= " WHERE gradelevel_id={$gradelevel_id} ";
						$sql .= " ORDER BY subject_name;";
				
						include("subject_populate.php");
						
					}else{
						echo "Error: " . $mysqli->error;
					}
				}else{
					echo "Error: Subject name is required!";
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;
		
		case 5: //change status
			$gradelevel_id = $_POST['gradelevel_id'];
			$subject_id = $_POST['subject_id'];
			$status_id = $_POST['status_id'];
			
			if ($gradelevel_id && $subject_id && $status_id){
				$sql = "UPDATE subject_tbl SET status_id={$status_id} WHERE subject_id={$subject_id};";
				
				$update = $mysqli->query($sql);
				if ($update){
					//populate update list
					include("subject_query.php");
				
					$sql .= " WHERE gradelevel_id={$gradelevel_id} ";
					$sql .= " ORDER BY subject_name;";
				
					include("subject_populate.php");
						
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