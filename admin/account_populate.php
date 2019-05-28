<?php
			$search = $mysqli->query($sql);
			
			if ($search){
				$count = $search->num_rows;
				
				if ($count > 0){
					while($row = $search->fetch_object()){
						$account_id = $row->account_id;
						$lrn_no = $row->lrn_no;
						$lastname = $row->lastname;
						$firstname = $row->firstname;
						$middlename = $row->middlename;
						$extname = $row->extname;
						$tuition_fee = number_format($row->tuition_fee,2,".",",");
						$general_fee = number_format($row->general_fee,2,".",",");
						$other_fee = number_format($row->other_fee,2,".",",");
						$auxiliary_fee = number_format($row->auxiliary_fee,2,".",",");
						$discount_percentage = number_format($row->discount_percentage,2,".",",");
						
						$grand_total = floatval($row->grand_total);
						$paid = floatval($row->paid);
						$balance = $grand_total - $paid;
						
						$grand_total = number_format($grand_total,2,".",",");
						$paid = number_format($paid,2,".",",");
						$balance = number_format($balance,2,".",",");
						
						echo "<tr>";
						echo "	<td align='center'>";
						echo "		<a href='payment.php?id={$account_id}' class='btn btn-success btn-sm fa fa-exchange btn_account' title='Payment' />";
						echo "	</td>";
						
						echo "	<td>{$lrn_no}</td>";
						echo "	<td>{$lastname}</td>";
						echo "	<td>{$firstname}</td>";
						echo "	<td>{$middlename}</td>";
						echo "	<td>{$extname}</td>";
						echo "	<td align='right'>{$tuition_fee}</td>";
						echo "	<td align='right'>{$general_fee}</td>";
						echo "	<td align='right'>{$other_fee}</td>";
						echo "	<td align='right'>{$auxiliary_fee}</td>";
						echo "	<td align='right'>{$discount_percentage}</td>";
						echo "	<td align='right'>{$grand_total}</td>";
						echo "	<td align='right'>{$paid}</td>";
						echo "	<td align='right'>{$balance}</td>";
						echo "</tr>";
					}
				}else{
					echo "<tr><td colspan='14' align='center'> No Record Found </td></tr>";
				}
				
			}else{
				echo "Error: Critical Error Encountered!";
			}
?>