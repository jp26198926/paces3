<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //search
			$search = $_POST['search'];
			
			include("gradecategory_query.php");
			$sql .= " WHERE gradecategory_name LIKE '%{$search}%' ";
			$sql .= " ORDER BY gradecategory_name;";
			include("gradecategory_populate.php");
			
			break;
			
		case 2: //add			
			$gradecategory_name = $_POST['gradecategory_name'];
			
			if ($gradecategory_name){
				$sql = "INSERT INTO gradecategory_tbl(gradecategory_name, encoded_by)
						VALUES ('{$gradecategory_name}',{$user_id});";
					
				$save = $mysqli->query($sql);
				if ($save){
					//populate update list
					include("gradecategory_query.php");					
					$sql .= " ORDER BY gradecategory_name;";
					include("gradecategory_populate.php");
						
				}else{
					echo "Error: " . $mysqli->error;
				}
			}else{
				echo "Error: Grade Level name is required!";
			}
			
			break;
		
		case 3: //get gradecategory name
			$gradecategory_id = $_POST['gradecategory_id'];
			
			if ($gradecategory_id){
				$sql = "SELECT gradecategory_name FROM grade_category_tbl WHERE gradecategory_id={$gradecategory_id}";
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
			$gradecategory_id = $_POST['gradecategory_id'];
			$gradecategory_id = $_POST['gradecategory_id'];
			$gradecategory_name = $_POST['gradecategory_name'];
			
			if ($gradecategory_id && $gradecategory_id){
				if ($gradecategory_name){
					$sql = "UPDATE grade_category_tbl 
							SET gradecategory_name = '{$gradecategory_name}'
							WHERE gradecategory_id = {$gradecategory_id};";
					
					$update = $mysqli->query($sql);
					if ($update){
						//populate update list
						include("gradecategory_query.php");					
						$sql .= " ORDER BY gradecategory_name;";
						include("gradecategory_populate.php");	
						
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
			$gradecategory_id = $_POST['gradecategory_id'];
			$gradecategory_id = $_POST['gradecategory_id'];
			$status_id = $_POST['status_id'];
			
			if ($gradecategory_id && $gradecategory_id && $status_id){
				$sql = "UPDATE grade_category_tbl SET status_id={$status_id} WHERE gradecategory_id={$gradecategory_id};";
				
				$update = $mysqli->query($sql);
				if ($update){
					//populate update list
					include("gradecategory_query.php");					
					$sql .= " ORDER BY gradecategory_name;";
					include("gradecategory_populate.php");
					
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