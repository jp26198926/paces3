<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
				
		case 1: //security info
			$student_id = intval($student_id);
			
			if ($student_id > 0){
				
				$sql = "SELECT  answer1, answer2 FROM student_tbl s WHERE student_id={$student_id};";
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
		
		case 2: //save
			$student_id = intval($student_id);
			
			if ($student_id){
				$answer1 = $_POST['answer1'];
				$answer2 = $_POST['answer2'];
				
				if ($answer1 && $answer2){
					$sql = "UPDATE student_tbl SET
													answer1='{$answer1}', answer2='{$answer2}'
							WHERE student_id={$student_id};";
					
					$save = $mysqli->query($sql);
					if ($save){
						
					}else{
						echo "Error: " . $mysqli->error;
					}
					
				}else{
					echo "Error: Firstname, Lastname, Middlename, SY and Grade Level are required field!";
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