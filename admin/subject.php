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
		include('subject_new.php');
		include('subject_modify.php');
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
                            Subjects	
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
                            <table id="tbl_subject" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <tr>
											<th>Option</th>
											<th>Subject</th>
											<th>Description</th>											
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
			
			$.post("subject_action.php",{action:1, search:search},function(data){
				if(data.indexOf("<!DOCTYPE html>")>-1){
					alert("Error: Session Time-Out, You must login again to continue.");
					location.reload(true);                     
				}else if (data.indexOf("Error: ")>-1) {                          
					alert(data);                        
				}else{
					$("#tbl_subject tbody").html(data);					
					$('[data-toggle="tooltip"]').tooltip({html:true});
				}
			});			
		});	
		
		
		$(document).on("click","#btn_new",function(){			
			$("#subject_new").modal();
			$("#txt_subject").val("").focus();			
		});
		
		$(document).on("click","#btn_save",function(){			
			var subject_name = $("#txt_subject").val();
			var subject_description = $("#txt_subject_description").val();
			
			if (subject_name){
				$.post("subject_action.php",{action:2, subject_name:subject_name, 
														subject_description:subject_description},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						$("#tbl_subject tbody").html(data);
						$("#subject_new").modal("hide");
						$('[data-toggle="tooltip"]').tooltip({html:true});
					}
				});
			}else{
				alert("Error: Subject is required!");
			}
		});
		
		$(document).on("click",".btn_modify",function(e){
			e.preventDefault();			
			var subject_id = $(this).attr('id');			
			
			if (subject_id > 0){				
				
				$.post("subject_action.php",{action:3, subject_id: subject_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						data = JSON.parse(data);
						$("#subject_modify").modal();
						$(".subject_id").val(subject_id);
						$("#txt_subject_description_update").val(data["subject_description"]);
						$("#txt_subject_update").val(data["subject_name"]).select().focus();
					}
				});
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click","#btn_update",function(){			
			var subject_id = parseInt($(".subject_id").val());
			var subject_name = $("#txt_subject_update").val();
			var subject_description = $("#txt_subject_description_update").val();
			
			if (subject_id){
				if (subject_name){
					$.post("subject_action.php",{action:4, 												
												subject_id:subject_id,
												subject_name:subject_name,
												subject_description:subject_description},function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_subject tbody").html(data);
							$("#subject_modify").modal("hide");
							$('[data-toggle="tooltip"]').tooltip({html:true});
						}
					});
				}else{
					alert("Error: Subject name is required!");
				}
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click",".btn_deactivate",function(e){
			e.preventDefault();			
			var subject_id = $(this).attr('id');
			var status_id = 2;
			
			if (subject_id && subject_id){
				if (confirm("Are you sure you want to DEACTIVATE this subject?")){
					$.post("subject_action.php",{action:5, 
												subject_id:subject_id, 												
												status_id:status_id},function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_subject tbody").html(data);							
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
			var subject_id = $(this).attr('id');
			var status_id = 1;
			
			if (subject_id && subject_id){
				if (confirm("Are you sure you want to ACTIVATE this subject?")){
					$.post("subject_action.php",{action:5, 
												subject_id:subject_id, 												
												status_id:status_id},function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_subject tbody").html(data);							
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
