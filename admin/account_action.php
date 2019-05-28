<?php
	
	include('param.php');
	include('connect.php');
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //initialize new entry form
			$student_id = intval($_POST['student_id']);
			
			if ($student_id){
				$sql = "SELECT  s.lrn_no, s.lastname, s.firstname, s.middlename, s.extname,
								g.gradelevel_name as gradelevel,
								CONCAT('SY ', y.schoolyear_start, ' - ', y.schoolyear_end) as sy,
								t.tuition_fee, t.general_fee, t.other_fee, t.auxiliary_fee
						FROM student_tbl s
						LEFT JOIN gradelevel_tbl g ON g.gradelevel_id = s.gradelevel_id
						LEFT JOIN schoolyear_tbl y ON y.schoolyear_id = s.schoolyear_id
						LEFT JOIN tuition_tbl t ON t.gradelevel_id = s.gradelevel_id AND t.schoolyear_id = s.schoolyear_id
						WHERE s.student_id = {$student_id};";
				
				$pop = $mysqli->query($sql);
				if ($pop){
					$count = $pop->num_rows;
					
					if ($count > 0){
						$data = $pop->fetch_assoc();
						echo json_encode($data);
					}else{
						echo "Error: Student ID not found!";
					}
					
				}else{
					echo "Error: " . $mysqli->error;
				}
				
			}else{
				echo "Error: Critical Error Encountered!";
			}
			
			break;
			
		case 2: //search by id
			$id = intval($_POST['id']);
			
			include("account_query.php");
			
			$sql .= " WHERE a.account_id={$id} ";
			$sql .= " ORDER BY s.lastname, s.firstname, s.middlename, s.extname;";
			
			include("account_populate.php");
			
			break;
		
		case 3: //wildcard search
			$search = $_POST['search'];
			
			include("account_query.php");
			
			$sql .= " WHERE CONCAT_WS(s.lrn_no, s.lastname, s.firstname, s.middlename, s.extname) 
					  LIKE '%{$search}%' ";
			
			$sql .= " ORDER BY s.lastname, s.firstname, s.middlename, s.extname;";
			
			include("account_populate.php");
			
			break;
		
		case 4: //add
			$student_id = $_POST['student_id'];
			$tuition_fee = $_POST['tuition_fee'];
			$general_fee = $_POST['general_fee'];
			$other_fee = $_POST['other_fee'];
			$auxiliary_fee = $_POST['auxiliary_fee'];
			$discount_percentage = $_POST['discount_percentage'];
			$grand_total = $_POST['grand_total'];
			$financer_name = $_POST['financer_name'];
			$financer_address = $_POST['financer_address'];
			$financer_contact = $_POST['financer_contact'];
			$financer_relationship = $_POST['financer_relationship'];			
			
			if ($student_id){
				$sql = "INSERT INTO account_tbl(
													student_id,
													tuition_fee,
													general_fee,
													other_fee,
													auxiliary_fee,
													discount_percentage,
													grand_total,
													financer_name,
													financer_address,
													financer_contact,
													financer_relationship,
													encoded_by
											)VALUES(	
													{$student_id},
													{$tuition_fee},
													{$general_fee},
													{$other_fee},
													{$auxiliary_fee},
													{$discount_percentage},
													{$grand_total},
													'{$financer_name}',
													'{$financer_address}',
													'{$financer_contact}',
													'{$financer_relationship}',
													{$user_id}
											);";
				
				$save = $mysqli->query($sql);
				if ($save){
					echo $mysqli->insert_id;
					
					//update student status
					$sql = "UPDATE student_tbl SET status_id=2 WHERE student_id={$student_id}";
					$update = $mysqli->query($sql);
				}else{
					echo "Error: " . $mysqli->error;
				}
				
			}else{
				echo "Error: Critical Error Encountered!";
			}
			
			break;
		/*
		case 5: //update
			
			
			break;
		*/	
		
		default:
			echo "Error: Critical Error Encountered!";
	}
	
	$mysqli->close();
?>