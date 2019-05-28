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
		include('user_new.php');
		include('user_modify.php');
		include('user_changepassword.php');
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
                            User <small>List</small>		
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
                            <table id="tbl_user" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <tr>
											<th>Option</th>
											<th>Username</th>											
											<th>Access Level</th>
											<th>Fullname</th>
											<th>Designation</th>
											<th>Status</th>
										</tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan='6' align='center'> Use search button to display </td>
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
			
			$.post("user_action.php",{action:1, search:search},function(data){
				if(data.indexOf("<!DOCTYPE html>")>-1){
					alert("Error: Session Time-Out, You must login again to continue.");
					location.reload(true);                     
				}else if (data.indexOf("Error: ")>-1) {                          
					alert(data);                        
				}else{
					$("#tbl_user tbody").html(data);					
					$('[data-toggle="tooltip"]').tooltip({html:true});
				}
			});			
		});	
		
		
		$(document).on("change","#txt_fullname, #txt_fullname_update",function(){
			var faculty_id = $(this).val();
			
			if (faculty_id){
				$.post("user_action.php",{action:6, faculty_id:faculty_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						data = JSON.parse(data);
						$(".txt_designation").val(data["designation"]);
					}
				});
			}
		});
		
		$(document).on("click","#btn_new",function(){			
			$("#user_new").modal();
			$(".txt_user").val("");
			$("#txt_username").val("").focus();			
		});
		
		$(document).on('click','#btn_save',function(){
			
			var username = $("#txt_username").val();
			var password = $("#txt_password").val();
			var repassword = $("#txt_repassword").val();			
			var access_id = $("#txt_access").val();		
			var faculty_id = $("#txt_fullname").val();			
								
			if (username && password && repassword && access_id && faculty_id) {
				
				if (password == repassword){
													
					$.post("user_action.php",{action:2, username:username, password:password, repassword:repassword,
													access_id:access_id,
													faculty_id:faculty_id
													}, function(data){
									
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
										
							$("#user_new").modal('hide');									
							$('[data-toggle="tooltip"]').tooltip({html:true});
						}
					});							
				}else{
					alert("Error: Password does not matched!");	
				}	
			}else{
				alert("All fields are marked with red asterisk are required!");
			}
		});
		
		
		$(document).on("click",".btn_modify",function(e){
			e.preventDefault();
			var user_id = $(this).attr("id");
			
			if (user_id){
				$.post("user_action.php",{action:3, user_id:user_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1){								
						alert(data)
					}else{								
						data = JSON.parse(data);
						
						$("#user_modify").modal()
						$(".user_id").val(user_id);
						$("#txt_username_update").val(data["username"]).select().focus();
						$("#txt_access_update").val(data["access_id"]);
						$("#txt_fullname_update").val(data["faculty_id"]);
						$(".txt_designation").val(data["designation"]);
					}
				});
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on('click','#btn_update',function(){
			var user_id = $(".user_id").val();
			var username = $("#txt_username_update").val();					
			var access_id = $("#txt_access_update").val();		
			var faculty_id = $("#txt_fullname_update").val();			
								
			if (username && access_id && faculty_id) {
													
				$.post("user_action.php",{action:4, username:username, 
													user_id:user_id,
													access_id:access_id,
													faculty_id:faculty_id
													}, function(data){
									
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
										
							$("#user_modify").modal('hide');									
							$('[data-toggle="tooltip"]').tooltip({html:true});
							
							alert("Successfully Changed!");
						}
					});							
					
			}else{
				alert("All fields are marked with red asterisk are required!");
			}
		});
		
		$(document).on("click",".btn_deactivate",function(e){
			e.preventDefault();
			
			var user_id = $(this).attr('id');
			
			if (user_id){
				if (confirm("Are you sure you want to De-activate this user?")){
					$.post("user_action.php",{action:5, user_id:user_id, status_id:2}, function(data){
										
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
												
							$("#user_modify").modal('hide');									
							$('[data-toggle="tooltip"]').tooltip({html:true});
									
							alert("Successfully Updated!");
						}
					});							
				}		
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click",".btn_activate",function(e){
			e.preventDefault();
			
			var user_id = $(this).attr('id');
			
			if (user_id){
				if (confirm("Are you sure you want to Activate this user?")){
					$.post("user_action.php",{action:5, user_id:user_id, status_id:1}, function(data){
										
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
												
							$("#user_modify").modal('hide');									
							$('[data-toggle="tooltip"]').tooltip({html:true});
									
							alert("Successfully Updated!");
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

</body>

</html>
