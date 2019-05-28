<?php

	session_start();
	include("../function/itexmo_api.php");
	include("connect.php");
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //get
			$sql = "SELECT * FROM settings_sms_tbl;";
			
			$pop = $mysqli->query($sql);

			if ($pop){
				$row = $pop->fetch_assoc();

				echo json_encode($row);
			}else{
				echo "Error" . $mysqli->error;
			}			
			
			break;
			
		case 2: //save
			$sms_api_code = $_POST['sms_api_code'];
			$sms_mobile = $_POST['sms_mobile'];
			$sms_email = $_POST['sms_email'];
			$sms_name = $_POST['sms_name'];

			if ($sms_api_code && $sms_mobile && $sms_email && $sms_name){
				$sql = "UPDATE settings_sms_tbl
						SET 
							sms_api_code = '{$sms_api_code}',
							sms_mobile = '{$sms_mobile}',
							sms_email = '{$sms_email}',
							sms_name = '{$sms_name}'
						";

				$save = $mysqli->query($sql);
				if ($save){
					echo "Sucessfully Saved!";
				}else{
					echo "Error: " . $mysqli->error;
				}
			}else{
				echo "Error: All fields are required!";
			}
			break;

		case 3: //send
			$recepient_no = $_POST['recepient_no'];
			$msg = $_POST['msg'];

			//get api details
			$sql = "SELECT * FROM settings_sms_tbl;";
			
			$pop = $mysqli->query($sql);

			if ($pop){
				$row = $pop->fetch_assoc();

				$sms_api_code = $row['sms_api_code'];

				//fire up SMS API
				$result = itexmo($recepient_no, $msg, $sms_api_code);
				
				if ($result == ""){
					echo "Error: No response from server!!! <br>
						  Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.
						  Please <a href=\"https://www.itexmo.com/contactus.php\">CONTACT US</a> for help. ";	
				}else if ($result == 0){
					echo "Successfully Sent!";
				}else{	
					echo "Error: API Error No ". $result . " was encountered!";
				}

			}else{
				echo "Error" . $mysqli->error;
			}

			break;
			
		default:
			echo "Error: Critical Error Encountered!";
	}
	
	$mysqli->close();
?>