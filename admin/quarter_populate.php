<?php
				$pop = $mysqli->query($sql);
				if ($pop){
					$count = $pop->num_rows;
					
					if ($count > 0){
						while($row = $pop->fetch_object()){
							$quarter_id = $row->quarter_id;
							$quarter_name = $row->quarter_name;
							$status_id = $row->status_id;
							$status;
							$btn_change_status;
							
							if ($status_id == 1){
								$status = "Active";
								$btn_change_status = " <a href='#' id='{$quarter_id}' class='btn_deactivate btn btn-danger fa fa-times' title='Deactivate' data-toggle='tooltip'></a> ";
								echo "<tr>";
							}else{
								$status = "Inactive";
								$btn_change_status = " <a href='#' id='{$quarter_id}' class='btn_activate btn btn-warning fa fa-reply' title='Activate' data-toggle='tooltip'></a> ";
								echo "<tr class='danger'>";
							}
							
							echo "	<td align='center'>";
							echo "		<a href='#' id='{$quarter_id}' class='btn_modify btn btn-success fa fa-pencil' title='Modify' data-toggle='tooltip'></a> ";
							echo 		$btn_change_status;
							echo "	</td>";
							
							echo "	<td>{$quarter_name}</td>";
							echo "	<td>{$status}</td>";							
							echo "</tr>";
							
						}
					}else{
						echo "<tr><td colspan='4' align='center'> No Grade Level </td></tr>";
					}
				}else{
					echo "Error: " . $mysqli->error;
				}
?>