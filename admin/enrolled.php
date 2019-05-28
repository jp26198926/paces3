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
		include('enrolled_modify.php');
		include('enrolled_info.php');
		include('enrolled_offence.php');
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
                            Enrolled Students <small>Record</small>
							<div class="form-group input-group pull-right col-sm-3">
                                <input id="txt_search"  type="text" class="form-control">
                                <span class="input-group-btn">
									<button id="btn_search" class="btn btn-warning" type="button"><i class="fa fa-search"></i></button>									
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
		
		$(document).ready(function(){
			var id = "<?= isset($_GET['id']) ? $_GET['id'] : 0 ?>";
			
			if (parseInt(id) > 0){
				$.post("enrolled_action.php",{action:1, id:id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
                        alert("Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
                        alert(data);                        
                    }else{
                        $("#tbl_student tbody").html(data);
						$('[data-toggle="tooltip"]').tooltip({html:true});
                    }
				});
			}
		});
		
		$(document).on("click","#btn_search",function(){
			var search = $("#txt_search").val();
			
			$.post("enrolled_action.php",{action:2, search:search},function(data){
				if(data.indexOf("<!DOCTYPE html>")>-1){
                    alert("Error: Session Time-Out, You must login again to continue.");
                    location.reload(true);                     
				}else if (data.indexOf("Error: ")>-1) {                          
                    alert(data);                        
                }else{
                    $("#tbl_student tbody").html(data);
					$('[data-toggle="tooltip"]').tooltip({html:true});
                }
			});
		});
		
		$(document).on("keypress","#txt_search",function(e){
			if (e.which==13){
				$("#btn_search").trigger("click");
			}
		});
		
		$(document).on("click",".btn_info",function(e){
			var student_id = $(this).attr("id");
			
			if (student_id){
				$.post("enrolled_action.php",{action:3, student_id:student_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						data = JSON.parse(data);
						
						$("#lrn_no_info").val(data["lrn_no"]);
						$("#sy_info").val(data["schoolyear_id"]);
						$("#gradelevel_info").val(data["gradelevel_id"]);
						$("#firstname_info").val(data["firstname"]);
						$("#lastname_info").val(data["lastname"]);
						$("#middlename_info").val(data["middlename"]);
						$("#extname_info").val(data["extname"]);
						$("#gender_info").val(data["gender"]);
						$("#birthday_info").val(data["birthdate"]);
						$("#birthplace_info").val(data["birthplace"]);
						$("#address_info").val(data["address"]);
						$("#lastschoolattended_info").val(data["last_school"]);
						$("#grade_completed_info").val(data["grade_completed"]);
						$("#generalaverage_info").val(data["gen_average"]);
						$("#guardiansname_info").val(data["guardians_name"]);
						$("#guardianscontact_info").val(data["guardians_info"]);
						$("#fathersname_info").val(data["fathers_name"]);
						$("#fathersoccupation_info").val(data["fathers_occupation"]);
						$("#fatherscontact_info").val(data["fathers_contact"]);
						$("#fathersreligion_info").val(data["fathers_religion"]);
						$("#mothersmname_info").val(data["mothers_name"]);
						$("#mothersoccupation_info").val(data["mothers_occupation"]);
						$("#motherscontact_info").val(data["mothers_contact"]);
						$("#mothersreligion_info").val(data["mothers_religion"]);
						$("#username_info").val(data["username"]);
						
						$(".enrolled_field").attr('disabled','disabled');
						$("#enrolled_info").modal();
					}
				});
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click",".btn_modify",function(e){
			var student_id = $(this).attr("id");
			
			if (student_id){
				$.post("enrolled_action.php",{action:3, student_id:student_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						data = JSON.parse(data);						
						
						$(".enrolled_field").removeAttr('disabled');
						
						$(".student_id").val(student_id);
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
						$("#guardiansname_update").val(data["guardians_name"]);
						$("#guardianscontact_update").val(data["guardians_contact"]);
						$("#fathersname_update").val(data["fathers_name"]);
						$("#fathersoccupation_update").val(data["fathers_occupation"]);
						$("#fatherscontact_update").val(data["fathers_contact"]);
						$("#fathersreligion_update").val(data["fathers_religion"]);
						$("#mothersmname_update").val(data["mothers_name"]);
						$("#mothersoccupation_update").val(data["mothers_occupation"]);
						$("#motherscontact_update").val(data["mothers_contact"]);
						$("#mothersreligion_update").val(data["mothers_religion"]);
						$("#username_update").val(data["username"]);
						
						$("#enrolled_modify").modal();
					}
				});
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click","#btn_update",function(){
			var action = 4
			var student_id = parseInt($(".student_id").val());
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
			var username = $("#username_update").val();
			
			if (student_id){
			
				if (sy && gradelevel && firstname && lastname && middlename){
					$.post("enrolled_action.php",{
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
						mothers_religion:mothers_religion,
						username:username
					},function(data){
						
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_student tbody #tr_" + student_id).html(data);
							$('[data-toggle="tooltip"]').tooltip({html:true});
							
							$("#enrolled_modify").modal("hide");
						}
					});
				}else{				
					alert("Error: Firstname, Lastname, Middlename, SY and Grade Level are required field!");
				}
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click",".btn_offence",function(e){
			e.preventDefault();
			var student_id = $(this).attr('id');
			
			if (student_id){
				$(".student_id").val(student_id);
				$("#incident_date").val("<?= date('Y-m-d'); ?>");
				$("#enrolled_offence").modal();
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click","#btn_offence_save",function(){
			var student_id = $(".student_id").val();
			var incident_date = $("#incident_date").val();
			var incident_type = $("#incident_type").val();
			var description = $("#description").val();
			var comments = $("#comments").val();
			
			if (student_id){
				if (incident_date){
					$.post("enrolled_action.php",{action:6,
												  student_id:student_id,
												  incident_type:incident_type,
												  incident_date:incident_date,
												  description:description,
												  comments:comments
												 },function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_student tbody #tr_" + student_id).html(data);
							$('[data-toggle="tooltip"]').tooltip({html:true});
							
							$("#enrolled_offence").modal('hide');
						}
					});
				}else{
					alert("Error: Date is required!");
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
