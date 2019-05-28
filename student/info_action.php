<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
				
		case 1: //info
			$student_id = intval($student_id);
			
			if ($student_id > 0){
				
				$sql = "SELECT  * FROM student_tbl s WHERE student_id={$student_id};";
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
		
		case 2: //update
			$student_id = intval($student_id);
			
			if ($student_id){
				$lrn = $_POST["lrn"];
				$sy = intval($_POST["sy"]);
				$gradelevel = intval($_POST["gradelevel"]);
				$firstname = $_POST["firstname"];
				$lastname = $_POST["lastname"];
				$middlename = $_POST["middlename"];
				$extname = $_POST["extname"];
				$gender = $_POST["gender"];
				$birthday = $_POST["birthday"];
				$birthplace = $_POST["birthplace"];
				$address = $_POST["address"];
				$last_school_attended = $_POST["last_school_attended"];
				$grade_completed = intval($_POST["grade_completed"]);
				$general_average = floatval($_POST["general_average"]);
				$guardians_name = $_POST["guardians_name"];
				$guardians_contact = $_POST["guardians_contact"];
				$fathers_name = $_POST["fathers_name"];
				$fathers_occupation = $_POST["fathers_occupation"];
				$fathers_contact = $_POST["fathers_contact"];
				$fathers_religion = $_POST["fathers_religion"];
				$mothers_mname = $_POST["mothers_mname"];
				$mothers_occupation = $_POST["mothers_occupation"];
				$mothers_contact = $_POST["mothers_contact"];
				$mothers_religion = $_POST["mothers_religion"];
				
				if ($sy && $gradelevel && $firstname && $lastname && $middlename){
					$sql = "UPDATE student_tbl SET
													lrn_no = '{$lrn}',
													schoolyear_id = {$sy},
													gradelevel_id = {$gradelevel},
													firstname = '{$firstname}',
													lastname = '{$lastname}',
													middlename = '{$middlename}',
													extname = '{$extname}',
													gender = {$gender},
													birthdate = '{$birthday}',
													birthplace = '{$birthplace}',
													address = '{$address}',
													last_school = '{$last_school_attended}',
													grade_completed = {$grade_completed},
													gen_average = {$general_average},
													guardians_name = '{$guardians_name}',
													guardians_contact = '{$guardians_contact}',
													fathers_name = '{$fathers_name}',
													fathers_occupation = '{$fathers_occupation}',
													fathers_contact = '{$fathers_contact}',
													fathers_religion = '{$fathers_religion}',
													mothers_mname = '{$mothers_mname}',
													mothers_occupation = '{$mothers_occupation}',
													mothers_contact = '{$mothers_contact}',
													mothers_religion = '{$mothers_religion}'
							WHERE student_id={$student_id};";
					
					$save = $mysqli->query($sql);
					if ($save){
						include("enrolled_query.php");
			
						$sql .= " WHERE s.student_id={$student_id}  AND s.status_id = 4 ";
						$sql .= " ORDER BY s.lastname, s.firstname, s.middlename, s.extname;";
						
						include("enrolled_populate_row.php");
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