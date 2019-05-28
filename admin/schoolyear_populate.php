<?php
				$pop = $mysqli->query($sql);
				if ($pop){
					$count = $pop->num_rows;
					
					if ($count > 0){
						while($row = $pop->fetch_object()){
							$schoolyear_id = $row->schoolyear_id;
							$schoolyear_start = $row->schoolyear_start;
							$schoolyear_end = $row->schoolyear_end;
							$status_id = $row->status;
							$status = "Inctive";

							switch($status_id){
								case 1: //Inactive
									$status = "Inactive";
									echo "<tr>";
									break;
								case 2: //Active
									$status = "Active";
									echo "<tr class='success'>";
									break;
								case 3: //Deleted
									$status = "Deleted";
									echo "<tr='Deleted'>";
									break;
							}								
							
							echo "	<td align='center'>";
							
							if ($status_id == 1){
								echo "		<a href='#' id='{$schoolyear_id}' class='btn_modify btn btn-primary fa fa-pencil' title='Modify' data-toggle='tooltip'></a>
										    <a href='#' id='{$schoolyear_id}' class='btn_set_active btn btn-success fa fa-check' title='Set Active' data-toggle='tooltip'></a> ";

							}elseif ($status_id == 2){
								echo "		<a href='#' id='{$schoolyear_id}' class='btn_modify btn btn-primary fa fa-pencil' title='Modify' data-toggle='tooltip'></a> ";
							}
							
							echo "	</td>";
							
							echo "	<td>{$schoolyear_start}</td>";
							echo "	<td>{$schoolyear_end}</td>";
							echo "	<td>{$status}</td>";							
							echo "</tr>";
							
						}
					}else{
						echo "<tr><td colspan='4' align='center'> No Section </td></tr>";
					}
				}else{
					echo "Error: " . $mysqli->error;
				}
?>