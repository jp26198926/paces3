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
		include('schoolyear_new.php');
		include('schoolyear_modify.php');
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
                            School Year <small>List</small>		
							<div class="form-group input-group pull-right col-sm-3">
                                <input id="txt_search"  type="text" class="form-control">
                                <span class="input-group-btn">
									<button id="btn_search" class="btn btn-warning" type="button" title="Search" data-toggle="tooltip"><i class="fa fa-search"></i></button>
									<button id="btn_new" class="btn btn-success" type="button" title="New Entry" data-toggle="tooltip"><i class="fa fa-plus"></i></button>
								</span>								
                            </div>
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->
				
				<!-- Page Body -->
				
                <div class="row">
                    <div class="col-lg-12" >  
						
						<div class="table-responsive">							
                            <table id="tbl_schoolyear" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <tr>
											<th>Option</th>
											<th>School Year Started</th>											
											<th>School Year Ended </th>
											<th>Status</th>
										</tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan='4' align='center'> Use search button to display </td>
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
		
		$(document).on("keyup","#txt_search",function(){
			$("#btn_search").trigger("click");
		});
		
		$(document).on("blur","#txt_search",function(){
			$("#btn_search").trigger("click");
		});
		
		$(document).on("click","#btn_search",function(){
			var search = $("#txt_search").val();
			
			$.post("schoolyear_action.php",{action:1, search:search},function(data){
				if(data.indexOf("<!DOCTYPE html>")>-1){
					alert("Error: Session Time-Out, You must login again to continue.");
					location.reload(true);                     
				}else if (data.indexOf("Error: ")>-1) {                          
					alert(data);                        
				}else{
					$("#tbl_schoolyear tbody").html(data);					
					$('[data-toggle="tooltip"]').tooltip({html:true});
				}
			});			
		});	
		
		
		$(document).on("click","#btn_new",function(){			
			$("#schoolyear_new").modal();
			$("#txt_schoolyear").val("").focus();			
		});
		
		$(document).on("click","#btn_save",function(){			
			var schoolyear_start = $("#txt_schoolyear_start").val();
			var schoolyear_end = $("#txt_schoolyear_end").val();
			
			if (schoolyear_start && schoolyear_end){
				$.post("schoolyear_action.php",{action:2, schoolyear_start:schoolyear_start,schoolyear_end:schoolyear_end},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						$("#tbl_schoolyear tbody").html(data);
						$("#schoolyear_new").modal("hide");
						$('[data-toggle="tooltip"]').tooltip({html:true});
					}
				});
			}else{
				alert("Error: Schoolyear  is required!");
			}
		});
		
		$(document).on("click",".btn_modify",function(e){
			e.preventDefault();			
			var schoolyear_id = $(this).attr('id');			
			
			if (schoolyear_id > 0){				
				
				$.post("schoolyear_action.php",{action:3, schoolyear_id: schoolyear_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						data = JSON.parse(data);
						$("#schoolyear_modify").modal();
						$(".schoolyear_id").val(schoolyear_id);
						$("#txt_schoolyear_start_update").val(data["schoolyear_start"]).select().focus();
						$("#txt_schoolyear_end_update").val(data["schoolyear_end"]);
					}
				});
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click","#btn_update",function(){			
			var schoolyear_id = parseInt($(".schoolyear_id").val());
			var schoolyear_start = $("#txt_schoolyear_start_update").val();
			var schoolyear_end = $("#txt_schoolyear_end_update").val();
			
			if (schoolyear_id){
				if (schoolyear_start && schoolyear_end){
					$.post("schoolyear_action.php",{action:4, 												
												schoolyear_id:schoolyear_id,
												schoolyear_start:schoolyear_start,
												schoolyear_end:schoolyear_end},function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_schoolyear tbody").html(data);
							$("#schoolyear_modify").modal("hide");
							$('[data-toggle="tooltip"]').tooltip({html:true});
						}
					});
				}else{
					alert("Error: Schoolyear  is required!");
				}
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click",".btn_deactivate",function(e){
			e.preventDefault();			
			var schoolyear_id = $(this).attr('id');
			var status_id = 2;
			
			if (schoolyear_id && schoolyear_id){
				if (confirm("Are you sure you want to DEACTIVATE this schoolyear?")){
					$.post("schoolyear_action.php",{action:5, 
												schoolyear_id:schoolyear_id, 												
												status_id:status_id},function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_schoolyear tbody").html(data);							
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
			var schoolyear_id = $(this).attr('id');
			var status_id = 1;
			
			if (schoolyear_id && schoolyear_id){
				if (confirm("Are you sure you want to ACTIVATE this schoolyear?")){
					$.post("schoolyear_action.php",{action:5, 
												schoolyear_id:schoolyear_id, 												
												status_id:status_id},function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_schoolyear tbody").html(data);							
							$('[data-toggle="tooltip"]').tooltip({html:true});
						}
					});
				}
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});

		$(document).on("click",".btn_set_active",function(e){
			e.preventDefault();			
			var schoolyear_id = $(this).attr('id');
						
			if (schoolyear_id){
				if (confirm("Are you sure you want to set this S.Y. as active?")){
					$.post("schoolyear_action.php",{action:6, 
												schoolyear_id:schoolyear_id},function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_schoolyear tbody").html(data);							
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
