<?php
	//date_default_timezone_set("Asia/Manila");
    date_default_timezone_set("Asia/Manila");
    
    include ('connect.php');
    
    $uname = $mysqli->real_escape_string($_POST['uname']);
    $upass = $mysqli->real_escape_string($_POST['upass']); 
    
    $sql = "SELECT u.*, f.lastname, f.firstname 
			FROM `user_tbl` u 
			LEFT JOIN `faculty_tbl` f ON f.faculty_id = u.faculty_id
			WHERE u.username='{$uname}';";
    
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
                    
                    if ($status==1){ //if active
                        $uid=$row->user_id;
                        $ufullname=strtoupper($row->firstname) . ' ' . strtoupper($row->lastname);
                        $ufname=strtoupper($row->firstname);                       
                        $uaccess=$row->access_id;
                        
                        session_start();
                        $_SESSION['user_id']=$uid;
                        $_SESSION['user_fullname']=$ufullname;
                        $_SESSION['user_firstname']=$ufname;                       
                        $_SESSION['user_access']=$uaccess;
						
						if ($uaccess == 3){ //teacher
							echo "grade.php";
						}else if ($uaccess == 4) { //cashier
							echo "account.php";
						}else{
							echo "index.php";
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