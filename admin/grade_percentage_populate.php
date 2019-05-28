<?php
				$pop = $mysqli->query($sql);
				if ($pop){
					$count = $pop->num_rows;
					
					if ($count > 0){
						while($row = $pop->fetch_object()){
							$grade_percentage_id = $row->grade_percentage_id;
							$subject_name = $row->subject_name;
							$grade_category_name = $row->gradecategory_name;
							$percent_value = $row->percent_value;
							
							
							
							echo "<tr>";
							echo "	<td align='center'>";
							echo "		<a href='#' id='{$grade_percentage_id}' class='btn_modify btn btn-success fa fa-pencil' title='Modify' data-toggle='tooltip'></a> ";
							
							echo "	</td>";
							
							echo "	<td>{$subject_name}</td>";
							echo "	<td>{$grade_category_name}</td>";	
							echo "	<td>{$percent_value} %</td>";							
							echo "</tr>";
							
						}
					}else{
						echo "<tr><td colspan='4' align='center'> No Grade Percentage Defined! </td></tr>";
					}
				}else{
					echo "Error: " . $mysqli->error;
				}
?>