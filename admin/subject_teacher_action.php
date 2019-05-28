<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //get subject list
			$faculty_id = $_POST['faculty_id'];
			
			if ($faculty_id){
				
				include("subject_teacher_query.php");
				
				$sql .= " WHERE st.faculty_id={$faculty_id} ";
				$sql .= " ORDER BY g.gradelevel_name, s.section_name, b.subject_name, f.lastname, f.firstname, f.middlename;";
				
				include("subject_teacher_populate.php");
			}
			
			break;
			
		case 2: //add
			$gradelevel_id = $_POST['gradelevel_id'];
			$section_id = $_POST['section_id'];
			$subject_id = $_POST['subject_id'];
			$faculty_id = $_POST['faculty_id'];
			
			if ($gradelevel_id && $section_id && $subject_id && $faculty_id){
				
				$sql = "INSERT INTO subject_teacher(gradelevel_id, section_id, subject_id, faculty_id, encoded_by)
						VALUES ({$gradelevel_id}, {$section_id}, {$subject_id}, {$faculty_id}, {$user_id});";
					
				$save = $mysqli->query($sql);
				if ($save){
					//populate update list
					include("subject_teacher_query.php");
				
					$sql .= " WHERE st.faculty_id={$faculty_id} ";
					$sql .= " ORDER BY g.gradelevel_name, s.section_name, b.subject_name, f.lastname, f.firstname, f.middlename;";
					
					include("subject_teacher_populate.php");
				}else{
					echo "Error: " . $mysqli->error;
				}
				
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;
		
		
		
		case 3: //delete 
			$subject_teacher_id = $_POST['subject_teacher_id'];
			$faculty_id = $_POST['faculty_id'];
			
			if ($subject_teacher_id){
				$sql = "DELETE FROM subject_teacher WHERE id={$subject_teacher_id};";
				$delete = $mysqli->query($sql);
				if ($delete){
					//populate update list
					include("subject_teacher_query.php");
				
					$sql .= " WHERE st.faculty_id={$faculty_id} ";
					$sql .= " ORDER BY g.gradelevel_name, s.section_name, b.subject_name, f.lastname, f.firstname, f.middlename;";
					
					include("subject_teacher_populate.php");
				}else{
					echo "Error: " . $mysqli->error;
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;
		
		case 4: //get section & subject
			$gradelevel_id = $_POST['gradelevel_id'];			
			$sections = "";
			$subjects = "";
			
			if ($gradelevel_id){
				$sql = "SELECT section_id, section_name FROM section_tbl WHERE gradelevel_id={$gradelevel_id};";
				$pop = $mysqli->query($sql);
				
				if ($pop->num_rows > 0){
					while($row = $pop->fetch_object()){
						$section_id = $row->section_id;
						$section_name = $row->section_name;
						
						$sections .= "<option value='{$section_id}'>{$section_name}</option>";
					}
				}else{
					$sections .= "<option value='0'></option>";
				}
				
				
				$sql = "SELECT subject_id, subject_name FROM subject_tbl ORDER BY subject_name;";
				$pop = $mysqli->query($sql);
				
				if ($pop->num_rows > 0){
					while($row = $pop->fetch_object()){
						$subject_id = $row->subject_id;
						$subject_name = $row->subject_name;
						
						$subjects .= "<option value='{$subject_id}'>{$subject_name}</option>";
					}
				}else{
					$subjects .= "<option value='0'></option>";
				}
				
				echo $sections . ":~:||:~:" . $subjects;
			}
			
			break;
					
		default:
			echo "Error: Critical Error Encountered!";
	}
	
	$mysqli->close();
?>