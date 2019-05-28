<?php
			$search = $mysqli->query($sql);
			
			if ($search){
				$count = $search->num_rows;
				
				if ($count > 0){
					while($row = $search->fetch_object()){
						$faculty_id = $row->faculty_id;
						$faculty_name = ucwords($row->faculty_name);
						$gender = $row->gender;
						$designation = $row->designation;
						$birthday = $row->birthday;
						$contact_no = $row->contact_no;
						$prc_license = $row->prc_license;
						$status_id = $row->status_id;
						$status = $row->status;
						
						switch($status_id){
							case 2:
								echo "<tr class='danger'>";
								break;
							default:
								echo "<tr>";
						}
						
						
						echo "	<td align='center'>";
						echo "		<a href='#' id='{$faculty_id}' class='btn_info btn btn-info fa fa-search' title='Modify' data-toggle='tooltip'></a>";
						echo "		<a href='#' id='{$faculty_id}' class='btn_modify btn btn-success fa fa-pencil' title='Modify' data-toggle='tooltip'></a>";
						
						if ($status_id == 1){
							echo "		<a href='#' id='{$faculty_id}' class='btn_deactivate btn btn-danger fa fa-times' title='Deactivate' data-toggle='tooltip'></a>";
						}else{
							echo "		<a href='#' id='{$faculty_id}' class='btn_activate btn btn-warning fa fa-reply' title='Activate' data-toggle='tooltip'></a>";
						}
						
						echo "	</td>";
						
						echo "	<td>{$faculty_name}</td>";
						echo "	<td>{$gender}</td>";
						echo "	<td>{$designation}</td>";
						echo "	<td>{$birthday}</td>";
						echo "	<td>{$contact_no}</td>";
						echo "	<td>{$prc_license}</td>";
						echo "	<td>{$status}</td>";						
						echo "</tr>";
					}
				}else{
					echo "<tr><td colspan='8' align='center'> No Record Found </td></tr>";
				}
				
			}else{
				echo "Error: " . $mysqli->error;
			}
?>