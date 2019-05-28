<?php
	//date_default_timezone_set("Asia/Manila");
    date_default_timezone_set("Asia/Manila");
    
    include ('connect.php');
    
			$username = $mysqli->real_escape_string(trim($_POST['username'] . ''));            
			$password = $mysqli->real_escape_string(trim($_POST['password']));
            $repassword = $mysqli->real_escape_string(trim($_POST['repassword']));
            $answer1 = $mysqli->real_escape_string(trim($_POST['answer1']));
			$answer2 = $mysqli->real_escape_string(trim($_POST['answer2']));
            
            if ($username  && $password && $repassword && $answer1 && $answer2){
                if (strcmp($password,$repassword)==0){
                    $options = ['cost' => 12];
                    $hash_pass =  password_hash($password, PASSWORD_BCRYPT, $options);
                                        
                    $sql = "UPDATE student_tbl SET password='{$hash_pass}'
							WHERE username='{$username}' AND answer1='{$answer1}' AND answer2='{$answer2}';";
                            
                    $exec = $mysqli->query($sql);
                    
                    if ($exec){
						if ($mysqli->affected_rows < 1){
							echo "Error: Change Password Failed!";
                        }
                    }else{
                        echo "Error: " . $mysqli->error;
                    }
                    
                }else{
                    echo "Error: Password does not match!";
                }
            }else{
                echo "Error: All fields are required!";    
            }       
    
    $mysqli->close();
?>