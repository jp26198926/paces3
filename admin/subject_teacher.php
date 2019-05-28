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
		include('subject_teacher_new.php');		
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
                            Subject Teacher							
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->
				
				<!-- Page Body -->
				<div class="row">
					<div class="col-md-12 form-inline form-group">
						Select a Teacher : 
						<select id="faculty_id" class="form-control">
							<option value="0">-- Select --</option>
							<?php
								include('connect.php');
								$sql = "SELECT faculty_id,  CONCAT(lastname, ', ', firstname, ' ', middlename) as adviser
										FROM faculty_tbl ORDER BY lastname, firstname, middlename;";
								
								$pop = $mysqli->query($sql);
								while ($row = $pop->fetch_object()){
									$faculty_id = $row->faculty_id;
									$adviser = ucwords($row->adviser);
									
									echo "<option value='{$faculty_id}'>{$adviser}</option>";
								}
								
												
								$mysqli->close();
							?>
						</select>
						
						<button id="btn_new" class="btn btn-success" title="Add New Subject" data-toggle="tooltip">Add Subject</button>
					</div>
				</div>
                <div class="row">
                    <div class="col-lg-12" >  
						
						<div class="table-responsive">							
                            <table id="tbl_subject_teacher" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <tr>	
											<th>Option</td>
											<th>Teacher</th>											
											<th>Grade Level</th>
											<th>Section</td>
											<th>Subject</th>
										</tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan='5' align='center'> Use search button to display </td>
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
		
		$(document).on("change","#faculty_id",function(){
			var faculty_id = parseInt($(this).val());
			
			if (faculty_id){
				$.post("subject_teacher_action.php",{action:1, faculty_id:faculty_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						$("#tbl_subject_teacher tbody").html(data);
						$('[data-toggle="tooltip"]').tooltip({html:true});
					}
				});
			}else{
				$("#tbl_subject_teacher tbody").html("<tr><td colspan='5' align='center'> Select a Teacher first! </td></tr>");
			}
		});
		
		$(document).on("click","#btn_new",function(e){
			e.preventDefault();		
			
			var faculty_id = parseInt($("#faculty_id").val());
						
			if (faculty_id > 0){				
				$("#subject_teacher_new").modal();
				$("#txt_gradelevel").val("0").focus();
			}else{
				alert("Error: Please select Teacher first!");
			}
		});
		
		$(document).on("change","#txt_gradelevel",function(){
			var gradelevel_id = parseInt($(this).val());
			
			if (gradelevel_id){
				$.post("subject_teacher_action.php",{
														action:4, 
														gradelevel_id:gradelevel_id
													},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{						
						var section = data.split(":~:||:~:")[0];
						var subject = data.split(":~:||:~:")[1];
						
						$("#txt_section").html(section);
						$("#txt_subject").html(subject);
					}
				});
			}else{
				$("#txt_section").html("<option value='0'></option>");
				$("#txt_subject").html("<option value='0'></option>");
			}
		});
		
		$(document).on("click","#btn_save",function(){
			var gradelevel_id = parseInt($("#txt_gradelevel").val());
			var section_id = parseInt($("#txt_section").val());
			var subject_id = parseInt($("#txt_subject").val());
			var faculty_id = parseInt($("#faculty_id").val());
			
			if (gradelevel_id && section_id && section_id && faculty_id){				
				$.post("subject_teacher_action.php",{
													action:2, 
													gradelevel_id:gradelevel_id,
													section_id:section_id,
													subject_id:subject_id,
													faculty_id:faculty_id
												},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						$("#tbl_subject_teacher tbody").html(data);	
						$("#subject_teacher_new").modal("hide");
						$('[data-toggle="tooltip"]').tooltip({html:true});
					}
				});
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click",".btn_modify",function(e){
			e.preventDefault();
			
			var subject_teacher_id = $(this).attr('id');
			
			$(".subject_teacher_id").val(subject_teacher_id);
			$("#subject_teacher_modify").modal();
			$("#txt_adviser_update").focus();
			
		});
		
		$(document).on("click",".btn_delete",function(){			
			var subject_teacher_id = $(this).attr('id');
			var faculty_id = parseInt($("#faculty_id").val());
			
			if (subject_teacher_id && faculty_id){	
				if (confirm("Are you sure you want to delete this record?")){
					$.post("subject_teacher_action.php",{action:3,
															subject_teacher_id:subject_teacher_id,
															faculty_id:faculty_id
														},function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							$("#tbl_subject_teacher tbody").html(data);						
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
