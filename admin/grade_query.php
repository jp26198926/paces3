<?php
	/*
	$sql = "SELECT 	s.student_id, s.lrn_no, CONCAT(s.lastname, ', ', s.firstname, ' ', s.middlename) as student, 
								g.gender, r.grade_id,
								r.grade_quarter1, r.grade_quarter2, r.grade_quarter3, r.grade_quarter4, r.grade_average
						FROM student_tbl s
						LEFT JOIN gender_tbl g ON g.gender_id = s.gender
						LEFT JOIN grade_tbl r ON r.student_id = s.student_id AND r.subject_id = {$subject_id}
						WHERE 	s.schoolyear_id = {$schoolyear_id} AND
								s.gradelevel_id = {$gradelevel_id} AND
								s.section_id = {$section_id} AND
								s.status_id = 4 ";
				
	$sql .= "ORDER BY g.gender DESC, s.lastname, s.firstname, s.middlename, s.lrn_no;";
	*/

	$sql = "SELECT 	s.student_id, s.lrn_no, CONCAT(s.lastname, ', ', s.firstname, ' ', s.middlename) as student, 
					g.gender,
					
					(SELECT quarter_grade 
					 FROM grade_tbl
					 WHERE 	student_id=s.student_id AND
					 		subject_id={$subject_id} AND
					 		quarter_id=1
					) as grade_quarter1, 

					(SELECT quarter_grade 
					 FROM grade_tbl
					 WHERE 	student_id=s.student_id AND
					 		subject_id={$subject_id} AND
					 		quarter_id=2
					) as grade_quarter2, 

					(SELECT quarter_grade 
					 FROM grade_tbl
					 WHERE 	student_id=s.student_id AND
					 		subject_id={$subject_id} AND
					 		quarter_id=3
					) as grade_quarter3, 

					(SELECT quarter_grade 
					 FROM grade_tbl
					 WHERE 	student_id=s.student_id AND
					 		subject_id={$subject_id} AND
					 		quarter_id=4
					) as grade_quarter4, 

					((SELECT SUM(quarter_grade) 
					  FROM grade_tbl
					  WHERE 	student_id=s.student_id AND
					 			subject_id={$subject_id}
					  GROUP BY student_id, subject_id					 		
					)/4) as grade_average
					
			FROM student_tbl s
			LEFT JOIN gender_tbl g ON g.gender_id = s.gender						
			WHERE 	s.schoolyear_id = {$schoolyear_id} AND
					s.gradelevel_id = {$gradelevel_id} AND
					s.section_id = {$section_id} AND
					s.status_id = 4 ";
				
	$sql .= "ORDER BY g.gender DESC, s.lastname, s.firstname, s.middlename, s.lrn_no;";

?>