<?php
	$sql = "SELECT f.faculty_id, CONCAT(f.lastname, ', ', f.firstname, ' ', f.middlename) as faculty_name,
					f.designation, f.birthday, f.contact_no, f.prc_license, f.status_id,
					g.gender, s.status
			FROM faculty_tbl f
			LEFT JOIN gender_tbl g ON g.gender_id = f.gender_id
			LEFT JOIN faculty_status s ON s.status_id = f.status_id ";
?>