<?php
				$pop = $mysqli->query($sql);
				if ($pop){
					$count = $pop->num_rows;
					
					if ($count > 0){
						while($row = $pop->fetch_object()){
							$section_id = $row->section_id;
							$gradelevel_name = $row->gradelevel_name;
							$section_name = $row->section_name;
							$advisory_id = $row->advisory_id;
							$adviser = ucwords($row->adviser);
							
							if ($adviser){
								$adviser = "<a href='#' id='{$advisory_id}' class='btn_modify' title='Click to Change Adviser' data-toggle='tooltip'> $adviser </a>";
								echo "<tr>";
							}else{
								$adviser = "<a href='#' id='{$section_id}' class='btn_new btn btn-success fa fa-eye'> Set Adviser</a>";	
								echo "<tr class='danger'>";
							}							
							
							echo "	<td>{$gradelevel_name}</td>";
							echo "	<td>{$section_name}</td>";
							echo "	<td>{$adviser}</td>";							
							echo "</tr>";
							
						}
					}else{
						echo "<tr><td colspan='3' align='center'> No Section Yet. Please add sections in Section Menu. </td></tr>";
					}
				}else{
					echo "Error: " . $mysqli->error;
				}
?>