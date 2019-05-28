<?php
				$sql = "SELECT 	a.account_id, a.tuition_fee, a.general_fee, a.other_fee, a.auxiliary_fee,
								a.discount_percentage, a.grand_total,								
								s.lrn_no, s.lastname, s.firstname, s.middlename, s.extname,
								(SELECT SUM(amount) FROM payment_tbl WHERE student_id = a.student_id GROUP BY student_id) as paid
				FROM account_tbl a
				LEFT JOIN student_tbl s ON s.student_id = a.student_id ";
?>