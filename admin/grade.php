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
		include('grade_new.php');
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
                            Grades <small></small>							
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->
				
				<!-- Page Body -->
				<div class="row">
					<div class="col-md-2 form-group">
						School Year : 
						<select id="schoolyear_id" class="form-control">
							<?php
								include('connect.php');
								$sql = "SELECT schoolyear_id, CONCAT(schoolyear_start, '-', schoolyear_end) as schoolyear
										FROM schoolyear_tbl ORDER BY schoolyear_start DESC;";
								$pop = $mysqli->query($sql);
												
								if ($pop){
									while($row = $pop->fetch_object()){
										$schoolyear_id = $row->schoolyear_id;
										$schoolyear = $row->schoolyear;														
										echo "<option value='{$schoolyear_id}'>{$schoolyear}</option>";
									}
								}else{
									echo $mysqli->error;
								}
												
								$mysqli->close();
							?>
						</select>						
					</div>
				
					<div class="col-md-2  form-group">
						Grade Level : 
						<select id="gradelevel_id" class="form-control">
							<option value="0">-- Select --</option>
							<?php
								include('connect.php');
								$sql = "SELECT gradelevel_id, gradelevel_name FROM gradelevel_tbl WHERE status_id=1 ORDER BY gradelevel_name;";
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
					
					<div class="col-md-2  form-group">
						Section : 
						<select id="section_id" class="form-control">
							<option value="0">-- Select --</option>
							
						</select>						
					</div>
					
					<div class="col-md-3  form-group">
						Subject : 
						<select id="subject_id" class="form-control">
							<option value="0">-- Select --</option>
							<?php
								include('connect.php');
								$sql = "SELECT subject_id, subject_name FROM subject_tbl WHERE status_id=1 ORDER BY subject_name;";
								$pop = $mysqli->query($sql);
												
								if ($pop){
									while($row = $pop->fetch_object()){
										$id = $row->subject_id;
										$val = $row->subject_name;														
										echo "<option value='{$id}'>{$val}</option>";
									}
								}else{
									echo $mysqli->error;
								}
												
								$mysqli->close();
							?>
						</select>						
					</div>
					
					<div class="col-md-3  form-group">
						<br />
						<button id="btn_search" class="btn btn-success" ><i class="fa fa-search fa-fw"></i> Search</button>
						<button id="btn_upload" class="btn btn-primary" ><i class="fa fa-upload fa-fw"></i> Upload</button>
					</div>
				</div>
                <div class="row">
                    <div class="col-lg-12" >  
						
						<div class="table-responsive">							
                            <table id="tbl_grade" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <tr>
											<th>#</th>
											<th>LRN No.</th>
											<th>Student Name</th>	
											<th>Gender</th>
											<th>Quarter 1</th>
											<th>Quarter 2</th>
											<th>Quarter 3</th>
											<th>Quarter 4</th>
											<th>Average</th>
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

        <!-- modal -->
        <?php include('grade_upload_modal.php'); ?>
        <!--/modal -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	
	<!-- custom script -->
	<script>
		$(document).on('keypress','.numeric', function(e){
				
			if ((e.which < 48 && e.which != 46 && e.which !=45) || e.which > 57) {
				return false;
			}else if (e.which == 46){
				if ($(this).val().indexOf('.') > -1) {
					return false;
				}
			}else if (e.which == 45){ //negative sign
				var occurrence = $(this).val().indexOf('-');
				var cursor = document.getElementById($(this).attr('id')).selectionStart;
					
				if (cursor > 0 || occurrence > -1) {
					return false;
				}
			}
		});
			
		$(document).on('blur','.numeric',function(e){
			e.preventDefault();
			if ($(this).val().length === 0) {
				$(this).val('0.00');
			}
		});
	
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip({html:true});
		});
		
		$(document).on("change","#gradelevel_id",function(){
			var gradelevel_id = parseInt($(this).val());
			
			if (gradelevel_id){
				$.post("grade_action.php",{action:1, gradelevel_id:gradelevel_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
												
						$("#section_id").html(data);						
					}
				});
			}else{
				alert("Error: Please select grade level first!");
			}
		});

		$(document).on("change","#upload_gradelevel_id",function(){
			var gradelevel_id = parseInt($(this).val());
			
			if (gradelevel_id){
				$.post("grade_action.php",{action:1, gradelevel_id:gradelevel_id},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
												
						$("#upload_section_id").html(data);	

						if (gradelevel_id < 4){
							$("#col_upload_subject_id").hide();
							$("#col_upload_quarter_id").show();
						}else if (gradelevel_id >=4 && gradelevel_id < 7){
							$("#col_upload_subject_id").show();
							$("#col_upload_quarter_id").hide();
						}					
					}
				});
			}else{
				alert("Error: Please select grade level first!");
			}
		});
		
		
		$(document).on("click","#btn_search",function(){
			var schoolyear_id = parseInt($("#schoolyear_id").val());
			var gradelevel_id = parseInt($("#gradelevel_id").val());
			var section_id = parseInt($("#section_id").val());
			var subject_id = parseInt($("#subject_id").val());
			
			if (schoolyear_id && gradelevel_id && section_id && subject_id){
				$.post("grade_action.php",{	action:2, schoolyear_id:schoolyear_id,
											gradelevel_id:gradelevel_id, 
											section_id:section_id,
											subject_id:subject_id
										  },function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						$("#tbl_grade tbody").html(data);						
						$('[data-toggle="tooltip"]').tooltip({html:true});
					}
				});
			}else{
				alert("Error: All fields must be filled!");
			}
		});


		$(document).on("click","#btn_upload",function(){
			$("#grade_upload_modal").modal();
		});

		$(document).on('click','#btn_grade_upload_save',function(){
			

			var schoolyear_id = parseInt($("#upload_schoolyear_id").val());
			var gradelevel_id = parseInt($("#upload_gradelevel_id").val());
			var section_id = parseInt($("#upload_section_id").val());
			var subject_id = parseInt($("#upload_subject_id").val());
			var quarter_id = parseInt($("#upload_quarter_id").val());
			var file_selected = $("#file_grade_upload").val();

			
			if (schoolyear_id && gradelevel_id && section_id){

				if (file_selected){
											
					var fd = new FormData(document.getElementById("frm_grade_upload"));
								
					fd.append("action",4);
					fd.append("schoolyear_id",schoolyear_id);
					fd.append("gradelevel_id",gradelevel_id);
					fd.append("section_id",section_id);
					fd.append("quarter_id",quarter_id);
					fd.append("subject_id",subject_id);
					

					$(".modal-body").hide();
					$(".modal_button").hide();
					$(".modal_error").hide();
					$(".modal_success").hide();
					$(".modal_waiting").show();					
																			
					$.ajax({
						url: "grade_action.php",
						type: "POST",
						data: fd,
						enctype: 'multipart/form-data',
						processData: false,  // tell jQuery not to process the data
						contentType: false   // tell jQuery not to set contentType
					}).done(function( data ) {
						alert(data);	
						$(".modal-body").show();
						$(".modal_button").show();							
						$(".modal_waiting").hide();        
									
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1 || data.indexOf("syntax error") > -1) {
							$(".modal_error_msg").html(data);
							$(".modal_error").show();
							//$(".modal_error").stop(true,true).show().delay(15000).fadeOut("slow");
						}else{											
							$('#file_grade_upload').val('');							
							var filename = /([^\\]+)$/.exec(file_selected)[1];
								
							$(".modal_success_msg").text("Successfully uploaded: " + filename);
							//$(".modal_success").show();
							$(".modal_success").stop(true,true).show().delay(15000).fadeOut("slow");							
						}
					});
					return false;
					
				}else{
					$(".modal_error_msg").text("Error: Select a file to upload!");
					$(".modal_error").stop(true,true).show().delay(15000).fadeOut("slow");	
				}
			}else{
				$(".modal_error_msg").text("Error: All fields are required!");
				$(".modal_error").stop(true,true).show().delay(15000).fadeOut("slow");	
			}
		});
			



		
		$(document).on("click",".btn_q1_add",function(e){
			e.preventDefault();
			
			var student_id = parseInt($(this).attr('id'));
						
			if (student_id){
				$(".student_id").val(student_id);
				$(".quarter_no").val(1);
				$("#lbl_field").text("Quarter 1 Grade");
				
				$("#grade_new").modal();
				$("#txt_grade").val("").focus();
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click",".btn_q2_add",function(e){
			e.preventDefault();
			
			var student_id = parseInt($(this).attr('id'));
						
			if (student_id){
				$(".student_id").val(student_id);
				$(".quarter_no").val(2);
				$("#lbl_field").text("Quarter 2 Grade");
				
				$("#grade_new").modal();
				$("#txt_grade").val("").focus();
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click",".btn_q3_add",function(e){
			e.preventDefault();
			
			var student_id = parseInt($(this).attr('id'));
						
			if (student_id){
				$(".student_id").val(student_id);
				$(".quarter_no").val(3);
				$("#lbl_field").text("Quarter 3 Grade");
				
				$("#grade_new").modal();
				$("#txt_grade").val("").focus();
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click",".btn_q4_add",function(e){
			e.preventDefault();
			
			var student_id = parseInt($(this).attr('id'));
						
			if (student_id){
				$(".student_id").val(student_id);
				$(".quarter_no").val(4);
				$("#lbl_field").text("Quarter 4 Grade");
				
				$("#grade_new").modal();
				$("#txt_grade").val("").focus();
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click","#btn_save",function(){
			var student_id = parseInt($(".student_id").val());
			var quarter_no = parseInt($(".quarter_no").val());
			var schoolyear_id = parseInt($("#schoolyear_id").val());
			var gradelevel_id = parseInt($("#gradelevel_id").val());
			var section_id = parseInt($("#section_id").val());
			var subject_id = parseInt($("#subject_id").val());
			var grade = parseFloat($("#txt_grade").val());
			
			if (student_id && quarter_no){
				if (schoolyear_id && gradelevel_id && section_id && subject_id && grade > -1){
					$.post("grade_action.php",{	action:3, schoolyear_id:schoolyear_id,
											gradelevel_id:gradelevel_id, 
											section_id:section_id,
											subject_id:subject_id,
											student_id:student_id,
											quarter_no:quarter_no,
											grade:grade
										  },function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						$("#tbl_grade tbody").html(data);						
						$('[data-toggle="tooltip"]').tooltip({html:true});
						$("#grade_new").modal("hide");
					}
				});
				}else{
					alert("Error: All fields are required!");
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
