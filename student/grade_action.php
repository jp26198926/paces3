<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
				
		case 1:
			$student_id = $_SESSION['student_id'];
			$schoolyear_id = $_SESSION['student_schoolyear_id'];
			$gradelevel_id = $_SESSION['student_gradelevel_id'];
			$section_id = $_SESSION['student_section_id'];

			if ($student_id){
				$sql = "SELECT  distinct g.subject_id, b.subject_name, 
								CONCAT(f.lastname, ', ', f.firstname, ' ', f.middlename) as teacher,
								(select quarter_grade from grade_tbl where quarter_id=1 and student_id=g.student_id and subject_id=g.subject_id) as grade_quarter1,
								(select quarter_grade from grade_tbl where quarter_id=2 and student_id=g.student_id and subject_id=g.subject_id) as grade_quarter2,
								(select quarter_grade from grade_tbl where quarter_id=3 and student_id=g.student_id and subject_id=g.subject_id) as grade_quarter3,
								(select quarter_grade from grade_tbl where quarter_id=4 and student_id=g.student_id and subject_id=g.subject_id) as grade_quarter4
						FROM grade_tbl g
						LEFT JOIN subject_tbl b on b.subject_id=g.subject_id
						LEFT JOIN student_tbl s ON s.student_id=g.student_id
						LEFT JOIN subject_teacher st ON st.subject_id = g.subject_id AND 
														st.gradelevel_id = s.gradelevel_id AND 
														st.section_id = s.section_id
						LEFT JOIN faculty_tbl f ON f.faculty_id = st.faculty_id
						WHERE g.student_id={$student_id}						
						ORDER BY b.subject_name;";

				$pop = $mysqli->query($sql);

				if ($pop){
					while($row = $pop->fetch_object()){
						$subject = $row->subject_name;
						$q1 = $row->grade_quarter1;
						$q2 = $row->grade_quarter2;
						$q3 = $row->grade_quarter3;
						$q4 = $row->grade_quarter4;
						$average = ($q1 + $q2 + $q3 + $q4) / 4;
						$teacher = ucwords($row->teacher);
						
						echo "<tr>";
						echo "	<td>{$subject}</td>";
						echo "	<td align='center'>{$q1}</td>";
						echo "	<td align='center'>{$q2}</td>";
						echo "	<td align='center'>{$q3}</td>";
						echo "	<td align='center'>{$q4}</td>";
						echo "	<td align='center'>{$average}</td>";
						echo "	<td>{$teacher}</td>";
						echo "</tr>";
					}
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