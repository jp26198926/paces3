<?php
					$sql = "SELECT 	s.student_id, s.lrn_no, s.lastname, s.firstname, s.middlename, s.extname, s.status_id,
							CONCAT(u.username) as cancelled_by, s.dt_cancelled, s.cancelled_reason,
							g.gender,
							l.gradelevel_name,
							CONCAT('SY ', y.schoolyear_start, '-', y.schoolyear_end) as sy,
							c.section_name,
							st.status
					FROM student_tbl s
					LEFT JOIN gender_tbl g on g.gender_id = s.gender
					LEFT JOIN gradelevel_tbl l on l.gradelevel_id = s.gradelevel_id
					LEFT JOIN schoolyear_tbl y ON y.schoolyear_id = s.schoolyear_id
					LEFT JOIN section_tbl c ON c.section_id = s.section_id
					LEFT JOIN status_tbl st ON st.status_id = s.status_id
					LEFT JOIN user_tbl u ON u.user_id=s.cancelled_by ";
?>