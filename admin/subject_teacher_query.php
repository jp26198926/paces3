<?php
	$sql = "SELECT 	st.id,
					CONCAT(f.lastname, ', ', f.firstname, ' ', f.middlename) as teacher,
					g.gradelevel_name,
					s.section_name,
					b.subject_name
			FROM subject_teacher st
			LEFT JOIN faculty_tbl f ON f.faculty_id = st.faculty_id
			LEFT JOIN gradelevel_tbl g ON g.gradelevel_id = st.gradelevel_id
			LEFT JOIN section_tbl s ON s.section_id = st.section_id
			LEFT JOIN subject_tbl b ON b.subject_id = st.subject_id
			";
?>