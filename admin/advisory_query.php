<?php
	$sql = "SELECT g.gradelevel_name, s.section_id, s.section_name,
					a.advisory_id,
					CONCAT(f.lastname, ', ', f.firstname, ' ', f.middlename) as adviser
			FROM section_tbl s 
			LEFT JOIN gradelevel_tbl g ON g.gradelevel_id = s.gradelevel_id
			LEFT JOIN advisory_tbl a ON a.gradelevel_id = s.gradelevel_id AND a.section_id = s.section_id
			LEFT JOIN faculty_tbl f ON f.faculty_id = a.faculty_id ";
?>