<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //search
			$search = $_POST['search'];
			
			include("quarter_query.php");
			$sql .= " WHERE quarter_name LIKE '%{$search}%' ";
			$sql .= " ORDER BY quarter_name;";
			include("quarter_populate.php");
			
			break;
			
		case 2: //add			
			$quarter_name = $_POST['quarter_name'];
			
			if ($quarter_name){
				$sql = "INSERT INTO quarter_tbl(quarter_name, encoded_by)
						VALUES ('{$quarter_name}',{$user_id});";
					
				$save = $mysqli->query($sql);
				if ($save){
					//populate update list
					include("quarter_query.php");					
					$sql .= " ORDER BY quarter_name;";
					include("quarter_populate.php");
						
				}else{
					echo "Error: " . $mysqli->error;
				}
			}else{
				echo "Error: Grade Level name is required!";
			}
			
			break;
		
		case 3: //get quarter name
			$quarter_id = $_POST['quarter_id'];
			
			if ($quarter_id){
				$sql = "SELECT quarter_name FROM quarter_tbl WHERE quarter_id={$quarter_id}";
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
			$quarter_id = $_POST['quarter_id'];
			$quarter_id = $_POST['quarter_id'];
			$quarter_name = $_POST['quarter_name'];
			
			if ($quarter_id && $quarter_id){
				if ($quarter_name){
					$sql = "UPDATE quarter_tbl 
							SET quarter_name = '{$quarter_name}'
							WHERE quarter_id = {$quarter_id};";
					
					$update = $mysqli->query($sql);
					if ($update){
						//populate update list
						include("quarter_query.php");					
						$sql .= " ORDER BY quarter_name;";
						include("quarter_populate.php");	
						
					}else{
						echo "Error: " . $mysqli->error;
					}
				}else{
					echo "Error: Grade Level name is required!";
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;
		
		case 5: //change status
			$quarter_id = $_POST['quarter_id'];
			$quarter_id = $_POST['quarter_id'];
			$status_id = $_POST['status_id'];
			
			if ($quarter_id && $quarter_id && $status_id){
				$sql = "UPDATE quarter_tbl SET status_id={$status_id} WHERE quarter_id={$quarter_id};";
				
				$update = $mysqli->query($sql);
				if ($update){
					//populate update list
					include("quarter_query.php");					
					$sql .= " ORDER BY quarter_name;";
					include("quarter_populate.php");
					
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