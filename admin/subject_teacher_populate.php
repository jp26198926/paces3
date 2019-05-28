<?php
				$pop = $mysqli->query($sql);
				if ($pop){
					$count = $pop->num_rows;
					
					if ($count > 0){
						while($row = $pop->fetch_object()){
							$id = $row->id;
							$teacher = ucwords($row->teacher);
							$gradelevel_name = $row->gradelevel_name;
							$section_name = $row->section_name;
							$subject_name = $row->subject_name;							
							
							echo "<tr>";		
							echo "	<td align='center'>";
							echo "		<a href='#' id='{$id}' class='btn_delete btn btn-danger fa fa-times' title='Delete' data-toggle='tooltip'></a>";
							echo "	</td>";
							echo "	<td>{$teacher}</td>";
							echo "	<td>{$gradelevel_name}</td>";
							echo "	<td>{$section_name}</td>";	
							echo "	<td>{$subject_name}</td>";								
							echo "</tr>";
							
						}
					}else{
						echo "<tr><td colspan='5' align='center'> No Record </td></tr>";
					}
				}else{
					echo "Error: " . $mysqli->error;
				}
?>