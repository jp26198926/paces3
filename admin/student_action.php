<?php
	session_start();
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: //search by id
			$id = intval($_POST['id']);
			
			include("student_query.php");
			
			$sql .= " WHERE s.student_id={$id} AND (s.status_id < 4 OR s.status_id = 5)  ";
			$sql .= " ORDER BY s.lastname, s.firstname, s.middlename, s.extname;";
			
			include("student_populate.php");
			
			break;
		
		case 2: //wildcard search
			$search = $_POST['search'];
			
			include("student_query.php");
			
			$sql .= " WHERE (s.status_id < 4 OR s.status_id = 5) AND
							CONCAT_WS(s.lrn_no, s.lastname, s.firstname, s.middlename, s.extname, 
							g.gender,l.gradelevel_name,
							c.section_name,
							y.schoolyear_start, y.schoolyear_end, st.status) 
					  LIKE '%{$search}%' ";
			
			$sql .= " ORDER BY s.lastname, s.firstname, s.middlename, s.extname;";
			
			include("student_populate.php");
			
			break;
		
		case 3: //add
			$lrn = $_POST["lrn"];
			$sy = intval($_POST["sy"]);
			$gradelevel = intval($_POST["gradelevel"]);
			$firstname = $_POST["firstname"];
			$lastname = $_POST["lastname"];
			$middlename = $_POST["middlename"];
			$extname = $_POST["extname"];
			$gender = $_POST["gender"];
			$birthday = $_POST["birthday"];
			$birthplace = $_POST["birthplace"];
			$address = $_POST["address"];
			$last_school_attended = $_POST["last_school_attended"];
			$grade_completed = intval($_POST["grade_completed"]);
			$general_average = floatval($_POST["general_average"]);
			$guardians_name = $_POST["guardians_name"];
			$guardians_contact = $_POST["guardians_contact"];
			$fathers_name = $_POST["fathers_name"];
			$fathers_occupation = $_POST["fathers_occupation"];
			$fathers_contact = $_POST["fathers_contact"];
			$fathers_religion = $_POST["fathers_religion"];
			$mothers_mname = $_POST["mothers_mname"];
			$mothers_occupation = $_POST["mothers_occupation"];
			$mothers_contact = $_POST["mothers_contact"];
			$mothers_religion = $_POST["mothers_religion"];			

			//
			
			if ($sy && $gradelevel && $firstname && $lastname && $middlename){
				$sql = "INSERT INTO student_tbl(
													lrn_no,
													schoolyear_id,
													gradelevel_id,
													firstname,
													lastname,
													middlename,
													extname,
													gender,
													birthdate,
													birthplace,
													address,
													last_school,
													grade_completed,
													gen_average,
													guardians_name,
													guardians_contact,
													fathers_name,
													fathers_occupation,
													fathers_contact,
													fathers_religion,
													mothers_mname,
													mothers_occupation,
													mothers_contact,
													mothers_religion
												)
						VALUES(	'{$lrn}',
								{$sy},
								{$gradelevel},
								'{$firstname}',
								'{$lastname}',
								'{$middlename}',
								'{$extname}',
								{$gender},
								'{$birthday}',
								'{$birthplace}',
								'{$address}',
								'{$last_school_attended}',
								{$grade_completed},
								{$general_average},
								'{$guardians_name}',
								'{$guardians_contact}',
								'{$fathers_name}',
								'{$fathers_occupation}',
								'{$fathers_contact}',
								'{$fathers_religion}',
								'{$mothers_mname}',
								'{$mothers_occupation}',
								'{$mothers_contact}',
								'{$mothers_religion}');";
				
				$save = $mysqli->query($sql);
				if ($save){
					echo $mysqli->insert_id;
				}else{
					echo "Error: " . $mysqli->error;
				}
				
			}else{
				echo "Error: Firstname, Lastname, Middlename, SY and Grade Level are required field!";
			}
			
			break;
		
		case 4: //update
			$student_id = intval($_POST['student_id']);
			
			if ($student_id){
				$lrn = $_POST["lrn"];
				$sy = intval($_POST["sy"]);
				$gradelevel = intval($_POST["gradelevel"]);
				$firstname = $_POST["firstname"];
				$lastname = $_POST["lastname"];
				$middlename = $_POST["middlename"];
				$extname = $_POST["extname"];
				$gender = $_POST["gender"];
				$birthday = $_POST["birthday"];
				$birthplace = $_POST["birthplace"];
				$address = $_POST["address"];
				$last_school_attended = $_POST["last_school_attended"];
				$grade_completed = intval($_POST["grade_completed"]);
				$general_average = floatval($_POST["general_average"]);
				$guardians_name = $_POST["guardians_name"];
				$guardians_contact = $_POST["guardians_contact"];
				$fathers_name = $_POST["fathers_name"];
				$fathers_occupation = $_POST["fathers_occupation"];
				$fathers_contact = $_POST["fathers_contact"];
				$fathers_religion = $_POST["fathers_religion"];
				$mothers_mname = $_POST["mothers_mname"];
				$mothers_occupation = $_POST["mothers_occupation"];
				$mothers_contact = $_POST["mothers_contact"];
				$mothers_religion = $_POST["mothers_religion"];
				
				if ($sy && $gradelevel && $firstname && $lastname && $middlename){
					$sql = "UPDATE student_tbl SET
													lrn_no = '{$lrn}',
													schoolyear_id = {$sy},
													gradelevel_id = {$gradelevel},
													firstname = '{$firstname}',
													lastname = '{$lastname}',
													middlename = '{$middlename}',
													extname = '{$extname}',
													gender = {$gender},
													birthdate = '{$birthday}',
													birthplace = '{$birthplace}',
													address = '{$address}',
													last_school = '{$last_school_attended}',
													grade_completed = {$grade_completed},
													gen_average = {$general_average},
													guardians_name = '{$guardians_name}',
													guardians_contact = '{$guardians_contact}',
													fathers_name = '{$fathers_name}',
													fathers_occupation = '{$fathers_occupation}',
													fathers_contact = '{$fathers_contact}',
													fathers_religion = '{$fathers_religion}',
													mothers_mname = '{$mothers_mname}',
													mothers_occupation = '{$mothers_occupation}',
													mothers_contact = '{$mothers_contact}',
													mothers_religion = '{$mothers_religion}'
							WHERE student_id={$student_id};";
					
					$save = $mysqli->query($sql);
					if ($save){
						echo $student_id;
					}else{
						echo "Error: " . $mysqli->error;
					}
					
				}else{
					echo "Error: Firstname, Lastname, Middlename, SY and Grade Level are required field!";
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			
			break;
			
		case 5: //get student info
			$student_id = intval($_POST['student_id']);
			
			if ($student_id > 0){
				
				$sql = "SELECT  s.student_id, CONCAT(s.lastname, ', ', s.firstname, ' ', s.middlename, ' ', s.extname) as student_name,
								l.gradelevel_name,
								CONCAT('SY ', y.schoolyear_start, '-', y.schoolyear_end) as sy
						FROM student_tbl s 
						LEFT JOIN gradelevel_tbl l ON l.gradelevel_id = s.gradelevel_id
						LEFT JOIN schoolyear_tbl y ON y.schoolyear_id = s.schoolyear_id
						WHERE student_id={$student_id};";
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
		
		case 6: //enroll
			$student_id = $_POST['student_id'];
			$section_id = $_POST['section_id'];
			$current_date = date('Y-m-d');
			$username = $mysqli->real_escape_string(trim($_POST['username'] . ''));            
            $password = $mysqli->real_escape_string(trim($_POST['password']));
            $repassword = $mysqli->real_escape_string(trim($_POST['repassword']));
			
			if ($student_id){
				if ($section_id && $username && $password && $repassword){
					if (strcmp($password,$repassword)==0){
						$options = ['cost' => 12];
						$hash_pass =  password_hash($password, PASSWORD_BCRYPT, $options);
						$sql = "UPDATE student_tbl 
								SET date_enrolled='{$current_date}', section_id={$section_id}, 
									status_id=4, username='{$username}', password='{$hash_pass}'
								WHERE student_id={$student_id};";
								
						$save = $mysqli->query($sql);
						if ($save){
							//get guardian contact # for SMS notification
							$sql_student = "SELECT lastname, firstname, middlename, guardians_contact FROM student_tbl WHERE student_id='{$student_id}';";

							$get = $mysqli->query($sql_student);
							if ($get){
								$get_row = $get->fetch_assoc();
								
								echo json_encode($get_row);
							}

							echo "~:||:~";

							//populate updated row list
							include("student_query.php");
				
							$sql .= " WHERE s.student_id={$student_id}; ";
							include("student_populate_row.php");
							
						}else{
							echo "Error: " . $mysqli->error;
						}
					}else{
						echo "Error: Password does not match!";
					}
				}else{
					echo "Error: Fields with red asterisk are required!";
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;

		case 7: //validate captcha
			$captcha = $_POST['captcha'];

			require_once '../library/securimage/securimage.php';
            $securimage = new Securimage();

            if ($securimage->check($captcha) == false) {
                echo 'Error: Incorrect CAPTCHA!';
            }

			break;

		case 8: //check lrn
			$lrn_no = $_POST['lrn_no'];

			if ($lrn_no){
				//include("student_query.php");
			
				$sql = "SELECT s.* from student_tbl s WHERE s.lrn_no='{$lrn_no}' AND s.status_id=4
				        ORDER BY s.student_id DESC 
				        LIMIT 1; ";
				
				$pop = $mysqli->query($sql);
				if ($pop){
					$count = $pop->num_rows;

					if ($count > 0){
						echo json_encode($pop->fetch_assoc());
					}else{
						echo "Error: LRN Number not found!";
					}
				}else{
					echo "Error: " . $mysqli->error;
				}

			}else{
				echo "Error: Please enter LRN Number!";
			}
			break;

		case 9: //cancel registion
			$student_id = $_POST['student_id'];
			$reason = $mysqli->real_escape_string($_POST['reason'] . '');
			$user_id = $_SESSION['user_id'];
			$current_dt = date('Y-m-d H:i:s');

			if ($student_id){
				if ($reason){
					$sql = "UPDATE student_tbl 
							SET 
								cancelled_by={$user_id}, 
								dt_cancelled='{$current_dt}', 
								cancelled_reason='{$reason}',
								status_id=5
							WHERE student_id={$student_id};";

					$save = $mysqli->query($sql);
					if ($save){
						echo $student_id;
					}else{
						echo "Error: " . $mysqli->error;
					}
				}else{
					echo "Error: Please provide a reason!";
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