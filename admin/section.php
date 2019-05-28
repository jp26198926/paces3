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
		include('section_new.php');
		include('section_modify.php');
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
                            Section <small>List</small>							
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->
				
				<!-- Page Body -->
				<div class="row">
					<div class="col-md-12 form-inline form-group">
						Select Grade Level : 
						<select id="gradelevel_id" class="form-control">
							<option value="0">-- Grade Level --</option>
							<?php
								include('connect.php');
								$sql = "SELECT gradelevel_id, gradelevel_name 
										FROM gradelevel_tbl 
										WHERE status_id=1
										ORDER BY gradelevel_name";
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
						<button id="btn_new" class="btn btn-success" ><i class="fa fa-plus fa-fw"></i> New Entry</button>
					</div>
				</div>
                <div class="row">
                    <div class="col-lg-12" >  
						
						<div class="table-responsive">							
                            <table id="tbl_section" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <tr>
											<th>Option</th>
											<th>Section Name</th>											
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
			$('[data-toggle="tooltip"]').tooltip({html:true});
		});
		
		$(document).on("change","#gradelevel_id",function(){
			var gradelevel_id = parseInt($(this).val());
			
			if (gradelevel_id){
				$.post("section_action.php",{action:1, gradelevel_id:gradelevel_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						$("#tbl_section tbody").html(data);
						$('[data-toggle="tooltip"]').tooltip({html:true});
					}
				});
			}else{
				$("#tbl_section tbody").html("<tr><td colspan='4' align='center'> Select Grade Level to Display Section </td></tr>");
			}
		});
		
		$(document).on("click","#btn_new",function(){
			var gradelevel_id = parseInt($("#gradelevel_id").val());
			
			if (gradelevel_id > 0){
				$("#section_new").modal();
				$("#txt_section").val("").focus();
			}else{
				alert("Error: Please select Grade Level first!");
			}
		});
		
		$(document).on("click","#btn_save",function(){
			var gradelevel_id = parseInt($("#gradelevel_id").val());
			var section_name = $("#txt_section").val();
			
			if (gradelevel_id && section_name){
				$.post("section_action.php",{action:2, gradelevel_id:gradelevel_id, section_name:section_name},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						$("#tbl_section tbody").html(data);
						$("#section_new").modal("hide");
						$('[data-toggle="tooltip"]').tooltip({html:true});
					}
				});
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click",".btn_modify",function(e){
			e.preventDefault();			
			var section_id = $(this).attr('id');			
			
			if (section_id > 0){				
				
				$.post("section_action.php",{action:3, section_id: section_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						data = JSON.parse(data);
						$("#section_modify").modal();
						$(".section_id").val(section_id);
						$("#txt_section_update").val(data["section_name"]).select().focus();
					}
				});
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click","#btn_update",function(){
			var gradelevel_id = parseInt($("#gradelevel_id").val());
			var section_id = parseInt($(".section_id").val());
			var section_name = $("#txt_section_update").val();
			
			if (gradelevel_id && section_id){
				if (section_name){
					$.post("section_action.php",{action:4, 
												gradelevel_id:gradelevel_id, 
												section_id:section_id,
												section_name:section_name},function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_section tbody").html(data);
							$("#section_modify").modal("hide");
							$('[data-toggle="tooltip"]').tooltip({html:true});
						}
					});
				}else{
					alert("Error: Section name is required!");
				}
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click",".btn_deactivate",function(e){
			e.preventDefault();
			var gradelevel_id = parseInt($("#gradelevel_id").val());
			var section_id = $(this).attr('id');
			var status_id = 2;
			
			if (gradelevel_id && section_id){
				if (confirm("Are you sure you want to DEACTIVATE this section?")){
					$.post("section_action.php",{action:5, 
												gradelevel_id:gradelevel_id, 
												section_id:section_id,
												status_id:status_id},function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_section tbody").html(data);							
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
			var gradelevel_id = parseInt($("#gradelevel_id").val());
			var section_id = $(this).attr('id');
			var status_id = 1;
			
			if (gradelevel_id && section_id){
				if (confirm("Are you sure you want to ACTIVATE this section?")){
					$.post("section_action.php",{action:5, 
												gradelevel_id:gradelevel_id, 
												section_id:section_id,
												status_id:status_id},function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_section tbody").html(data);							
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
