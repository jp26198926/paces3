<?php
			$search = $mysqli->query($sql);
			
			if ($search){
				$count = $search->num_rows;
				
				if ($count > 0){
					while($row = $search->fetch_object()){
						$student_id = $row->student_id;
						$lrn_no = $row->lrn_no;
						$lastname = $row->lastname;
						$firstname = $row->firstname;
						$middlename = $row->middlename;
						$extname = $row->extname;
						$gender = $row->gender;
						$grade_level = $row->gradelevel_name;
						$section_name = $row->section_name;
						$sy = $row->sy;
						$status_id = $row->status_id;
						$status = $row->status;
						$status_hover = "";

						$cancelled_by = $row->cancelled_by;
						$cancelled_reason = $row->cancelled_reason;
						$dt_cancelled = $row->dt_cancelled;
												
						echo "	<td align='center'>";
						
						if ($status_id == 1){ //pending					
							echo "		<a href='account_form.php?id={$student_id}' class='btn btn-primary btn-sm fa fa-plus btn_account' title='Enter Account Details' />";

							echo "		<a href='#' id='{$student_id}' class='btn btn-danger btn-sm fa fa-times btn_registration_cancel' title='Cancel Registration' />";
						}
						if ($status_id == 3){ //paid
							echo "		<a href='#' id='{$student_id}' class='btn btn-success btn-sm fa fa-check btn_enroll' title='Enroll' />";
						}
						if ($status_id == 5){ //cancelled
							$status_hover = "title='{$dt_cancelled}: {$cancelled_reason}'";
						}
						
						echo "	</td>";
						
						echo "	<td>{$lrn_no}</td>";
						echo "	<td>{$lastname}</td>";
						echo "	<td>{$firstname}</td>";
						echo "	<td>{$middlename}</td>";
						echo "	<td>{$extname}</td>";
						echo "	<td>{$gender}</td>";
						echo "	<td>{$grade_level}</td>";
						echo "	<td>{$section_name}</td>";
						echo "	<td>{$sy}</td>";
						echo "	<td><span {$status_hover} data-toggle='tooltip'>{$status}</span></td>";						
					}
				}else{
					echo "<tr><td colspan='10' align='center'> No Record Found </td></tr>";
				}
				
			}else{
				echo "Error: Critical Error Encountered!";
			}
?>