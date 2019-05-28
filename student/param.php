
<?php
	session_start();
	date_default_timezone_set("Asia/Manila");
	
	if (empty($_SESSION['student_id']) || ($_SESSION['student_id'] === "") ){	
		header("Location: login.php");
	}else{
		$title ="PACES";
		$student_id = $_SESSION['student_id'];
		$student_fullname = $_SESSION['student_fullname'];
		$student_firstname = $_SESSION['student_firstname'];                       
		$schoolyear = $_SESSION['student_schoolyear'];
		$gradelevel = $_SESSION['student_gradelevel'];
		$section = $_SESSION['student_section'];  
		$answer1 = $_SESSION['answer1'];
		$answer2 = $_SESSION['answer2']; 
	}
?>