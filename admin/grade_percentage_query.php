<?php
	$sql = "SELECT gp.grade_percentage_id, s.subject_name, g.gradecategory_name, gp.percent_value 
			FROM grade_category_percentage_tbl gp 
			LEFT JOIN subject_tbl s ON s.subject_id = gp.subject_id
			LEFT JOIN grade_category_tbl g ON g.gradecategory_id = gp.grade_category_id ";
?>