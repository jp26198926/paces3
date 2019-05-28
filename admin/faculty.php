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
		include('faculty_new.php');
		include('faculty_modify.php');
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
                            Faculty <small>Member</small>
							<div class="form-group input-group pull-right col-sm-3">
                                <input id="txt_search"  type="text" class="form-control">
                                <span class="input-group-btn">
									<button id="btn_search" class="btn btn-warning" type="button"><i class="fa fa-search" title="Search" data-toggle="tooltip"></i></button>
									<button id="btn_new" class="btn btn-success" type="button"><i class="fa fa-plus" title="New Entry" data-toggle="tooltip"></i></button>
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
                            <table id="tbl_faculty" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <tr>
											<th>Option</th>
											<th>Name</th>
											<th>Gender</th>
											<th>Designation</th>											
											<th>Birthday</th>
											<th>Contact</th>											
											<th>PRC License</th>
											<th>Status</th>
										</tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan='8' align='center'> Use search button to display </td>
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
		$(document).ready(function(){
			$("#btn_search").trigger("click");
		});	
		
		$(document).on("keypress","#txt_search",function(e){
			if (e.which == 13){
				$("#btn_search").trigger("click");
			}
		});
				
		$(document).on("click","#btn_search",function(){
			var search = $("#txt_search").val();
			
			$.post("faculty_action.php",{action:1, search:search},function(data){
				if(data.indexOf("<!DOCTYPE html>")>-1){
					alert("Error: Session Time-Out, You must login again to continue.");
					location.reload(true);                     
				}else if (data.indexOf("Error: ")>-1) {                          
					alert(data);                        
				}else{
					$("#tbl_faculty tbody").html(data);					
					$('[data-toggle="tooltip"]').tooltip({html:true});
				}
			});			
		});	
		
		
		$(document).on("click","#btn_new",function(){	
			$(".txt_faculty").removeAttr('disabled');
			$("#faculty_new").modal();
			$(".txt_faculty").val("");		
			$("#txt_lastname").focus();
		});
		
		$(document).on("click","#btn_save",function(){			
			var lastname = $("#txt_lastname").val();
			var firstname = $("#txt_firstname").val();
			var middlename = $("#txt_middlename").val();
			var gender_id = $("#txt_gender").val();
			var birthday = $("#txt_birthday").val();
			var designation = $("#txt_designation").val();
			var contact_no = $("#txt_contact").val();
			var emergency_person = $("#txt_emergency_person").val();
			var emergency_contact = $("#txt_emergency_contact").val();
			var prc = $("#txt_prc").val();
			var address = $("#txt_address").val();
			var sss = $("#txt_sss").val();
			var tin = $("#txt_tin").val();
			var philhealth = $("#txt_philhealth").val();
			var pagibig = $("#txt_pagibig").val();
			
			if (lastname && firstname){
				$.post("faculty_action.php",{
												action:2,
												lastname:lastname,
												firstname:firstname,
												middlename:middlename,
												gender_id:gender_id,
												birthday:birthday,
												designation:designation,
												contact_no:contact_no,
												emergency_person:emergency_person,
												emergency_contact:emergency_contact,
												prc:prc,
												address:address,
												sss:sss,
												tin:tin,
												philhealth:philhealth,
												pagibig:pagibig
											},function(data){
					
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data); 
						console.log(data);
					}else{
						$("#tbl_faculty tbody").html(data);
						$("#faculty_new").modal("hide");
						$('[data-toggle="tooltip"]').tooltip({html:true});
					}
				});
			}else{
				alert("Error: Fields with red asterisk are important!");
			}
		});
		
		$(document).on("click",".btn_modify",function(e){
			e.preventDefault();			
			var faculty_id = $(this).attr('id');			
			
			if (faculty_id > 0){				
				
				$.post("faculty_action.php",{action:3, faculty_id: faculty_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						data = JSON.parse(data);
						
						var lastname = data["lastname"];
						var firstname = data["firstname"];
						var middlename = data["middlename"];
						var gender_id = data["gender_id"];
						var birthday = data["birthday"];
						var designation = data["designation"];
						var contact_no = data["contact_no"];
						var emergency_person = data["emergency_person"];
						var emergency_contact = data["emergency_contact"];
						var prc_license = data["prc_license"];
						var address = data["address"];
						var sss = data["sss_no"];
						var tin = data["tin_no"];
						var philhealth = data["ph_no"];
						var pagibig = data["pagibig_no"];
						var status = data["status"];
						
						$(".faculty_id").val(faculty_id);
						$("#txt_lastname_update").val(lastname);
						$("#txt_firstname_update").val(firstname);
						$("#txt_middlename_update").val(middlename);
						$("#txt_gender_update").val(gender_id);
						$("#txt_birthday_update").val(birthday);
						$("#txt_designation_update").val(designation);
						$("#txt_contact_update").val(contact_no);
						$("#txt_emergency_person_update").val(emergency_person);
						$("#txt_emergency_contact_update").val(emergency_contact);
						$("#txt_prc_update").val(prc_license);
						$("#txt_address_update").val(address);
						$("#txt_sss_update").val(sss);
						$("#txt_tin_update").val(tin);
						$("#txt_philhealth_update").val(philhealth);
						$("#txt_pagibig_update").val(pagibig);
						$("#txt_status_update").text(status);
						
						$(".txt_faculty").removeAttr('disabled');
						
						$("#faculty_modify").modal();
						$(".faculty_id").val(faculty_id);
						$("#txt_faculty_update").val(data["faculty_name"]).select().focus();
					}
				});
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click","#btn_update",function(){			
			var faculty_id = parseInt($(".faculty_id").val());
			
			var lastname = $("#txt_lastname_update").val();
			var firstname = $("#txt_firstname_update").val();
			var middlename = $("#txt_middlename_update").val();
			var gender_id = $("#txt_gender_update").val();
			var birthday = $("#txt_birthday_update").val();
			var designation = $("#txt_designation_update").val();
			var contact_no = $("#txt_contact_update").val();
			var emergency_person = $("#txt_emergency_person_update").val();
			var emergency_contact = $("#txt_emergency_contact_update").val();
			var prc = $("#txt_prc_update").val();
			var address = $("#txt_address_update").val();
			var sss = $("#txt_sss_update").val();
			var tin = $("#txt_tin_update").val();
			var philhealth = $("#txt_philhealth_update").val();
			var pagibig = $("#txt_pagibig_update").val();
			
			if (lastname && firstname){
				$.post("faculty_action.php",{
												action:4,
												faculty_id:faculty_id,
												lastname:lastname,
												firstname:firstname,
												middlename:middlename,
												gender_id:gender_id,
												birthday:birthday,
												designation:designation,
												contact_no:contact_no,
												emergency_person:emergency_person,
												emergency_contact:emergency_contact,
												prc:prc,
												address:address,
												sss:sss,
												tin:tin,
												philhealth:philhealth,
												pagibig:pagibig
											},function(data){
					
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data); 						
					}else{
						$("#tbl_faculty tbody").html(data);
						$("#faculty_modify").modal("hide");
						$('[data-toggle="tooltip"]').tooltip({html:true});
					}
				});
			}else{
				alert("Error: Fields with red asterisk are important!");
			}
		});
		
		$(document).on("click",".btn_info",function(e){
			e.preventDefault();			
			var faculty_id = $(this).attr('id');			
			
			if (faculty_id > 0){				
				
				$.post("faculty_action.php",{action:3, faculty_id: faculty_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						data = JSON.parse(data);
						
						var lastname = data["lastname"];
						var firstname = data["firstname"];
						var middlename = data["middlename"];
						var gender_id = data["gender_id"];
						var birthday = data["birthday"];
						var designation = data["designation"];
						var contact_no = data["contact_no"];
						var emergency_person = data["emergency_person"];
						var emergency_contact = data["emergency_contact"];
						var prc_license = data["prc_license"];
						var address = data["address"];
						var sss = data["sss_no"];
						var tin = data["tin_no"];
						var philhealth = data["ph_no"];
						var pagibig = data["pagibig_no"];
						var status = data["status"];
						
						$(".faculty_id").val(faculty_id);
						$("#txt_lastname_update").val(lastname);
						$("#txt_firstname_update").val(firstname);
						$("#txt_middlename_update").val(middlename);
						$("#txt_gender_update").val(gender_id);
						$("#txt_birthday_update").val(birthday);
						$("#txt_designation_update").val(designation);
						$("#txt_contact_update").val(contact_no);
						$("#txt_emergency_person_update").val(emergency_person);
						$("#txt_emergency_contact_update").val(emergency_contact);
						$("#txt_prc_update").val(prc_license);
						$("#txt_address_update").val(address);
						$("#txt_sss_update").val(sss);
						$("#txt_tin_update").val(tin);
						$("#txt_philhealth_update").val(philhealth);
						$("#txt_pagibig_update").val(pagibig);
						$("#txt_status_update").text(status);
						
						$("#btn_update").hide();
						$(".txt_faculty").attr('disabled','disabled');
						$("#faculty_modify").modal();
						$(".faculty_id").val(faculty_id);
						$("#txt_faculty_update").val(data["faculty_name"]).select().focus();
					}
				});
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click",".btn_deactivate",function(e){
			e.preventDefault();			
			var faculty_id = $(this).attr('id');
			var status_id = 2;
			
			if (faculty_id && faculty_id){
				if (confirm("Are you sure you want to DEACTIVATE this record?")){
					$.post("faculty_action.php",{action:5, 
												faculty_id:faculty_id, 												
												status_id:status_id},function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_faculty tbody").html(data);							
							$('[data-toggle="tooltip"]').tooltip({html:true});
						}
					});
				}
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click",".btn_activate",function(e){
			e.preventDefault();			
			var faculty_id = $(this).attr('id');
			var status_id = 1;
			
			if (faculty_id && faculty_id){
				if (confirm("Are you sure you want to ACTIVATE this record?")){
					$.post("faculty_action.php",{action:5, 
												faculty_id:faculty_id, 												
												status_id:status_id},function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_faculty tbody").html(data);							
							$('[data-toggle="tooltip"]').tooltip({html:true});
						}
					});
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
