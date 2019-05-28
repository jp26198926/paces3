<?php
	include('param.php');
	
	//$account_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	$offence_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
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
		include('offence_new.php');
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
                           Offence <small>List</small>
							<div class="pull-right">
								<a href="offence.php?id=<?= $offence_id; ?>" id="btn_search" class="btn btn-warning" ><i class="fa fa-reply fa-fw"></i> Offence</a> 
								<a href="#" id="btn_new" class="btn btn-success" ><i class="fa fa-plus fa-fw"></i>New Entry </a>
							</div>							
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->
				
				<!-- Page Body -->
				
				<div class="row">
					<input id="student_id" type="hidden" value="0" />
					<div class="col-xs-2">
						<div class="form-group">
							<label>LRN Number</label>
							<input type="text" id="lrn_number" class="form-control" readonly />
						</div>
					</div>
					<div class="col-xs-6">
						<div class="form-group">
							<label>Student Name</label>
							<input type="text" id="student_name" class="form-control" readonly />
						</div>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
							<label>Grade Level</label>
							<input type="text" id="gradelevel" class="form-control" readonly />
						</div>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
							<label>School Year</label>
							<input type="text" id="schoolyear" class="form-control" readonly />
						</div>
					</div>						
				</div>
			
                <div class="row">
                    <div class="col-lg-12">                        
						<div class="table-responsive" >
                            <table id="tbl_payment" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <tr>
											<th>Option</th>
																<div class="form-group">
					  <label for="incident_type">Incident Type</label>
					  <select class="form-control" name="incident_type" id="incident_type" value="<?php echo !empty($dbData['incident_type'])?$dbData['incident_type']:''; ?>">
						<option value = "Attendance" <?php if($dbData['incident_type']=="Attendance") echo 'selected="selected"'; ?> >Attendance</option>									
						<option value = "Conduct" <?php if($dbData['incident_type']=="Conduct") echo 'selected="selected"'; ?>  >Conduct</option>
						<option value = "Theft/Damage of Property" <?php if($dbData['incident_type']=="Theft/Damage of Property") echo 'selected="selected"'; ?> >Theft/Damage of Property</option>
						<option value = "Minor Offences" <?php if($dbData['incident_type']=="Minor Offences") echo 'selected="selected"'; ?> >Minor Offences</option>
					  <option value = "Serious Offences" <?php if($dbData['incident_type']=="Serious Offences") echo 'selected="selected"'; ?> >Serious Offences</option>
					</select>
					</div>
					
					
					<div class="form-group">
                        <label>Incident Date</label>
                        <input type="date" class="form-control" name="incident_date" value="<?php echo !empty($dbData['incident_date'])?$dbData['incident_date']:''; ?>">
                    </div>
					<div class="form-group">
					  <label for="description">description</label>
					  <select class="form-control" name="description" id="description" value="<?php echo !empty($dbData['description'])?$dbData['description']:''; ?>">
						<option value = "truancy" <?php if($dbData['description']=="truancy") echo 'selected="selected"'; ?>>Truancy </option>
						<option value = "leaving_school" <?php if($dbData['description']=="leaving_school") echo 'selected="selected"'; ?> >Leaving school grounds without permission</option>
						<option value = "extortion" <?php if($dbData['description']=="extortion") echo 'selected="selected"'; ?>>Extortion</option>
						<option value = "forgery" <?php if($dbData['description']=="forgery") echo  'selected="selected"'; ?>>Forgery</option>
						<option value = "bullying" <?php if($dbData['description']=="bullying") echo 'selected="selected"'; ?>>Bullying</option>
						<option value = "disruptive_behaviour" <?php if($dbData['description']=="disruptive_behaviour") echo  'selected="selected"'; ?>>Disruptive behaviour</option>
						<option value = "abuse_technology" <?php if($dbData['description']=="kinder") echo 'selected="selected"'; ?>>Abuse of technology</option>
						<option value = "defiance_rudeness" <?php if($dbData['description']=="defiance_rudeness") echo  'selected="selected"'; ?>>Open Defiance and/or rudeness</option>
					  </select>
					</div>

					<div class="form-group">
                        <label>Comments</label>
                        <input type="text" class="form-control" name="comments" value="<?php echo !empty($dbData['comments'])?$dbData['comments']:''; ?>">
                    </div>
					                <input type="hidden" name="offence_id" value="<?php echo $dbData['offence_id']; ?>">
                    <input type="submit" name="userSubmit" class="btn btn-success" value="SUBMIT"/>
                </form>
											<th>Date Encoded</th>											
										</tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan='7' align='center'> Use search button to display </td>
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
	
	//script tag not declared
	<script>
			
			//$offence_id not declare at the top
			var offence_id = "<?= $offence_id; ?>";
			
			if (parseInt(account_id) > 0){
				$.post("offence_action.php",{action:1, offence_id:offence_id},function(data){
					
					if(data.indexOf("<!DOCTYPE html>")>-1){
                        alert("Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
                        alert(data);                        
                    }else{
                        var student_info = data.split(":~||~:")[0];
						var ledger = data.split(":~||~:")[1];
						
						student_info = JSON.parse(student_info);
						$("#student_id").val(student_info["student_id"]);
						$("#lrn_number").val(student_info["lrn_no"]);
						$("#student_name").val(student_info["student_name"]);
						$("#gradelevel").val(student_info["gradelevel"]);
						$("#schoolyear").val(student_info["sy"]);

						$("#tbl_offence tbody").html(ledger);
						
                    }
				});
			}
		});
		
		$(document).on("click","#btn_new",function(){
			var student_id = $("#student_id").val();
			
			if (parseInt(student_id) > 0){
				$.post("offence_action.php",{action:2, student_id:student_id},function(data){
					
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						$("#txt_offence_date").val(data);
						$("#offence_new").modal();	
						$("#txt_decription").select().focus();
						$("#txt_remarks").select().focus();
					}
				});
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click","#btn_save",function(){
			var student_id = parseInt($("#student_id").val());
			var offence_date = parseFloat($("#txt_offence_date").val());
			var decription= $("#txt_decription").val();
			var remarks = $("#txt_remarks").val();
			
			if (student_id > 0){
				$.post("offence_action.php",{action:3, student_id:student_id, offence_date:offence_date, decription:decription,  remarks:remarks},function(data){
					
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						$("#tbl_offence tbody").html(data);
						$("#offence_new").modal('hide');
						$(".txt_offence").val('');
					}
				});
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
