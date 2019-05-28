<?php
							$pop = $mysqli->query($sql);
							
							if ($pop){
								$count = $pop->num_rows;
								
								if ($count > 0){
									$running_balance = 0;
									
									while($row = $pop->fetch_object()){
										$or_no = $row->or_no;
										$or_date = $row->or_date;
										$amount = floatval($row->amount);
										$grand_total = floatval($row->grand_total);
										$running_balance += $amount;
										$balance = $grand_total - $running_balance;
										$remarks = $row->remarks;
										$date_encoded = $row->date_encoded;
										
										$amount = number_format($amount,2,".",",");
										$balance = number_format($balance,2,".",",");
										
										echo "<tr>";
										echo "	<td></td>";
										echo "	<td>{$or_no}</td>";
										echo "	<td>{$or_date}</td>";
										echo "	<td align='right'>{$amount}</td>";
										echo "	<td align='right'>{$balance}</td>";
										echo "	<td>{$remarks}</td>";
										echo "	<td>{$date_encoded}</td>";
										echo "</tr>";
									}
								}else{
									echo "<tr><td align='center' colspan='7'> No Record </td></tr>";
								}
							}else{
								echo "Error: " . $mysqli->error;
							}
?>