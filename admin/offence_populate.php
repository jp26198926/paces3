<?php
				$pop = $mysqli->query($sql);
				if ($pop){
					$count = $pop->num_rows;
					
					if ($count > 0){
						while($row = $pop->fetch_object()){
							$offence_id = $row->offence_id;
							$student = ucwords($row->student);
							$schoolyear = $row->schoolyear;
							$gradelevel = $row->gradelevel;
							$incident_date = $row->incident_date;
							$incident_type = ucwords($row->incident_type);
							$description = ucwords($row->description);
							$comments = $row->comments;													
							$status_id = $row->status_id;
							$status = $row->status;
							$btn_change_status="";
							
							if ($status_id == 1){								
								echo "<tr id='tr_{$offence_id}'>";
								echo "	<td align='center'>";
								echo "		<a href='#' id='{$offence_id}' class='btn_modify btn btn-success fa fa-pencil' title='Modify' data-toggle='tooltip'></a> ";
								echo "		<a href='#' id='{$offence_id}' class='btn_delete btn btn-danger fa fa-times' title='Delete' data-toggle='tooltip'></a> ";
								echo "	</td>";
							}else{								
								echo "<tr id='tr_{$offence_id}' class='danger'>";
								echo "<td></td>";
							}
							
							echo "	<td>{$student}</td>";
							echo "	<td>{$schoolyear}</td>";
							echo "	<td>{$gradelevel}</td>";
							echo "	<td>{$incident_date}</td>";
							echo "	<td>{$incident_type}</td>";
							echo "	<td>{$description}</td>";
							echo "	<td>{$comments}</td>";
							echo "	<td>{$status}</td>";							
							echo "</tr>";
							
						}
					}else{
						echo "<tr><td colspan='9' align='center'> No Record </td></tr>";
					}
				}else{
					echo "Error: " . $mysqli->error;
				}
?>