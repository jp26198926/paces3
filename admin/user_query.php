<?php
	$sql = "SELECT u.user_id, u.username, a.access_name, u.status_id,
					CONCAT(f.lastname, ', ', f.firstname, ' ', f.middlename) as fullname,
					f.designation,
					s.status
			FROM user_tbl u 
			LEFT JOIN access_tbl a ON a.access_id = u.access_id
			LEFT JOIN faculty_tbl f ON f.faculty_id = u.faculty_id
			LEFT JOIN user_status s ON s.status_id = u.status_id ";
?>