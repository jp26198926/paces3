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
                            Student <small>New Entry</small>							
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->
				
				<!-- Page Body -->
                <div class="row">
                    <div class="col-lg-12">                        
						<!--<form role="form" method="post" action="register_action.php" name="Registration"  enctype="multipart/form-data" onSubmit = "return validateForm()">-->
							<div class="row">
								<input id="student_id" type="hidden" value="0" />
								
								<div class="col-xs-6">
									<div class="form-group">
										<input type="text" name="LRN_Number" id="lrn_number" class="form-control" onkeypress="return isNumberKey(event)" placeholder="LRN Number" >
									</div>
								</div>
								
								<div class="col-xs-3">
									<div class="form-group">
										<select id="sy" class="form-control">
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
								
								<div class="col-xs-3">
									<div class="form-group">
										<select id="gradelevel" class="form-control">
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
								<div class="col-xs-12 col-sm-3 col-md-3">
									<div class="form-group">
										<input type="text" name="FirstName" id="FirstName" class="form-control" placeholder="First Name" >
									</div>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3">
									<div class="form-group">
										<input type="text" name="MiddleName" id="MiddleName" class="form-control" placeholder="Middle Name" >
									</div>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3">
									<div class="form-group">
										<input type="text" name="LastName" id="LastName" class="form-control " placeholder="Last Name" >
									</div>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3">
									<div class="form-group">
										<input type="text" name="ExtName" id="ExtName" class="form-control " placeholder="Ext." >
									</div>
								</div>
							</div>					
					
					
							<div class="row">
								<div class="col-xs-3">
									<div class="form-group">
										<select  id="gender" class="form-control">
											<option value="0">-- Gender --</option>
											<option value="1">Male</option>	
											<option value="2">Female</option>
										</select>
									</div>
								</div>
								
								<div class="col-xs-1 text-right">
									<div class="form-group">
										Birth Day
									</div>
								</div>
								<div class="col-xs-2">
									<div class="form-group">
										<input type="date" name="Birthday" id="Birthday" class="form-control">
									</div>
								</div>
								
								<div class="col-xs-6">
									<div class="form-group">
										<input type="text" name="BirthPlace" id="BirthPlace" class="form-control " placeholder="Birth Place" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<input type="text" name="Address" id="Address" class="form-control " placeholder="Address" >
									</div>
								</div>
							</div>
							
							<hr />
							
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<input type="text" name="LastSchoolAttended" id="LastSchoolAttended" class="form-control " placeholder="Last School Attended" >
									</div>
								</div>
								
								<div class="col-xs-3">
									<div class="form-group">
										<select id="grade_completed" class="form-control">
											<option value="0">-- Grade Completed --</option>
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
								
								<div class="col-xs-3">
									<div class="form-group">
										<input type="text" name="GeneralAverage" id="GeneralAverage" class="form-control " placeholder="General Average" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="GuardiansName" id="GuardiansName" class="form-control" placeholder="Guardian's Name" >
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" onkeypress="return isNumberKey(event)" name="GuardiansContact" id="GuardiansContact" class="form-control" placeholder="Contact Number" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<input type="text" name="FathersName" id="FathersName" class="form-control " placeholder="Father's Name" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<input type="text" name="FathersOccupation" id="FathersOccupation" class="form-control" placeholder="Father's Occupation" >
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<input type="text" onkeypress="return isNumberKey(event)" name="FathersContact" id="FathersContact" class="form-control " placeholder="Father's Contact Number" >
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<input type="text" name="FathersReligion" id="FathersReligion" class="form-control" placeholder="Father's Religion" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<input type="text" name="MothersMName" id="MothersMName" class="form-control " placeholder="Mother's Maiden Name" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<input type="text" name="MothersOccupation" id="MothersOccupation" class="form-control" placeholder="Mother's Occupation" >
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<input type="text" onkeypress="return isNumberKey(event)" name="MothersContact" id="MothersContact" class="form-control " placeholder="Mother's Contact Number" >
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<input type="text" name="MothersReligion" id="MothersReligion" class="form-control" placeholder="Mother's Religion" >
									</div>
								</div>
							</div> 
							
							<div class="row ">
								<div class="col-xs-4" ></div>
								<div class="col-xs-4 text-center" >
									<button id="btnSave" type="btn" class="btn btn-success ">Register</button>
									<a href="student.php" class="btn btn-warning "> Close </a>
								</div>
								<div class="col-xs-4 " ></div>
							</div>
							
						<!--</form>-->
                    </div>
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
		
		function isNumberKey(evt){
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if (charCode != 46 && charCode > 31 
				&& (charCode < 48 || charCode > 57))
				return false;

			return true;
		}
	
		$(document).on("click","#btnSave",function(){
			var action = 3; //default action = 3 means new entry
			var student_id = parseInt($("#student_id").val());
			var lrn = $("#lrn_number").val();
			var sy = parseInt($("#sy").val());
			var gradelevel = parseInt($("#gradelevel").val());
			var firstname = $("#FirstName").val();
			var lastname = $("#LastName").val();
			var middlename = $("#MiddleName").val();
			var extname = $("#ExtName").val();
			var gender = $("#gender").val();
			var birthday = $("#Birthday").val();
			var birthplace = $("#BirthPlace").val();
			var address = $("#Address").val();
			var last_school_attended = $("#LastSchoolAttended").val();
			var grade_completed = $("#grade_completed").val();
			var general_average = $("#GeneralAverage").val();
			var guardians_name = $("#GuardiansName").val();
			var guardians_contact = $("#GuardiansContact").val();
			var fathers_name = $("#FathersName").val();
			var fathers_occupation = $("#FathersOccupation").val();
			var fathers_contact = $("#FathersContact").val();
			var fathers_religion = $("#FathersReligion").val();
			var mothers_mname = $("#MothersMName").val();
			var mothers_occupation = $("#MothersOccupation").val();
			var mothers_contact = $("#MothersContact").val();
			var mothers_religion = $("#MothersReligion").val();
			
			if (student_id){ //update
				action = 4; 
			}else{ //new entry
				action = 3;
			}
			
			if (sy && gradelevel && firstname && lastname && middlename){
				$.post("student_action.php",{
					action:action,
					student_id:student_id,
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
                        window.location="student.php?id=" + data;  
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
