<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		
		case 1: //search
			$schoolyear_id = intval($_POST['schoolyear_id']);
			$gradelevel_id = intval($_POST['gradelevel_id']);
			$quarter_no = intval($_POST['quarter_no']);
			
			if ($schoolyear_id && $gradelevel_id && $quarter_no){
				
				$sql = "";
				
				if ($quarter_no < 5){
					$sql = "SELECT (SUM(g.grade_quarter{$quarter_no}) / COUNT(g.student_id)) as top_grade,
								   s.lrn_no, CONCAT(s.lastname, ', ', s.firstname, ' ', s.middlename) as student_name,
								   r.gender,
								   l.gradelevel_name,
								   c.section_name
							FROM grade_tbl g 
							LEFT JOIN student_tbl s ON s.student_id = g.student_id						
							LEFT JOIN gender_tbl r ON r.gender_id = s.gender
							LEFT JOIN gradelevel_tbl l ON l.gradelevel_id = s.gradelevel_id
							LEFT JOIN section_tbl c ON c.section_id = s.section_id
							WHERE s.schoolyear_id = {$schoolyear_id} AND
								  s.gradelevel_id = {$gradelevel_id} AND
								  s.status_id = 4
							GROUP BY g.student_id
							ORDER BY (SUM(g.grade_quarter{$quarter_no}) / COUNT(g.student_id)) DESC, 
									 s.lastname, s.firstname, s.middlename;";
				}else{
					
					$sql = "SELECT (((SUM(g.grade_quarter1) + 
									  SUM(g.grade_quarter2) + 
									  SUM(g.grade_quarter3) + 
									  SUM(g.grade_quarter4)) / 4) / COUNT(g.student_id)) as top_grade,
								   s.lrn_no, CONCAT(s.lastname, ', ', s.firstname, ' ', s.middlename) as student_name,
								   r.gender,
								   l.gradelevel_name,
								   c.section_name
							FROM grade_tbl g 
							LEFT JOIN student_tbl s ON s.student_id = g.student_id						
							LEFT JOIN gender_tbl r ON r.gender_id = s.gender
							LEFT JOIN gradelevel_tbl l ON l.gradelevel_id = s.gradelevel_id
							LEFT JOIN section_tbl c ON c.section_id = s.section_id
							WHERE s.schoolyear_id = {$schoolyear_id} AND
								  s.gradelevel_id = {$gradelevel_id} AND
								  s.status_id = 4
							GROUP BY g.student_id
							ORDER BY (((SUM(g.grade_quarter1)) + (SUM(g.grade_quarter2)) + (SUM(g.grade_quarter3)) + (SUM(g.grade_quarter4)) ) / COUNT(g.student_id)) DESC, 
									 s.lastname, s.firstname, s.middlename;";
				}
				
				$pop = $mysqli->query($sql);
				if ($pop){
					$count = $pop->num_rows;
					
					if ($count > 0){
						$top = 0;
						while ($row = $pop->fetch_object()){
							$top++;
							$lrn_no = $row->lrn_no;
							$student_name = ucwords($row->student_name);
							$gender = $row->gender;
							$gradelevel_name = $row->gradelevel_name;
							$section_name = $row->section_name;
							$top_grade = number_format($row->top_grade, 2, ".", ",");
							
							echo "<tr>";
							echo "	<td>{$top}</td>";
							echo "	<td>{$lrn_no}</td>";
							echo "	<td>{$student_name}</td>";
							echo "	<td>{$gender}</td>";
							echo "	<td>{$gradelevel_name}</td>";
							echo "	<td>{$section_name}</td>";
							echo "	<td>{$top_grade}</td>";
							echo "</tr>";
						}
					}else{
						echo "<tr><td align='center' colspan='7'>No Grades Yet</tr>";
					}
				}else{
					echo "Error: " . $mysqli->error;
				}
			}else{
				echo "Error: All dropdown fields must filled!";
			}
			
			break;
					
		default:
			echo "Error: Critical Error Encountered!";
	}
	
	$mysqli->close();
?>