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
						
						echo "<tr id='tr_{$student_id}'>";
						echo "	<td align='center'>";						
						echo "		<a href='#' id='{$student_id}' class='btn btn-info btn-sm fa fa-pencil btn_modify' title='Modify Student Info.' data-toggle='tooltip' />";
						echo "		<a href='#' id='{$student_id}' class='btn btn-success btn-sm fa fa-list btn_info' title='Show Student Info.' data-toggle='tooltip' />";
						echo "		<a href='#' id='{$student_id}' class='btn btn-danger btn-sm fa fa-warning btn_offence' title='Enter Offence' data-toggle='tooltip' />";
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
						echo "	<td>{$status}</td>";
						echo "</tr>";
					}
				}else{
					echo "<tr><td colspan='11' align='center'> No Record Found </td></tr>";
				}
				
			}else{
				echo "Error: Critical Error Encountered!";
			}
?>