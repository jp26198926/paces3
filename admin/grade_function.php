<?php
	function get_subject_id($subject_name)
	{
		include('connect.php');

		$sql = "SELECT *
				FROM subject_tbl
				WHERE subject_name='{$subject_name}';";

		$pop = $mysqli->query($sql);
		
		if ($pop){
			if ($pop->num_rows > 0){
				//return true;
				return $pop->fetch_object()->subject_id;
			}else{
				return false;
			}			
		}else{
			return false;
			//return $mysqli->error;
		}

		$mysqli->close();
	}

	function get_student_id($student_name, $schoolyear_id, $gradelevel_id, $section_id)
	{
		include('connect.php');

		$sql = "SELECT *
				FROM student_tbl
				HAVING concat(lastname, ', ', firstname, ' ', middlename)='{$student_name}'
				AND schoolyear_id={$schoolyear_id} 
				AND gradelevel_id={$gradelevel_id}
				AND section_id={$section_id};";

		$pop = $mysqli->query($sql);
		
		if ($pop){
			if ($pop->num_rows > 0){
				//return true;
				return $pop->fetch_object()->student_id;						
			}else{
				return false;
			}			
		}else{
			return false;
			//return $mysqli->error;
		}

		$mysqli->close();
	}

	function is_grade_exist($student_id, $subject_id, $quarter_id)
	{
		include('connect.php');

		$sql = "SELECT `grade_id` FROM `grade_tbl` WHERE `student_id`={$student_id} AND  `subject_id`={$subject_id} AND `quarter_id`={$quarter_id};";


		$query = $mysqli->query($sql);
		
		if ($query){
			if ($query->num_rows > 0){
				return $query->fetch_object()->grade_id;
			}else{
				return false;
			}			
		}else{
			return false;
			//return $mysqli->error;
		}

		$mysqli->close();
	}
	
	function save_grade($student_id, $subject_id, $quarter_id, $quarter_grade, $updated_by)
	{
		include('connect.php');

		$sql = "INSERT INTO grade_tbl (student_id, subject_id, quarter_id, quarter_grade, updated_by)
				VALUES ({$student_id}, {$subject_id}, {$quarter_id}, {$quarter_grade}, {$updated_by});";

		$query = $mysqli->query($sql);
		
		if ($query){
			if ($mysqli->affected_rows > 0){
				return true;				
			}else{
				return false;
			}			
		}else{
			//return false;
			return $mysqli->error;
		}

		$mysqli->close();
	}

	function update_grade($grade_id, $quarter_grade, $updated_by)
	{
		include('connect.php');
		$dtx = date('Y-m-d H:i:s');

		$sql = "UPDATE grade_tbl
				SET	quarter_grade = {$quarter_grade}, 
					date_updated = '{$dtx}',	
					updated_by = {$updated_by}
				WHERE grade_id={$grade_id};";

		$query = $mysqli->query($sql);
		
		if ($query){
			return true;			
		}else{
			//return false;
			return $mysqli->error;
		}

		$mysqli->close();
	}
?>