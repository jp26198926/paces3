<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
				
		case 1:
			$student_id = $_SESSION['student_id'];
									
			if ($student_id){
				$sql = "SELECT FORMAT(a.tuition_fee,2) as tuition_fee, 
								FORMAT(a.general_fee,2) as general_fee, 
								FORMAT(a.auxiliary_fee,2) as auxiliary_fee, 
								FORMAT(a.other_fee,2) as other_fee, 
								a.discount_percentage, 
								FORMAT(a.grand_total,2) as grand_total,
								FORMAT((a.grand_total - (SELECT SUM(amount) FROM payment_tbl WHERE student_id=a.student_id GROUP BY student_id)),2) as balance
						FROM account_tbl a
						WHERE a.student_id = {$student_id};";
				
				$pop = $mysqli->query($sql);
				
				if ($pop){
					$count = $pop->num_rows;
					
					if ($count > 0){
						echo json_encode($pop->fetch_assoc());
						
						echo "~:||:~";
						
						//get payment record
						$sql = "SELECT p.or_no, p.or_date, p.amount, p.remarks, p.date_encoded,	a.grand_total
								FROM payment_tbl p
								LEFT JOIN account_tbl a ON a.student_id = p.student_id
								WHERE p.student_id={$student_id};";
						
						$payment = $mysqli->query($sql);
							
						if ($payment){
							$count = $payment->num_rows;
								
							if ($count > 0){
								$running_balance = 0;
									
								while($row = $payment->fetch_object()){
									$or_no = $row->or_no;
									$or_date = $row->or_date;
									$amount = floatval($row->amount);
									$grand_total = floatval($row->grand_total);
									$running_balance += $amount;
									$balance = $grand_total - $running_balance;
									$remarks = $row->remarks;
									$date_encoded = $row->date_encoded;
										
									$amount = number_format($amount,2,".",",");
									$balance = number_format($balance,2,".",",");
										
									echo "<tr>";									
									echo "	<td>{$or_no}</td>";
									echo "	<td>{$or_date}</td>";
									echo "	<td align='right'>{$amount}</td>";
									echo "	<td align='right'>{$balance}</td>";
									echo "	<td>{$remarks}</td>";
									echo "</tr>";
								}
							}else{
								echo "<tr><td align='center' colspan='5'> No Record </td></tr>";
							}
						}else{
							echo "Error: " . $mysqli->error;
						}
								
					}else{
						echo "Error: Critical Error Encountered!";
					}
				}else{
					echo "Error: " . $mysqli->error;
				}				
				
			}else{
				echo "Error: Critical Error Encountered!";
			}
			
			break;
			
		default:
			echo "Error: Critical Error Encountered!";
	}
	
	$mysqli->close();
?>