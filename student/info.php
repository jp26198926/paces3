<?php
	include('param.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            
			<?php
				include('top.php');
				include('sidebar.php');
			?>            
			
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Personal Information <small></small>							
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->
				
				<!-- Page Body -->
				
				<div class="row">
								
								<div class="col-md-6">
									<div class="form-group">
										<label>LRN Number</label>
										<input type="text" name="LRN_Number" id="lrn_no_update" class="form-control enrolled_field" onkeypress="return isNumberKey(event)" placeholder="LRN Number" >
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>School Year</label>
										<select id="sy_update" class="form-control enrolled_field">
											<option value="0">-- School Year --</option>
											<?php
												include('connect.php');
												$sql = "SELECT schoolyear_id, CONCAT('SY ',schoolyear_start,'-',schoolyear_end) as school_year FROM schoolyear_tbl ORDER BY schoolyear_start";
												$pop = $mysqli->query($sql);
												
												if ($pop){
													while($row = $pop->fetch_object()){
														$schoolyear_id = $row->schoolyear_id;
														$school_year = $row->school_year;
														
														echo "<option value='{$schoolyear_id}'>{$school_year}</option>";
													}
												}else{
													echo $mysqli->error;
												}
												
												$mysqli->close();
											?>
										</select>
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>Grade Level</label>
										<select id="gradelevel_update" class="form-control enrolled_field">
											<option value="0">-- Grade Level --</option>
											<?php
												include('connect.php');
												$sql = "SELECT gradelevel_id, gradelevel_name FROM gradelevel_tbl ORDER BY gradelevel_name";
												$pop = $mysqli->query($sql);
												
												if ($pop){
													while($row = $pop->fetch_object()){
														$gradelevel_id = $row->gradelevel_id;
														$gradelevel_name = $row->gradelevel_name;
														
														echo "<option value='{$gradelevel_id}'>{$gradelevel_name}</option>";
													}
												}else{
													echo $mysqli->error;
												}
												
												$mysqli->close();
											?>
										</select>
									</div>
								</div>
								
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
										<label>Firstname</label>
										<input type="text" name="FirstName" id="firstname_update" class="form-control enrolled_field" placeholder="First Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
										<label>Middlename</label>
										<input type="text" name="MiddleName" id="middlename_update" class="form-control enrolled_field" placeholder="Middle Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
										<label>Lastname</label>
										<input type="text" name="LastName" id="lastname_update" class="form-control enrolled_field" placeholder="Last Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
										<label>Extension</lable>
										<input type="text" name="ExtName" id="extname_update" class="form-control enrolled_field" placeholder="Ext." >
									</div>
								</div>
							</div>					
					
					
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Gender</label>
										<select  id="gender_update" class="form-control enrolled_field">
											<option value="0">-- Gender --</option>
											<option value="1">Male</option>	
											<option value="2">Female</option>
										</select>
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>Birthday</label>
										<input type="date" name="Birthday" id="birthday_update" class="form-control enrolled_field" >
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label>Birth Place</label>
										<input type="text" name="BirthPlace" id="birthplace_update" class="form-control enrolled_field" placeholder="Birth Place" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Address</label>
										<input type="text" name="Address" id="address_update" class="form-control enrolled_field" placeholder="Address" >
									</div>
								</div>
							</div>
							
							<hr />
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>last School Attended</label>
										<input type="text" name="LastSchoolAttended" id="lastschoolattended_update" class="form-control enrolled_field" placeholder="Last School Attended" >
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>Grade Completed</label>
										<select id="grade_completed_update" class="form-control enrolled_field">
											<option value="0">-- Grade Completed --</option>
											<?php
												include('admin/connect.php');
												$sql = "SELECT gradelevel_id, gradelevel_name FROM gradelevel_tbl ORDER BY gradelevel_name";
												$pop = $mysqli->query($sql);
												
												if ($pop){
													while($row = $pop->fetch_object()){
														$gradelevel_id = $row->gradelevel_id;
														$gradelevel_name = $row->gradelevel_name;
														
														echo "<option value='{$gradelevel_id}'>{$gradelevel_name}</option>";
													}
												}else{
													echo $mysqli->error;
												}
												
												$mysqli->close();
											?>
										</select>
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>General Average</label>
										<input type="text" name="GeneralAverage" id="generalaverage_update" class="form-control enrolled_field" placeholder="General Average" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-6 col-md-6">
									<div class="form-group has-error">
										<label>Guardian's Name</label>
										<input type="text" name="GuardiansName" id="guardiansname_update" class="form-control enrolled_field" placeholder="Guardian's Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-6 col-md-6">
									<div class="form-group has-error">
										<label>Guardian's Contact</label>
										<input type="text" onkeypress="return isNumberKey(event)" name="GuardiansContact" id="guardianscontact_update" class="form-control enrolled_field" placeholder="Contact Number" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Father's Name</label>
										<input type="text" name="FathersName" id="fathersname_update" class="form-control enrolled_field" placeholder="Father's Name" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label>Father's Occupation</label>
										<input type="text" name="FathersOccupation" id="fathersoccupation_update" class="form-control enrolled_field" placeholder="Father's Occupation" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label>Father's Contact</label>
										<input type="text" onkeypress="return isNumberKey(event)" name="FathersContact" id="fatherscontact_update" class="form-control enrolled_field" placeholder="Father's Contact Number" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label>Father's Religion</label>
										<input type="text" name="FathersReligion" id="fathersreligion_update" class="form-control enrolled_field" placeholder="Father's Religion" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Mother's Name</label>
										<input type="text" name="MothersMName" id="mothersmname_update" class="form-control enrolled_field" placeholder="Mother's Maiden Name" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label>Mother's Occupation</label>
										<input type="text" name="MothersOccupation" id="mothersoccupation_update" class="form-control enrolled_field" placeholder="Mother's Occupation" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label>Mother's Contact</label>
										<input type="text" onkeypress="return isNumberKey(event)" name="MothersContact" id="motherscontact_update" class="form-control enrolled_field" placeholder="Mother's Contact Number" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label>Mother's Religion</label>
										<input type="text" name="MothersReligion" id="mothersreligion_update" class="form-control enrolled_field" placeholder="Mother's Religion" >
									</div>
								</div>
							</div> 
							
							<div class="row ">
								<div class="col-md-4" ></div>
								<div class="col-md-4 text-center" >	
									<button type="btn" id="btn_update" class="btn btn-success" >Update</button>
								</div>
								<div class="col-md-4 " ></div>
							</div>
                
                <!-- /.row -->
				
				<?php include('footer.php'); ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	
	<!-- custom script -->
	<script>
		$(document).on('keypress','.numeric', function(e){
				
			if ((e.which < 48 && e.which != 46 && e.which !=45) || e.which > 57) {
				return false;
			}else if (e.which == 46){
				if ($(this).val().indexOf('.') > -1) {
					return false;
				}
			}else if (e.which == 45){ //negative sign
				var occurrence = $(this).val().indexOf('-');
				var cursor = document.getElementById($(this).attr('id')).selectionStart;
					
				if (cursor > 0 || occurrence > -1) {
					return false;
				}
			}
		});
			
		$(document).on('blur','.numeric',function(e){
			e.preventDefault();
			if ($(this).val().length === 0) {
				$(this).val('0.00');
			}
		});
	
		$(document).ready(function(){
				$.post("info_action.php",{action:1},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						data = JSON.parse(data);						
						
						$(".enrolled_field").attr('disabled','disabled');						
						
						$("#lrn_no_update").val(data["lrn_no"]);
						$("#sy_update").val(data["schoolyear_id"]);
						$("#gradelevel_update").val(data["gradelevel_id"]);
						$("#firstname_update").val(data["firstname"]);
						$("#lastname_update").val(data["lastname"]);
						$("#middlename_update").val(data["middlename"]);
						$("#extname_update").val(data["extname"]);
						$("#gender_update").val(data["gender"]);
						$("#birthday_update").val(data["birthdate"]);
						$("#birthplace_update").val(data["birthplace"]);
						$("#address_update").val(data["address"]);
						$("#lastschoolattended_update").val(data["last_school"]);
						$("#grade_completed_update").val(data["grade_completed"]);
						$("#generalaverage_update").val(data["gen_average"]);
						$("#guardiansname_update").val(data["guardians_name"]).removeAttr('disabled');
						$("#guardianscontact_update").val(data["guardians_contact"]).removeAttr('disabled');
						$("#fathersname_update").val(data["fathers_name"]);
						$("#fathersoccupation_update").val(data["fathers_occupation"]);
						$("#fatherscontact_update").val(data["fathers_contact"]);
						$("#fathersreligion_update").val(data["fathers_religion"]);
						$("#mothersmname_update").val(data["mothers_name"]);
						$("#mothersoccupation_update").val(data["mothers_occupation"]);
						$("#motherscontact_update").val(data["mothers_contact"]);
						$("#mothersreligion_update").val(data["mothers_religion"]);						
						
					}
				});
		});
		
		$(document).on("click","#btn_update",function(){
			var action = 2			
			var lrn = $("#lrn_no_update").val();
			var sy = parseInt($("#sy_update").val());
			var gradelevel = parseInt($("#gradelevel_update").val());
			var firstname = $("#firstname_update").val();
			var lastname = $("#lastname_update").val();
			var middlename = $("#middlename_update").val();
			var extname = $("#extname_update").val();
			var gender = $("#gender_update").val();
			var birthday = $("#birthday_update").val();
			var birthplace = $("#birthplace_update").val();
			var address = $("#address_update").val();
			var last_school_attended = $("#lastschoolattended_update").val();
			var grade_completed = $("#grade_completed_update").val();
			var general_average = $("#generalaverage_update").val();
			var guardians_name = $("#guardiansname_update").val();
			var guardians_contact = $("#guardianscontact_update").val();
			var fathers_name = $("#fathersname_update").val();
			var fathers_occupation = $("#fathersoccupation_update").val();
			var fathers_contact = $("#fatherscontact_update").val();
			var fathers_religion = $("#fathersreligion_update").val();
			var mothers_mname = $("#mothersmname_update").val();
			var mothers_occupation = $("#mothersoccupation_update").val();
			var mothers_contact = $("#motherscontact_update").val();
			var mothers_religion = $("#mothersreligion_update").val();
			
			
			
				if (sy && gradelevel && firstname && lastname && middlename){
					$.post("info_action.php",{
						action:action,
						lrn:lrn,
						sy:sy,
						gradelevel:gradelevel,
						firstname:firstname,
						lastname:lastname,
						middlename:middlename,
						extname:extname,
						gender:gender,
						birthday:birthday,
						birthplace:birthplace,
						address:address,
						last_school_attended:last_school_attended,
						grade_completed:grade_completed,
						general_average:general_average,
						guardians_name:guardians_name,
						guardians_contact:guardians_contact,
						fathers_name:fathers_name,
						fathers_occupation:fathers_occupation,
						fathers_contact:fathers_contact,
						fathers_religion:fathers_religion,
						mothers_mname:mothers_mname,
						mothers_occupation:mothers_occupation,
						mothers_contact:mothers_contact,
						mothers_religion:mothers_religion
					},function(data){
						
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							alert("Successfully Saved!");
						}
					});
				}else{				
					alert("Error: Firstname, Lastname, Middlename, SY and Grade Level are required field!");
				}
			
		});
		
		
		
		
		
	$(document).on("click",".btn_modify_password",function(e){
			e.preventDefault();
			
			var user_id = $(this).attr("id");
			if (user_id){
				$(".user_id").val(user_id);
				$("#txt_password_update, #txt_repassword_update").val("");
				
				$("#user_changepassword").modal();
				$("#txt_password_update").select().focus();
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on('click','#btn_update_password',function(){
			var user_id = $(".user_id").val();			
			var password = $("#txt_password_update").val();
			var repassword = $("#txt_repassword_update").val();
						
			if (user_id) {
				
				if (password == repassword){
													
					$.post("user_action.php",{action:7, user_id:user_id, password:password, repassword:repassword}, function(data){
									
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1){								
							alert(data)
						}else{								
							if (data){
								$("#tbl_user tbody").html(data);									
							}else{
								$("#tbl_user tbody").html("<tr><td align='center' colspan='8'>No Record to display</td></tr>");
							}								
										
							$("#user_changepassword").modal('hide');									
							$('[data-toggle="tooltip"]').tooltip({html:true});
							
							alert("Successfully changed!");
						}
					});							
				}else{
					alert("Error: Password does not matched!");	
				}	
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
	</script>

	<!-- change password modal -->
	<?php include("user_changepassword.php"); ?>
	
	

</body>

</html>
