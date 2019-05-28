<?php
	$sql = "SELECT  t.*, CONCAT('SY ',s.schoolyear_start,' - ',s.schoolyear_end) as schoolyear,
					g.gradelevel_name
			FROM tuition_tbl t 
			LEFT JOIN schoolyear_tbl s ON s.schoolyear_id = t.schoolyear_id
			LEFT JOIN gradelevel_tbl g ON g.gradelevel_id = t.gradelevel_id ";
?>