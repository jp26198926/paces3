<?php
	$sql = "SELECT o.offence_id, o.incident_date, o.incident_type, o.`description`, o.`comments`,
					CONCAT(s.lrn_no, ' - ',s.lastname, ', ', s.firstname, ' ', s.middlename) as student,
					CONCAT('SY ', sy.schoolyear_start, ' - ', sy.schoolyear_end) as schoolyear,
					CONCAT(g.gradelevel_name, ' - ', c.section_name) as gradelevel,
					o.status_id,
					IF(o.status_id=1, 'Active', 'Deleted') as status
			FROM offence_tbl o 
			LEFT JOIN student_tbl s ON s.student_id = o.student_id
			LEFT JOIN schoolyear_tbl sy ON sy.schoolyear_id = s.schoolyear_id
			LEFT JOIN gradelevel_tbl g ON g.gradelevel_id = s.gradelevel_id
			LEFT JOIN section_tbl c ON c.section_id = s.section_id ";
?>