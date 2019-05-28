<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //initialize ledger
			$account_id = intval($_POST['account_id']);
						
			if ($account_id){
				//get student info
				$sql = "SELECT  a.student_id, s.lrn_no, 
								CONCAT(s.lastname, ', ', s.firstname, ' ', s.middlename, ' ', s.extname) as student_name,
								g.gradelevel_name as gradelevel,
								CONCAT('SY ', y.schoolyear_start, ' - ', y.schoolyear_end) as sy
						FROM account_tbl a
						LEFT JOIN student_tbl s ON s.student_id = a.student_id
						LEFT JOIN gradelevel_tbl g ON g.gradelevel_id = s.gradelevel_id
						LEFT JOIN schoolyear_tbl y ON y.schoolyear_id = s.schoolyear_id						
						WHERE a.account_id = {$account_id};";
				
				$pop = $mysqli->query($sql);
				if ($pop){					
					$data = $pop->fetch_assoc();
					$student_id = $data["student_id"];
					
					echo json_encode($data);	

					echo ":~||~:"; //splitter
					
					//get payment ledge
					include('payment_query.php');
					$sql .= " WHERE p.student_id={$student_id};";
							
					//populate ledger
					include('payment_populate.php');
					
				}else{
					echo "Error: " . $mysqli->error;
				}
				
			}else{
				echo "Error: Critical Error Encountered!";
			}
			
			break;
			
		case 2: //get current balance
			$student_id = intval($_POST['student_id']);
			
			$sql = "SELECT a.grand_total,
						   (SELECT SUM(amount) FROM payment_tbl WHERE student_id = a.student_id GROUP BY student_id) as paid
					FROM account_tbl a
					WHERE a.student_id = {$student_id};";
			
			$pop = $mysqli->query($sql);
			if ($pop){
				$row = $pop->fetch_object();
				
				$grand_total = floatval($row->grand_total);
				$paid = floatval($row->paid);
				$current_balance = $grand_total - $paid;
				
				echo number_format($current_balance,2,".",",");
			}else{
				echo "Error: " . $mysqli->error;
			}
			
			break;
		
		case 3: //add
			$student_id = $_POST['student_id'];
			$or_no = $_POST['or_no'];
			$or_date = $_POST['or_date'];
			$amount = floatval($_POST['amount']);
			$remarks = $_POST['remarks'];
			
			if ($student_id){
				if ($or_no && $or_date){
					if ($amount > 0){
						$sql = "INSERT INTO payment_tbl(student_id, or_no, or_date, amount, remarks, encoded_by)
											VALUES({$student_id}, {$or_no}, '{$or_date}', {$amount}, '{$remarks}', {$user_id});";
											
						$save = $mysqli->query($sql);
						if ($save){
							
							include('payment_query.php');
							$sql .= " WHERE p.student_id={$student_id};";
							
							//populate ledger
							include('payment_populate.php');
							
							//update student status to payment done if it is the 1st payment
							$sql = "UPDATE student_tbl SET status_id=3 WHERE student_id={$student_id} AND status_id=2;";
							$update = $mysqli->query($sql);
							
						}else{
							echo "Error: " . $mysqli->error;
						}
					}else{
						echo "Error: Invalid Amount!";
					}
				}else{
					echo "Error: OR No. & Date are required field!";
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