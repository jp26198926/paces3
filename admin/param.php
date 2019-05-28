
<?php
	session_start();
	date_default_timezone_set("Asia/Manila");
	
	if (empty($_SESSION['user_id']) || ($_SESSION['user_id'] === "") ){	
		header("Location: login.php");
	}else{
		$title ="PACES";
		$user_id = $_SESSION['user_id'];
		$user_fullname = $_SESSION['user_fullname'];
		$user_firstname = $_SESSION['user_firstname'];                       
		$user_access = $_SESSION['user_access'];
		
		/*** USER ACCESS DESCRIPTION 
			1 - Administrator
			2 - Principal
			3 - Teacher
			4 - Cashier
		***/
			
	}
?>