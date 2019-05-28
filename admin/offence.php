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
		include('offence_modify.php');		
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
                            Offences <small></small>		
							<div class="form-group input-group pull-right col-sm-3">
                                <input id="txt_search"  type="text" class="form-control">
                                <span class="input-group-btn">
									<button id="btn_search" class="btn btn-warning" type="button" title="Search" data-toggle="tooltip"><i class="fa fa-search"></i></button>
								</span>								
                            </div>
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->
				
				<!-- Page Body -->
				
                <div class="row">
                    <div class="col-lg-12" >  
						<span class="alert-warning">To enter new offences goto <code>Students menu -> Search Student -> Click Add Offence button</code> </span>
						<div class="table-responsive">							
                            <table id="tbl_offence" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <tr>
											<th>Option</th>
											<th>Student</th>
											<th>School Year</th>
											<th>Grade Level</th>
											<th>Date</th>											
											<th>Type</th>
											<th>Description</th>
											<th>Comments</th>
											<th>Status</th>
										</tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan='9' align='center'> Use search button to display </td>
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
			
		});	
		
		$(document).on("keypress","#txt_search",function(e){
			if (e.which == 13){
				$("#btn_search").trigger("click");
			}
		});	
		
		$(document).on("click","#btn_search",function(){
			var search = $("#txt_search").val();
			
			$.post("offence_action.php",{action:1, search:search},function(data){
				if(data.indexOf("<!DOCTYPE html>")>-1){
					alert("Error: Session Time-Out, You must login again to continue.");
					location.reload(true);                     
				}else if (data.indexOf("Error: ")>-1) {                          
					alert(data);                        
				}else{
					$("#tbl_offence tbody").html(data);					
					$('[data-toggle="tooltip"]').tooltip({html:true});
				}
			});			
		});	
		
		
		$(document).on("click",".btn_modify",function(e){
			e.preventDefault();
			var offence_id = $(this).attr("id");
			
			if (offence_id){
				$.post("offence_action.php",{action:3, offence_id:offence_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1){								
						alert(data)
					}else{								
						data = JSON.parse(data);
						
						$("#offence_modify").modal()
						$(".offence_id").val(offence_id);
						$("#incident_date").val(data["incident_date"]);
						$("#incident_type").val(data["incident_type"]);
						$("#description").val(data["description"]);
						$("#comments").val(data["comments"]);
					}
				});
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on('click','#btn_offence_update',function(){
			var offence_id = $(".offence_id").val();
			var incident_date = $("#incident_date").val();
			var incident_type = $("#incident_type").val();
			var description = $("#description").val();
			var comments = $("#comments").val();
			
			if (offence_id){
				if (incident_date){
					$.post("offence_action.php",{action:4,
												  offence_id:offence_id,
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
							$("#tbl_offence tbody #tr_" + offence_id).html(data);
							$('[data-toggle="tooltip"]').tooltip({html:true});
							
							$("#offence_modify").modal('hide');
						}
					});
				}else{
					alert("Error: Date is required!");
				}				
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click",".btn_delete",function(e){
			e.preventDefault();
			
			var offence_id = $(this).attr('id');
			
			if (offence_id){
				if (confirm("Are you sure you want to DELETE this Record?")){
					$.post("offence_action.php",{action:5, offence_id:offence_id, status_id:2}, function(data){
										
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1){								
							alert(data)
						}else{								
							if (data){
								$("#tbl_offence tbody #tr_" + offence_id).html(data).addClass('danger');									
							}else{
								$("#tbl_offence tbody").html("<tr><td align='center' colspan='9'>No Record to display</td></tr>");
							}				
														
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

	<!-- change password modal -->
	<?php include("user_changepassword.php"); ?>

</body>

</html>
