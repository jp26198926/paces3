<?php
	include('param.php');
	include('connect.php');
	
	
	$action = intval($_POST['action']);
	
	switch($action){
		case 1: 			
			$gradelevel_id = $_POST['gradelevel_id'];
			
			if ($gradelevel_id){
				
				$sections = "";
				$subjects = "";
				
				//get section based from level
				$sql = "SELECT section_id, section_name FROM section_tbl  ";				
				$sql .= "WHERE gradelevel_id={$gradelevel_id} AND status_id=1 ORDER BY section_name;";
				
				$pop = $mysqli->query($sql);
				if ($pop){
					while ($row = $pop->fetch_object()){
						$section_id = $row->section_id;
						$section_name = $row->section_name;
						
						$sections .= "<option value='{$section_id}'>{$section_name}</option>";
					}
				}else{
					echo "Error: " . $mysqli->error;
				}
				
				echo $sections;
			}
			
			break;
			
		case 2: //search
			$schoolyear_id = intval($_POST['schoolyear_id']);
			$gradelevel_id = intval($_POST['gradelevel_id']);
			$section_id = intval($_POST['section_id']);
			$subject_id = intval($_POST['subject_id']);
			
			if ($schoolyear_id && $gradelevel_id && $section_id && $subject_id){
				include("grade_query.php");
				include("grade_populate.php");				
			}else{
				echo "Error: All dropdown fields must filled!";
			}
			
			break;
			
		case 3: //add
			$student_id = intval($_POST['student_id']);
			$quarter_no = intval($_POST['quarter_no']);	
			$schoolyear_id = intval($_POST['schoolyear_id']);
			$gradelevel_id = intval($_POST['gradelevel_id']);
			$section_id = intval($_POST['section_id']);			
			$subject_id = intval($_POST['subject_id']);
			$grade = floatval($_POST['grade']);
			
			if ($student_id && $quarter_no){
				if ($schoolyear_id && $gradelevel_id && $section_id && $subject_id && $grade > -1){
					//check if have record exist
					$sql = "SELECT grade_id FROM grade_tbl WHERE student_id={$student_id} AND subject_id={$subject_id};";
					$check = $mysqli->query($sql);
					if ($check){
						
						$sql = "";
						
						if ($check->num_rows > 0){ //with existing
							$sql = "UPDATE grade_tbl SET grade_quarter{$quarter_no}={$grade}
									WHERE student_id={$student_id} AND subject_id={$subject_id}; ";
						}else{ //not exit
							$sql = "INSERT INTO grade_tbl(student_id,subject_id,grade_quarter{$quarter_no})
									VALUES	({$student_id},{$subject_id},{$grade})";
						}
						
						$save = $mysqli->query($sql);
						if ($save){
							//re populate the list
							include("grade_query.php");
							include("grade_populate.php");	
						}else{
							echo "Error: " . $mysqli->error;
						}						
						
					}else{
						echo "Error: " . $mysqli->error;
					}
					
													
				}else{
					echo "Error: All fields are required!";
				}
			}else{
				echo "Error: Critical Error Encountered!";
			}
			break;
		
		case 4: //upload
			$schoolyear_id = intval($_POST['schoolyear_id']);
			$gradelevel_id = intval($_POST['gradelevel_id']);
			$section_id = intval($_POST['section_id']);
			$subject_id = intval($_POST['subject_id']);
			$quarter_id = intval($_POST['quarter_id']);

			if ($schoolyear_id && $gradelevel_id && $section_id){
				if ($gradelevel_id < 4 && !$quarter_id){ //1-3
					echo "Error: All fields are required!";
					exit();
				}elseif(($gradelevel_id >= 4 && $gradelevel_id < 7) && !$subject_id){ //4-6
					echo "Error: All fields are required!";
					exit();
				}

				ini_set('memory_limit', '-1');
				include("../library/PHPExcel-1.8/Classes/PHPExcel.php");
				include("grade_function.php");

				$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
	  
			   	if ($_FILES["file_grade_upload"]["error"] > 0){
		            echo "Error: " . $_FILES["file_grade_upload"]["error"];
		        }elseif (!in_array($_FILES["file_grade_upload"]["type"],$allowedFileType)){
		            echo "Error: File is not excel";
		        }else{
		        	$error = "";
		        	
		        	$has_student = false;

		        	$targetPath = '../uploads/'.$_FILES['file_grade_upload']['name'];
			        move_uploaded_file($_FILES['file_grade_upload']['tmp_name'], $targetPath);

			        $excelReader = PHPExcel_IOFactory::createReaderForFile($targetPath);
			        $excelReader->setReadDataOnly(true);
					$excelObj = $excelReader->load($targetPath);

					$sheetNames = $excelObj->getSheetNames();

					$sheet_count = 0;
					
					//loop to check for errors
					foreach ($sheetNames as $sheetNameIndex => $sheetName)
				    {			        
				        if ((in_array(strtoupper(trim($sheetName)), array("INPUT DATA","SUMMARY OF QUARTERLY GRADES","DO NOT DELETE")))){
				        	continue; //skip not necessary sheets
				        }else{
				        	$sheet_count++;

				        	//check grade level
				        	if ($gradelevel_id <= 3){ //grade 1 - 3

				        		$subject_id = get_subject_id(trim($sheetName)); 

				        		if ($subject_id){ //subject exist
				        			
					        		$worksheet =   $excelObj->setActiveSheetIndexByName($sheetName);
									$lastRow = $worksheet->getHighestRow();							

									for ($row = 11; $row <= $lastRow; $row++) { //row 11 start the gender description
										$student = $worksheet->getCell('B'.$row)->getCalculatedValue();	
										$final_grade = $worksheet->getCell('AJ'.$row)->getCalculatedValue();	
										
										if ((in_array(strtolower(trim($student)), array("male","female","")))){
											continue; //skip not student name
										}else{
											$has_student = true;
											$student_id = get_student_id(trim($student),  $schoolyear_id, $gradelevel_id, $section_id);
																						
											if ($student_id){ //student exist
												if (floatval($final_grade) <= 0){												
													$error .= $student  . " has no grade in " . $sheetName . "<br />";
												}
											}else{
												$error .= "Student NOT in DB: " . $student . "<br />";
											}
										}													
									}

								}else{
									$error .= "Subject NOT in DB: " .  $sheetName . "<br />";
								}

				        	}elseif ($gradelevel_id >3 && $gradelevel_id <=6) { //grade 4 - 6			        		
				        		# code...
				        		$subject_id = get_subject_id(trim($sheetName)); 

				        		if ($subject_id){ //subject exist
				        			$error .= "Invalid Sheet for Grade 4-5: " .  $sheetName . "<br />";
				        		}else{
				        			$worksheet =   $excelObj->setActiveSheetIndexByName($sheetName);
									$lastRow = $worksheet->getHighestRow();							

									for ($row = 11; $row <= $lastRow; $row++) { //row 11 start the gender description
										$student = $worksheet->getCell('B'.$row)->getCalculatedValue();	
										$final_grade = $worksheet->getCell('AJ'.$row)->getCalculatedValue();	
											
										if ((in_array(strtolower(trim($student)), array("male","female","")))){
											continue; //skip not student name
										}else{
											$has_student = true;
											$student_id = get_student_id(trim($student),  $schoolyear_id, $gradelevel_id, $section_id);										
											if (!$student_id){ //student exist											
												$error .= "Student NOT exist: " . $student . "<br />";
											}
										}													
									}
								}
				        	}else{
				        		$error .= "Invalid Grade Level!";
				        	}
				        }
				    }

				    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

				    //
					//check if the file has student in the list
					if (!$has_student){
						$error .= "There is no Student in the file you uploaded!";
					}			
									
					//if no error then loop to save to database
					if ($error){
						echo "Error: Please correct the following error/s: <br /><br />" . $error;
					}else{

						//loop to start saving to database					
						foreach ($sheetNames as $sheetNameIndex => $sheetName)
					    {			        
					        if ((in_array(strtoupper(trim($sheetName)), array("INPUT DATA","SUMMARY OF QUARTERLY GRADES","DO NOT DELETE")))){
					        	continue; //skip not necessary sheets
					        }else{

					        	//check grade level
					        	if ($gradelevel_id <= 3){ //grade 1 - 3

					        		$subject_id = get_subject_id(trim($sheetName)); 

					        		if ($subject_id){ //subject exist
					        			
						        		$worksheet =   $excelObj->setActiveSheetIndexByName($sheetName);
										$lastRow = $worksheet->getHighestRow();							

										for ($row = 11; $row <= $lastRow; $row++) { //row 11 start the gender description
											$student = $worksheet->getCell('B'.$row)->getCalculatedValue();	
											$quarter_grade = $worksheet->getCell('AJ'.$row)->getCalculatedValue();	
											
											if ((in_array(strtolower(trim($student)), array("male","female","")))){
												continue; //skip not student name
											}else{
												$student_id = get_student_id(trim($student),  $schoolyear_id, $gradelevel_id, $section_id);										

												if ($student_id){ //student exist
													$has_student = true;

													if (doubleval($quarter_grade) <= 0){												
														$error .= $student  . " has no grade in " . $sheetName . "<br />";
													}else{
														//check if student has grade already
														$grade_id = is_grade_exist($student_id, $subject_id, $quarter_id);
														
														if ($grade_id){
															//update
															$update = update_grade($grade_id, $quarter_grade, $user_id);
															
															if (!$update){
																$error .= "Error: Unable to update grade of " . $Student . " for " . $sheetName . "<br />";
															}	
														}else{
															//insert
															$save = save_grade($student_id, $subject_id, $quarter_id, $quarter_grade, $user_id);
															if (!$save){
																$error .= "Error: Unable to save the grade of " . $Student . " for " . $sheetName . "<br />";
															}
														}						
													}
												}else{
													$error .= "Student NOT in DB: " . $student . "<br />";
												}
											}													
										}

									}else{
										$error .= "Subject NOT in DB: " .  $sheetName . "<br />";
									}

					        	
					        	}elseif ($gradelevel_id >3 && $gradelevel_id <=6) { //grade 4 - 6			        		
					        		# code...
					        		$quarter_id = $sheet_count;

					        		$worksheet =   $excelObj->setActiveSheetIndexByName($sheetName);
									$lastRow = $worksheet->getHighestRow();							

									for ($row = 11; $row <= $lastRow; $row++) { //row 11 start the gender description
										$student = $worksheet->getCell('B'.$row)->getCalculatedValue();	
										$quarter_grade = $worksheet->getCell('AJ'.$row)->getCalculatedValue();	
											
										if ((in_array(strtolower(trim($student)), array("male","female","")))){
											continue; //skip not student name
										}else{
											$student_id = get_student_id(trim($student),  $schoolyear_id, $gradelevel_id, $section_id);										

											if ($student_id){ //student exist
												$has_student = true;

												if (doubleval($quarter_grade) > 0){												
														
													//check if student has grade already
													$grade_id = is_grade_exist($student_id, $subject_id, $quarter_id);
														
													if ($grade_id){
														//update
														$update = update_grade($grade_id, $quarter_grade, $user_id);
															
														if (!$update){
															$error .= "Error: Unable to update grade of " . $Student . " for Quarter " . $quarter_id . "<br />";
														}	
													}else{
														//insert
														$save = save_grade($student_id, $subject_id, $quarter_id, $quarter_grade, $user_id);
														if (!$save){
															$error .= "Error: Unable to save the grade of " . $Student . " for Quarter " . $quarter_id . "<br />";
														}
													}						
												}
											}else{
												$error .= "Student NOT in DB: " . $student . "<br />";
											}	
										}
									}
					        		
					        	}else{
					        		$error .= "Invalid Grade Level!";
					        	}
					        }
					    }

					    if ($error){
							echo "Error: Please correct the following error/s: <br /><br />" . $error;
						}else{
							echo "Successfull";
						}				
					}
		        }
			}else{
				echo "Error: All fields are required!";
			}
	       
			break;
					
		default:
			echo "Error: Critical Error Encountered!";
	}
	
	$mysqli->close();
?>