<?php
				$pop = $mysqli->query($sql);
				if ($pop){
					$count = $pop->num_rows;
					
					if ($count > 0){
						while($row = $pop->fetch_object()){
							$id = $row->id;
							$schoolyear = $row->schoolyear;
							$gradelevel = $row->gradelevel_name;
							$tuition_fee = number_format($row->tuition_fee,2,".",",");
							$general_fee = number_format($row->general_fee,2,".",",");
							$auxiliary_fee = number_format($row->auxiliary_fee,2,".",",");
							$other_fee = number_format($row->other_fee,2,".",",");
							
							echo "<tr id='tr_{$id}'>";
							echo "	<td align='center'>";
							echo "		<a href='#' id='{$id}' class='btn_modify btn btn-success fa fa-pencil' title='Modify' data-toggle='tooltip'></a> ";
							echo "	</td>";
							
							echo "	<td>{$schoolyear}</td>";
							echo "	<td>{$gradelevel}</td>";
							echo "	<td>{$tuition_fee}</td>";	
							echo "	<td>{$general_fee}</td>";
							echo "	<td>{$auxiliary_fee}</td>";	
							echo "	<td>{$other_fee}</td>";
							echo "</tr>";
							
						}
					}else{
						echo "<tr><td colspan='7' align='center'> No Section </td></tr>";
					}
				}else{
					echo "Error: " . $mysqli->error;
				}
?>