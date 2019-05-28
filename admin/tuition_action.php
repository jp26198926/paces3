<?php
	session_start();
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //search
			$search = $_POST['search'];
			
			include("tuition_query.php");
			$sql .= " WHERE CONCAT_WS(' ',t.tuition_fee,t.general_fee,t.auxiliary_fee,t.other_fee, s.schoolyear_start,s.schoolyear_end,g.gradelevel_name) LIKE '%{$search}%' ";
			$sql .= " ORDER BY s.schoolyear_start, s.schoolyear_end, g.gradelevel_name;";
			include("tuition_populate.php");
			
			break;
			
		case 2: //add			
			$schoolyear_id = $_POST['schoolyear_id'];
			$gradelevel_id = $_POST['gradelevel_id'];
			$tuition_fee = $_POST['tuition_fee'];
			$general_fee = $_POST['general_fee'];
			$auxiliary_fee = $_POST['auxiliary_fee'];
			$other_fee = $_POST['other_fee'];
			
			if ($schoolyear_id && $gradelevel_id){
				$sql = "INSERT INTO tuition_tbl(schoolyear_id, gradelevel_id, tuition_fee, general_fee, auxiliary_fee, other_fee)
						VALUES ({$schoolyear_id}, {$gradelevel_id}, {$tuition_fee}, {$general_fee}, {$auxiliary_fee}, {$other_fee});";
					
				$save = $mysqli->query($sql);
				if ($save){
					//populate update list
					include("tuition_query.php");					
					$sql .= " ORDER BY s.schoolyear_start, s.schoolyear_end, g.gradelevel_name;";
					include("tuition_populate.php");
						
				}else{
					echo "Error: " . $mysqli->error;
				}
			}else{
				echo "Error: Schoolyear is required!";
			}
			
			break;
		
		case 3: //get tuition details
			$id = $_POST['tuition_id'];
			
			if ($id){
				$sql = "SELECT * FROM tuition_tbl WHERE id={$id}";
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
			$tuition_id = $_POST['tuition_id'];			
			$schoolyear_id = $_POST['schoolyear_id'];
			$gradelevel_id = $_POST['gradelevel_id'];
			$tuition_fee = $_POST['tuition_fee'];
			$general_fee = $_POST['general_fee'];
			$auxiliary_fee = $_POST['auxiliary_fee'];
			$other_fee = $_POST['other_fee'];
			
			if ($tuition_id){
				if ($schoolyear_id && $gradelevel_id){
					$sql = "UPDATE tuition_tbl 
							SET schoolyear_id={$schoolyear_id}, gradelevel_id={$gradelevel_id},
								tuition_fee={$tuition_fee}, general_fee={$general_fee}, 
								auxiliary_fee={$auxiliary_fee}, other_fee={$other_fee}
							WHERE id = {$tuition_id};";
					
					$update = $mysqli->query($sql);
					if ($update){
						//populate update list
						include("tuition_query.php");					
						$sql .= " ORDER BY s.schoolyear_start, s.schoolyear_end, g.gradelevel_name;";
						include("tuition_populate.php");
						
					}else{
						echo "Error: " . $mysqli->error;
					}
				}else{
					echo "Error: All fields are required!";
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