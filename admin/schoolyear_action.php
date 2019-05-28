<?php
	session_start();
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //search
			$search = $_POST['search'];
			
			include("schoolyear_query.php");
			$sql .= " WHERE CONCAT(schoolyear_start,' ',schoolyear_end,' ',IF(status_id=1,'Active','Inactive')) LIKE '%{$search}%' ";
			$sql .= " ORDER BY schoolyear_start, schoolyear_end;";
			include("schoolyear_populate.php");
			
			break;
			
		case 2: //add			
			$schoolyear_start = $_POST['schoolyear_start'];
			$schoolyear_end = $_POST['schoolyear_end'];
			
			if ($schoolyear_start && $schoolyear_end){
				$sql = "INSERT INTO schoolyear_tbl(schoolyear_start, schoolyear_end)
						VALUES ('{$schoolyear_start}','{$schoolyear_end}');";
					
				$save = $mysqli->query($sql);
				if ($save){
					//populate update list
					include("schoolyear_query.php");					
					$sql .= " ORDER BY schoolyear_start, schoolyear_end;";
					include("schoolyear_populate.php");
						
				}else{
					echo "Error: " . $mysqli->error;
				}
			}else{
				echo "Error: Schoolyear is required!";
			}
			
			break;
		
		case 3: //get schoolyear details
			$schoolyear_id = $_POST['schoolyear_id'];
			
			if ($schoolyear_id){
				$sql = "SELECT schoolyear_start, schoolyear_end FROM schoolyear_tbl WHERE schoolyear_id={$schoolyear_id}";
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
			$schoolyear_id = $_POST['schoolyear_id'];			
			$schoolyear_start = $_POST['schoolyear_start'];
			$schoolyear_end = $_POST['schoolyear_end'];
			
			if ($schoolyear_id){
				if ($schoolyear_start && $schoolyear_end){
					$sql = "UPDATE schoolyear_tbl 
							SET schoolyear_start = '{$schoolyear_start}',
								schoolyear_end = '{$schoolyear_end}'
							WHERE schoolyear_id = {$schoolyear_id};";
					
					$update = $mysqli->query($sql);
					if ($update){
						//populate update list
						include("schoolyear_query.php");					
						$sql .= " ORDER BY schoolyear_start, schoolyear_end;";
						include("schoolyear_populate.php");	
						
					}else{
						echo "Error: " . $mysqli->error;
					}
				}else{
					echo "Error: schoolyear name is required!";
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;
		
		case 5: //change status
			$schoolyear_id = $_POST['schoolyear_id'];			
			$status_id = $_POST['status_id'];
			
			if ($schoolyear_id && $schoolyear_id && $status_id){
				$sql = "UPDATE schoolyear_tbl SET status_id={$status_id} WHERE schoolyear_id={$schoolyear_id};";
				
				$update = $mysqli->query($sql);
				if ($update){
					//populate update list
					include("schoolyear_query.php");					
					$sql .= " ORDER BY schoolyear_name;";
					include("schoolyear_populate.php");
					
				}else{
					echo "Error: " . $mysqli->error;
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;

		case 6: //set active
			$schoolyear_id = $_POST['schoolyear_id'];			
						
			if ($schoolyear_id){
				$sql = "UPDATE schoolyear_tbl SET status_id=1 WHERE status_id=2;";
				
				$reset = $mysqli->query($sql);
				if ($reset){

					//update
					$sql = "UPDATE schoolyear_tbl SET status_id=2 WHERE schoolyear_id={$schoolyear_id};";
				
					$update = $mysqli->query($sql);
					if ($update){
						//populate update list
						include("schoolyear_query.php");					
						$sql .= " ORDER BY schoolyear_start, schoolyear_end;";
						include("schoolyear_populate.php");
					
				}else{
					echo "Error: " . $mysqli->error;
				}
					
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