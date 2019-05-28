<?php
	//date_default_timezone_set("Asia/Manila");
    date_default_timezone_set("Asia/Manila");
    
    include ('connect.php');
    
    $uname = $mysqli->real_escape_string($_POST['uname']);
    $upass = $mysqli->real_escape_string($_POST['upass']); 
    
    $sql = "SELECT  s.student_id, s.username, s.password, s.lastname, s.firstname, s.middlename, s.extname, s.status_id,
					s.schoolyear_id, s.gradelevel_id, s.section_id, s.answer1, s.answer2,
					CONCAT('SY ',sy.schoolyear_start,' - ',sy.schoolyear_end) as schoolyear,
					g.gradelevel_name,
					c.section_name
			FROM `student_tbl` s 
			LEFT JOIN `schoolyear_tbl` sy ON sy.schoolyear_id = s.schoolyear_id
			LEFT JOIN `gradelevel_tbl` g ON g.gradelevel_id = s.gradelevel_id
			LEFT JOIN `section_tbl` c ON c.section_id = s.section_id
			WHERE s.username='{$uname}';";
    
    $auth = $mysqli->query($sql);
    
    if ($auth){
        $num_result = $auth->num_rows;
        if ($num_result){
            $row = $auth->fetch_object();
            $dbpass=$row->password;
            $dbuname=$row->username;
            $status=intval($row->status_id);
            
            if (!strcmp($dbuname,$uname)){                
            
                if (password_verify($upass,$dbpass)){
                    
                    if ($status==4){ //if active
                        $uid=$row->student_id;
                        $ufullname=strtoupper($row->firstname) . ' ' . strtoupper($row->lastname);
                        $ufname=strtoupper($row->firstname);                       
                        $ulname=strtoupper($row->lastname);
						$umname=strtoupper($row->middlename);
						$uename=strtoupper($row->extname);
						$schoolyear_id = $row->schoolyear_id;
						$gradelevel_id = $row->gradelevel_id;
						$section_id = $row->section_id;
						
						$schoolyear = $row->schoolyear;
						$gradelevel = $row->gradelevel_name;
						$section = $row->section_name;
						
						$answer1 = $row->answer1;
						$answer2 = $row->answer2;
                        
                        session_start();
                        $_SESSION['student_id']=$uid;
                        $_SESSION['student_fullname']=$ufullname;
                        $_SESSION['student_firstname']=$ufname; 
						$_SESSION['student_lastname']=$ulname;
						$_SESSION['student_middlename']=$umname;
						$_SESSION['student_extname']=$uename;
						$_SESSION['student_schoolyear_id']=$schoolyear_id;
						$_SESSION['student_gradelevel_id']=$gradelevel_id;
						$_SESSION['student_section_id']=$section_id;
						$_SESSION['student_schoolyear']=$schoolyear;
						$_SESSION['student_gradelevel']=$gradelevel;
						$_SESSION['student_section']=$section;                       
                        $_SESSION['answer1']=$answer1;
						$_SESSION['answer2']=$answer2; 
						
						if (!$answer1 || !$answer2){
							echo "security.php";
						}
						
                    }else{
                        echo "Error: Account is disabled!";            
                    }
                    
                }else{
                    echo "Error: Login Failed, Try Again!";
                }
            }else{
                echo "Error: Login Failed, Try Again!";
            }
            
        }else{
            echo "Error: Login Failed, Try Again!";
        }
    }else{
        echo "Error: Login Failed, Try Again!";
    }
    
    $mysqli->close();
?>