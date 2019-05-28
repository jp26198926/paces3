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
	<?php
		include('student_enroll.php');
	?>

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
                            Registration / Enrollment <small></small>
							<div class="form-group input-group pull-right col-sm-3">
                                <input id="txt_search"  type="text" class="form-control">
                                <span class="input-group-btn">
									<button id="btn_search" class="btn btn-warning" type="button" title="Search"><i class="fa fa-search"></i></button>
									<button id="btn_asearch" class="btn btn-info" type="button" title="Advance Search"><i class="fa fa-search-plus"></i></button>
									
									<button id="btn_new" class="btn btn-success" type="button" title="New Entry"><i class="fa fa-plus"></i></button>
									<!--
									<a href="student_form.php" class="btn btn-success" title="New Entry"><i class="fa fa-plus"></i></a>
									-->
								</span>								
                            </div>
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->
				
				<!-- Page Body -->
                <div class="row">
                    <div class="col-lg-12">                        
						<div class="table-responsive">
                            <table id="tbl_student" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <tr>
											<th>Option</th>
											<th>LRN Number</th>
											<th>Last Name</th>
											<th>First Name</th>											
											<th>Middle Name</th>
											<th>Ext Name</th>
											<th>Gender</th>
											<th>Grade Level</th>
											<th>Section</th>
											<th>School Year</th>
											<th>Status</th>
										</tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan='11' align='center'> Use search button to display </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>               
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

    <?php
    	include("student_type.php");
    	include("student_registration.php");
    	include("student_cancel.php");
    ?>

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	
	<!-- custom script -->
	<script>
		$(document).ready(function(){
			var id = "<?= isset($_GET['id']) ? $_GET['id'] : 0 ?>";
			
			if (parseInt(id) > 0){
				$.post("student_action.php",{action:1, id:id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
                        alert("Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
                        alert(data);                        
                    }else{
                        $("#tbl_student tbody").html(data);
                    }
				});
			}
		});

		$(document).on("click",".btn_registration_cancel",function(e){
			e.preventDefault();
			var student_id = $(this).attr('id');

			if (student_id){
				$(".hidden_student_id").val(student_id);
				$("#student_cancel").modal();
				$("#txt_registration_cancel").val("").focus();
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});

		$(document).on("click","#btn_registration_cancel_save",function(){
			var student_id = $(".hidden_student_id").val();
			var reason = $("#txt_registration_cancel").val();

			if (parseInt(student_id) > 0){
				if (reason){
					$.post("student_action.php",{action:9, student_id:student_id, reason:reason},function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
	                        alert("Error: Session Time-Out, You must login again to continue.");
	                        location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
	                        alert(data); 
	                        $("#txt_registration_cancel").focus();                       
	                    }else{
	                        $("#tbl_student tbody #tr_" + student_id).html("");
	                        $("#student_cancel").modal("hide");
	                    }
					});
				}else{
					alert("Error: Please provide a reason!");
					$("#txt_registration_cancel").focus();    
				}
			}else{
				alert("Error: Critical Error Encountered!");
				$("#txt_registration_cancel").focus();    
			}
		});


		$(document).on("click","#btn_new",function(){
			$("#student_type").modal();
		});

		$(document).on("change","#txt_student_type",function(){
			var type_id = $(this).val();
			
			if (type_id==2){ //old student
				$("#div_lrn").show();
				$("#txt_lrn_no").val("").focus().select();
			}else{
				$("#div_lrn").hide();
			}
		});

		$(document).on("click","#btn_type_proceed",function(){
			var type_id = $("#txt_student_type").val();

			if (type_id){
				if (type_id == 1){ //new student
					$("#student_type").modal("hide");
					$("#student_registration").modal();
				}else{ //old student

					var lrn_no = $("#txt_lrn_no").val();
					
					if (lrn_no){
						$.post("student_action.php",{action:8, lrn_no:lrn_no},function(data){
							if(data.indexOf("<!DOCTYPE html>")>-1){
			                    alert("Error: Session Time-Out, You must login again to continue.");
			                    location.reload(true);                     
							}else if (data.indexOf("Error: ")>-1) {                          
			                    alert(data);                        
			                }else{
			                    data = JSON.parse(data);

			                    var lrn_no = data.lrn_no;
			                    var firstname = data.firstname;
			                    var lastname = data.lastname;
			                    var middlename = data.middlename;
			                    var extname = data.extname;
			                    var gender = data.gender;
			                    var birthdate = data.birthdate;
			                    var birthplace = data.birthplace;
			                    var address = data.address;
			                    var guardians_name = data.guardians_name;
			                    var guardians_contact = data.guardians_contact;
			                    var fathers_name = data.fathers_name;
			                    var fathers_occupation = data.fathers_occupation;
			                    var fathers_religion = data.fathers_religion;
			                    var fathers_contact = data.fathers_contact;
			                    var mothers_mname = data.mothers_mname;
			                    var mothers_occupation = data.mothers_occupation;
			                    var mothers_religion = data.mothers_religion;
			                    var mothers_contact = data.mothers_contact;
			                    var gradelevel_id = data.gradelevel_id;

			                    $("#lrn_number").val(lrn_no);
			                    $("#FirstName").val(firstname);
			                    $("#LastName").val(lastname);
			                    $("#MiddleName").val(middlename);
			                    $("#ExtName").val(extname);
			                    $("#gender").val(gender);
			                    $("#Birthday").val(birthdate);
			                    $("#BirthPlace").val(birthplace);
			                    $("#Address").val(address);
			                    $("#LastSchoolAttended").val("Pasay Adventist Church Elementary School");
			                    $("#grade_completed").val(gradelevel_id);
			                    $("#GuardiansName").val(guardians_name);
			                    $("#GuardiansContact").val(guardians_contact);
			                    $("#FathersName").val(fathers_name);
			                    $("#FathersOccupation").val(fathers_occupation);
			                    $("#FathersContact").val(fathers_contact);
			                    $("#FathersReligion").val(fathers_religion);
			                    $("#MothersMName").val(mothers_mname);
			                    $("#MothersOccupation").val(mothers_occupation);
			                    $("#MothersContact").val(mothers_contact);
			                    $("#MothersReligion").val(mothers_religion);

			                    
			                    $("#student_type").modal("hide");
								$("#student_registration").modal();
			                }
						});
					}else{
						alert("Error: Please enter LRN Number!");
					}
				}
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});

		$(document).on("click","#btn_registration_save",function(){
			var action = 3; //default action = 3 means new entry			
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
				
			if (sy && gradelevel && firstname && lastname && middlename){
				$.post("student_action.php",{
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
                        window.location="student.php?id=" + data;  
                    }
				});
			}else{				
				alert("Error: Firstname, Lastname, Middlename, SY and Grade Level are required field!");
			}
		});
		
		$(document).on("click","#btn_search",function(){
			var search = $("#txt_search").val();
			
			$.post("student_action.php",{action:2, search:search},function(data){
				if(data.indexOf("<!DOCTYPE html>")>-1){
                    alert("Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);                     
				}else if (data.indexOf("Error: ")>-1) {                          
                    alert(data);                        
                }else{
                    $("#tbl_student tbody").html(data);
                }
			});
		});
		
		$(document).on("keypress","#txt_search",function(e){
			if (e.which==13){
				$("#btn_search").trigger("click");
			}
		});
		
		$(document).on("click",".btn_enroll",function(){
			var student_id = $(this).attr('id');
			
			if (student_id){				
				$.post("student_action.php",{action:5, student_id:student_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						data = JSON.parse(data);
						
						$("#student_id").val(student_id);
						$("#txt_enroll_student").val(data["student_name"]);
						$("#txt_enroll_schoolyear").val(data["sy"]);
						$("#txt_enroll_gradelevel").val(data["gradelevel_name"]);							
						$("#student_enroll").modal();
					}
				});
				
			}else{
				alert("Error: Critical Error Encountered!");
			}			
		});
		
		$(document).on("click","#btn_enroll_save",function(){
			var student_id = $("#student_id").val();
			var section_id = parseInt($("#txt_enroll_section").val());
			var username = $("#txt_enroll_username").val();
			var password = $("#txt_enroll_password").val();
			var repassword = $("#txt_enroll_repassword").val();
			
			
			if (student_id){
				if (section_id > 0 && username && password && repassword){
					if (password == repassword){												
						$.post("student_action.php",{action:6, student_id:student_id, 
													section_id:section_id, username:username,
													password:password, repassword:repassword},function(data){
							if(data.indexOf("<!DOCTYPE html>")>-1){
								alert("Error: Session Time-Out, You must login again to continue.");
								location.reload(true);                     
							}else if (data.indexOf("Error: ")>-1) {                          
								alert(data);                        
							}else{
								var student_data = data.split("~:||:~")[0];
								var tbl = data.split("~:||:~")[1];	

								$("#tbl_student tbody #tr_" + student_id).html(tbl);
								$("#tbl_student #tr_" + student_id).removeClass("danger info warning").addClass("success");
								$("#student_enroll").modal("hide");

								//send SMS NOTIFICATION
								if (student_data){
									student_data = JSON.parse(student_data);

									var student_name = student_data.firstname + ' ' + student_data.lastname
									var recepient_no = student_data.guardians_contact;

									var msg = student_name + " is now enrolled! \n";
										msg += "User: " + username + "\n";
										msg += "Pass: " + password;

									$.post("settings_sms_action.php",{	
															action:3,
															recepient_no:recepient_no,
															msg:msg
														 },function(data){
										if(data.indexOf("<!DOCTYPE html>")>-1){
											alert("Error: Session Time-Out, You must login again to continue.");
											location.reload(true);                     
										}else if (data.indexOf("Error: ")>-1) {                          
											alert(data);                        
										}else{
											alert(data);  
										}
									});	
								}
								
							}
						});
					}else{
						alert("Error: Password does not match!");
					}
				}else{
					alert("Error: Field with red asterisk are required!");
				}
			}else{
				alert("Error: Critical Error Encountered!");
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
