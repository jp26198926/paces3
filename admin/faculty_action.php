<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //search
			$my_search = $_POST['search'];
						
			include("faculty_query.php");
			$sql .= " WHERE CONCAT_WS(' ',f.lastname,f.firstname,f.middlename,
										f.designation, f.birthday, f.contact_no, f.prc_license,
										g.gender, s.status
									) LIKE '%{$my_search}%' ";
			$sql .= " ORDER BY f.lastname, f.firstname, f.middlename;";
			include("faculty_populate.php");
						
			break;
			
		case 2: //add			
			$lastname = $_POST['lastname'];
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$gender_id = intval($_POST['gender_id']);
			$birthday = $_POST['birthday'];
			$designation = $_POST['designation'];
			$contact_no = $_POST['contact_no'];
			$emergency_person = $_POST['emergency_person'];
			$emergency_contact = $_POST['emergency_contact'];
			$prc = $_POST['prc'];
			$address = $_POST['address'];
			$sss = $_POST['sss'];
			$tin = $_POST['tin'];
			$philhealth = $_POST['philhealth'];
			$pagibig = $_POST['pagibig'];
			
			if ($lastname && $firstname){
				
				$sql = "INSERT INTO faculty_tbl(
													lastname, firstname, middlename, gender_id, birthday, designation,
													contact_no, emergency_person, emergency_contact, prc_license,
													address, sss_no, tin_no, ph_no, pagibig_no, encoded_by
												)
						VALUES ('{$lastname}', '{$firstname}', '{$middlename}', {$gender_id},
								'{$birthday}', '{$designation}', '{$contact_no}',
								'{$emergency_person}', '{$emergency_contact}', '{$prc}',
								'{$address}', '{$sss}', '{$tin}', '{$philhealth}', '{$pagibig}',{$user_id});";
					
					$save = $mysqli->query($sql);
					if ($save){
						//populate update list
						$faculty_id = $mysqli->insert_id;
						
						include("faculty_query.php");
						$sql .= " WHERE f.faculty_id = {$faculty_id} ";
						$sql .= " ORDER BY f.lastname, f.firstname, f.middlename;";
						include("faculty_populate.php");
						
					}else{
						echo "Error: " . $mysqli->error;
					}
				
			}else{
				echo "Error: Fields with red asterisk are required!";
			}
			break;
		
		case 3: //get faculty info
			$faculty_id = $_POST['faculty_id'];
			
			if ($faculty_id){
				$sql = "SELECT f.*, s.status FROM faculty_tbl f 
						LEFT JOIN faculty_status s ON s.status_id = f.status_id 
						WHERE f.faculty_id={$faculty_id};";
						
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
			$faculty_id = $_POST['faculty_id'];
			$lastname = $_POST['lastname'];
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$gender_id = intval($_POST['gender_id']);
			$birthday = $_POST['birthday'];
			$designation = $_POST['designation'];
			$contact_no = $_POST['contact_no'];
			$emergency_person = $_POST['emergency_person'];
			$emergency_contact = $_POST['emergency_contact'];
			$prc = $_POST['prc'];
			$address = $_POST['address'];
			$sss = $_POST['sss'];
			$tin = $_POST['tin'];
			$philhealth = $_POST['philhealth'];
			$pagibig = $_POST['pagibig'];
			
			if ($lastname && $firstname){
				
				$sql = "UPDATE faculty_tbl
						SET 
							lastname='{$lastname}', firstname='{$firstname}', middlename='{$middlename}', 
							gender_id={$gender_id}, birthday='{$birthday}', designation='{$designation}',
							contact_no='{$contact_no}', emergency_person='{$emergency_person}', 
							emergency_contact='{$emergency_contact}', prc_license='{$prc}',
							address='{$address}', sss_no='{$sss}', tin_no='{$tin}', ph_no='{$philhealth}', pagibig_no='{$pagibig}',
							updated_by={$user_id}
						WHERE faculty_id={$faculty_id};";
					
					$save = $mysqli->query($sql);
					if ($save){
						//populate update list						
						include("faculty_query.php");
						$sql .= " WHERE f.faculty_id = {$faculty_id} ";
						$sql .= " ORDER BY f.lastname, f.firstname, f.middlename;";
						include("faculty_populate.php");
						
					}else{
						echo "Error: " . $mysqli->error;
					}				
			}else{
				echo "Error: Fields with red asterisk are required!";
			}
			break;
		
		case 5: //change status			
			$faculty_id = $_POST['faculty_id'];
			$status_id = $_POST['status_id'];
			
			if ($faculty_id && $status_id){
				$sql = "UPDATE faculty_tbl SET status_id={$status_id} WHERE faculty_id={$faculty_id};";
				
				$update = $mysqli->query($sql);
				if ($update){
					//populate update list						
					include("faculty_query.php");
					$sql .= " WHERE f.faculty_id = {$faculty_id} ";
					$sql .= " ORDER BY f.lastname, f.firstname, f.middlename;";
					include("faculty_populate.php");
						
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