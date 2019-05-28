<?php	
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //search
			$search = $_POST['search'];
			
			include("offence_query.php");
			$sql .= " WHERE CONCAT_WS(' ', s.lrn_no, s.lastname, s.firstname, s.middlename, o.incident_date, o.incident_type, o.`description`, o.`comments`) LIKE '%{$search}%' ";
			$sql .= " ORDER BY o.incident_date, s.lastname, s.firstname, s.middlename;";
			include("offence_populate.php");
			
			break;
			
		
		case 3: //get offence info
			$offence_id = $_POST['offence_id'];
			
			if ($offence_id){
				$sql = "SELECT * FROM offence_tbl
						WHERE offence_id={$offence_id}";
						
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
			$offence_id = $_POST['offence_id'];
			$incident_date = $_POST['incident_date'];
			$incident_type = $_POST['incident_type'];
			$description = $_POST['description'];
			$comments = $_POST['comments'];
			
			if ($offence_id){
				if ($incident_date){
					$sql = "UPDATE offence_tbl SET incident_date = '{$incident_date}', 
												   incident_type = '{$incident_type}', 
												   `description` = '{$description}', 
												   `comments` = '{$comments}'
							WHERE offence_id = {$offence_id};";
					
					$save = $mysqli->query($sql);
					if ($save){
						//update list
						include("offence_query.php");
						$sql .= " WHERE o.offence_id = {$offence_id} ";
						$sql .= " ORDER BY o.incident_date, s.lastname, s.firstname, s.middlename;";
						include("offence_populate_row.php");
					
					}else{
						echo "Error: " . $mysqli->error;
					}
				}else{
					echo "Error: Date is required!";
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			
			break;
		
		case 5: //change status
			$offence_id = $_POST['offence_id'];			
			$status_id = $_POST['status_id'];
			
			if ($offence_id && $status_id){
				$sql = "UPDATE offence_tbl SET status_id={$status_id} WHERE offence_id={$offence_id};";
				
				$update = $mysqli->query($sql);
				if ($update){
					
					//update list
					include("offence_query.php");
					$sql .= " WHERE o.offence_id = {$offence_id} ";
					$sql .= " ORDER BY o.incident_date, s.lastname, s.firstname, s.middlename;";
					include("offence_populate_row.php");  
					
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