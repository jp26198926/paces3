<?php
				$pop = $mysqli->query($sql);
				
				if ($pop){
					$count = $pop->num_rows;
					$gender_current = "male";

					
					if ($count){
						$num = 0;
						while($row = $pop->fetch_object()){
							//$num++;							
							$student_id = $row->student_id;
							$lrn_no = $row->lrn_no;
							$student = ucwords($row->student);
							$gender = $row->gender;

							$quarter1 = $row->grade_quarter1;
							$quarter2 = $row->grade_quarter2;
							$quarter3 = $row->grade_quarter3;
							$quarter4 = $row->grade_quarter4;
							$average = number_format($row->grade_average,"2",".",",");

							/*
							$quarter1 = floatval($row->grade_quarter1) > 0 ? $row->grade_quarter1 : "Input";
							$quarter2 = floatval($row->grade_quarter2) > 0 ? $row->grade_quarter2 : "Input";
							$quarter3 = floatval($row->grade_quarter3) > 0 ? $row->grade_quarter3 : "Input";
							$quarter4 = floatval($row->grade_quarter4) > 0 ? $row->grade_quarter4 : "Input";
							
							$average = ($quarter1 + $quarter2 + $quarter3 + $quarter4) / 4;
							$average = number_format($average,"2",".",",");
							
							$quarter1 = "<a href='#' id='{$student_id}' class='btn_q1_add' title='Update Grade' data-toggle='tooltip'>{$quarter1}</a>";
							$quarter2 = "<a href='#' id='{$student_id}' class='btn_q2_add' title='Update Grade' data-toggle='tooltip'>{$quarter2}</a>";
							$quarter3 = "<a href='#' id='{$student_id}' class='btn_q3_add' title='Update Grade' data-toggle='tooltip'>{$quarter3}</a>";
							$quarter4 = "<a href='#' id='{$student_id}' class='btn_q4_add' title='Update Grade' data-toggle='tooltip'>{$quarter4}</a>";
							*/

							if (strtolower($gender)===$gender_current){
								$num++;
							}else{
								$gender_current = strtolower($gender);
								$num=1;
							}
							
							if ($row->grade_average > 0){
								if (strtolower($gender)==="male"){
									echo "<tr class='info'>";
								}else{
									echo "<tr class='warning'>";
								}							
							}else{
								echo "<tr class='danger'>";
							}
							
							echo "	<td>{$num}</td>";
							echo "	<td>{$lrn_no}</td>";
							echo "	<td>{$student}</td>";
							echo "	<td>{$gender}</td>";
							echo "	<td align='center'>{$quarter1}</td>";
							echo "	<td align='center'>{$quarter2}</td>";
							echo "	<td align='center'>{$quarter3}</td>";
							echo "	<td align='center'>{$quarter4}</td>";
							echo "	<td align='center'>{$average}</td>";
							echo "</tr>";
							
						}
					}else{
						echo "<tr><td colspan='9' align='center'>No Student Record</td></tr>";
					}
				}else{
					echo "Error: " . $mysqli->error;
				}			
?>