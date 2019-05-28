<?php	
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		
		case 7: //change password
			$user_id = intval($_POST['user_id']);
			$password = $mysqli->real_escape_string(trim($_POST['password']));
            $repassword = $mysqli->real_escape_string(trim($_POST['repassword']));
            			
			if ($user_id && $password && $repassword){
				if (strcmp($password,$repassword)==0){
                    $options = ['cost' => 12];
                    $hash_pass =  password_hash($password, PASSWORD_BCRYPT, $options);
                                        
                    $sql = "UPDATE user_tbl 
							SET password='{$hash_pass}'
                            WHERE user_id={$user_id};";
                            
                    $exec = $mysqli->query($sql);
                    
                    if ($exec){
                                                
                        include("user_query.php");
						$sql .= " WHERE u.user_id = {$user_id}; ";						
						include("user_populate.php");                   
                        
                    }else{
                        echo "Error: " . $mysqli->error;
                    }
                    
                }else{
                    echo "Error: Password does not match!";
                }
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;
			
		default:
			echo "Error: Critical Error Encountered!";
	}
	
	$mysqli->close();
?>