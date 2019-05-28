<?php
	$sql = "SELECT p.or_no, p.or_date, p.amount, p.remarks, p.date_encoded,	a.grand_total
			FROM payment_tbl p
			LEFT JOIN account_tbl a ON a.student_id = p.student_id ";
?>