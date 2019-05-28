<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //search
			$search = $_POST['search'];
			
			include("grade_percentage_query.php");
			$sql .= " WHERE CONCAT_WS(' ', s.subject_name, g.gradecategory_name) LIKE '%{$search}%' ";
			$sql .= " ORDER BY s.subject_name, g.gradecategory_id;";
			include("grade_percentage_populate.php");
			
			break;
			
		case 2: //add			
			$subject_id = $_POST['subject_id'];
			$grade_category_id = $_POST['category_id'];
			$percent_value = $_POST['percent_value'];

			
			if ($subject_id && $grade_category_id && $percent_value){
				$sql = "INSERT INTO grade_category_percentage_tbl(subject_id, grade_category_id, percent_value)
						VALUES ({$subject_id},{$category_id},{$percent_value});";
					
				$save = $mysqli->query($sql);
				if ($save){
					//populate update list
					include("grade_percentage_query.php");					
					$sql .= " ORDER BY s.subject_name, g.gradecategory_id;";
					include("grade_percentage_populate.php");
						
				}else{
					echo "Error: " . $mysqli->error;
				}
			}else{
				echo "Error: All fields are required!";
			}
			
			break;
		
		case 3: //get grade_percentage name
			$grade_percentage_id = $_POST['grade_percentage_id'];
			
			if ($grade_percentage_id){
				$sql = "SELECT * FROM grade_category_percentage_tbl WHERE grade_percentage_id={$grade_percentage_id}";
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
			$grade_percentage_id = $_POST['grade_percentage_id'];
			$subject_id = $_POST['subject_id'];
			$grade_category_id = $_POST['category_id'];
			$percent_value = $_POST['percent_value'];
			
			if ($grade_percentage_id){
				if ($subject_id && $grade_category_id && $percent_value){
					$sql = "UPDATE grade_category_percentage_tbl 
							SET subject_id = {$subject_id},
								grade_category_id = {$grade_category_id},
								percent_value = {$percent_value}
							WHERE grade_percentage_id = {$grade_percentage_id};";
					
					$update = $mysqli->query($sql);
					if ($update){
						//populate update list
						include("grade_percentage_query.php");					
						$sql .= " ORDER BY s.subject_name, g.gradecategory_id;";
						include("grade_percentage_populate.php");
						
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