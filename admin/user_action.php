<?php	
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //search
			$search = $_POST['search'];
			
			include("user_query.php");
			$sql .= " WHERE u.username LIKE '%{$search}%' ";
			$sql .= " ORDER BY u.username;";
			include("user_populate.php");
			
			break;
			
		case 2: //add			
			$username = $mysqli->real_escape_string(trim($_POST['username'] . ''));            
            $password = $mysqli->real_escape_string(trim($_POST['password']));
            $repassword = $mysqli->real_escape_string(trim($_POST['repassword']));
            $access_id = $_POST['access_id'];
			$faculty_id = $_POST['faculty_id'];
            
            if ($username  && $password && $repassword && $access_id && $faculty_id){
                if (strcmp($password,$repassword)==0){
                    $options = ['cost' => 12];
                    $hash_pass =  password_hash($password, PASSWORD_BCRYPT, $options);
                                        
                    $sql = "INSERT INTO user_tbl (username,password,access_id,faculty_id,created_by)
                            VALUES ('{$username}','{$hash_pass}',{$access_id},{$faculty_id},{$user_id});";
                            
                    $exec = $mysqli->query($sql);
                    
                    if ($exec){
                        $user_id = $mysqli->insert_id;
                        
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
                echo "Error: Fields with red asterisk are required!";    
            }       
			break;
		
		case 3: //get user info
			$user_id = $_POST['user_id'];
			
			if ($user_id){
				$sql = "SELECT u.*, f.designation 
						FROM user_tbl u 
						LEFT JOIN faculty_tbl f ON f.faculty_id = u.faculty_id
						WHERE u.user_id={$user_id}";
						
				$pop = $mysqli->query($sql);
				if ($pop){
					$data = $pop->fetch_assoc();
					echo json_encode($data);
				}else{
					echo "Error: " . $mysqli->error;
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;
		
		case 4: //update
			$user_id = $_POST['user_id'];
			$username = $mysqli->real_escape_string(trim($_POST['username'] . ''));
            $access_id = $_POST['access_id'];
			$faculty_id = $_POST['faculty_id'];
            
            if ($user_id && $username && $access_id && $faculty_id){
                                   
                $sql = "UPDATE user_tbl 
						SET username='{$username}',
							access_id={$access_id},
							faculty_id={$faculty_id}
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
                echo "Error: Fields with red asterisk are required!";    
            }       
			break;
		
		case 5: //change status
			$user_id = $_POST['user_id'];			
			$status_id = $_POST['status_id'];
			
			if ($user_id && $user_id && $status_id){
				$sql = "UPDATE user_tbl SET status_id={$status_id} WHERE user_id={$user_id};";
				
				$update = $mysqli->query($sql);
				if ($update){
					
					include("user_query.php");
					$sql .= " WHERE u.user_id = {$user_id}; ";						
					include("user_populate.php");   
					
				}else{
					echo "Error: " . $mysqli->error;
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;
		
		case 6: //autocomplete designation
			$faculty_id = $_POST['faculty_id'];
			
			if ($faculty_id){
				$sql = "SELECT designation FROM faculty_tbl WHERE faculty_id={$faculty_id};";
				$pop = $mysqli->query($sql);
				
				if ($pop){
					$data = $pop->fetch_assoc();
					echo json_encode($data);
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;
		
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