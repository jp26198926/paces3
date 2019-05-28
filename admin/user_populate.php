<?php
				$pop = $mysqli->query($sql);
				if ($pop){
					$count = $pop->num_rows;
					
					if ($count > 0){
						while($row = $pop->fetch_object()){
							$user_id = $row->user_id;
							$username = $row->username;
							$access_name = $row->access_name;
							$fullname = ucwords($row->fullname);
							$designation = $row->designation;							
							$status_id = $row->status_id;
							$status = $row->status;
							$btn_change_status;
							
							if ($status_id == 1){								
								$btn_change_status = " <a href='#' id='{$user_id}' class='btn_deactivate btn btn-danger fa fa-times' title='Deactivate' data-toggle='tooltip'></a> ";
								echo "<tr>";
							}else{								
								$btn_change_status = " <a href='#' id='{$user_id}' class='btn_activate btn btn-warning fa fa-reply' title='Activate' data-toggle='tooltip'></a> ";
								echo "<tr class='danger'>";
							}
							
							echo "	<td align='center'>";
							echo "		<a href='#' id='{$user_id}' class='btn_modify_password btn btn-info fa fa-refresh' title='Change Password' data-toggle='tooltip'></a> ";
							echo "		<a href='#' id='{$user_id}' class='btn_modify btn btn-success fa fa-pencil' title='Modify' data-toggle='tooltip'></a> ";
							echo 		$btn_change_status;
							echo "	</td>";
							
							echo "	<td>{$username}</td>";
							echo "	<td>{$access_name}</td>";
							echo "	<td>{$fullname}</td>";
							echo "	<td>{$designation}</td>";
							echo "	<td>{$status}</td>";							
							echo "</tr>";
							
						}
					}else{
						echo "<tr><td colspan='6' align='center'> No Record </td></tr>";
					}
				}else{
					echo "Error: " . $mysqli->error;
				}
?>