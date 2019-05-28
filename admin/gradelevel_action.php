<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //search
			$search = $_POST['search'];
			
			include("gradelevel_query.php");
			$sql .= " WHERE gradelevel_name LIKE '%{$search}%' ";
			$sql .= " ORDER BY gradelevel_name;";
			include("gradelevel_populate.php");
			
			break;
			
		case 2: //add			
			$gradelevel_name = $_POST['gradelevel_name'];
			
			if ($gradelevel_name){
				$sql = "INSERT INTO gradelevel_tbl(gradelevel_name, encoded_by)
						VALUES ('{$gradelevel_name}',{$user_id});";
					
				$save = $mysqli->query($sql);
				if ($save){
					//populate update list
					include("gradelevel_query.php");					
					$sql .= " ORDER BY gradelevel_name;";
					include("gradelevel_populate.php");
						
				}else{
					echo "Error: " . $mysqli->error;
				}
			}else{
				echo "Error: Grade Level name is required!";
			}
			
			break;
		
		case 3: //get gradelevel name
			$gradelevel_id = $_POST['gradelevel_id'];
			
			if ($gradelevel_id){
				$sql = "SELECT gradelevel_name FROM gradelevel_tbl WHERE gradelevel_id={$gradelevel_id}";
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
			$gradelevel_id = $_POST['gradelevel_id'];
			$gradelevel_name = $_POST['gradelevel_name'];
			
			if ($gradelevel_id && $gradelevel_id){
				if ($gradelevel_name){
					$sql = "UPDATE gradelevel_tbl 
							SET gradelevel_name = '{$gradelevel_name}'
							WHERE gradelevel_id = {$gradelevel_id};";
					
					$update = $mysqli->query($sql);
					if ($update){
						//populate update list
						include("gradelevel_query.php");					
						$sql .= " ORDER BY gradelevel_name;";
						include("gradelevel_populate.php");	
						
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
			$gradelevel_id = $_POST['gradelevel_id'];
			$gradelevel_id = $_POST['gradelevel_id'];
			$status_id = $_POST['status_id'];
			
			if ($gradelevel_id && $gradelevel_id && $status_id){
				$sql = "UPDATE gradelevel_tbl SET status_id={$status_id} WHERE gradelevel_id={$gradelevel_id};";
				
				$update = $mysqli->query($sql);
				if ($update){
					//populate update list
					include("gradelevel_query.php");					
					$sql .= " ORDER BY gradelevel_name;";
					include("gradelevel_populate.php");
					
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