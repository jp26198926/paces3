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
                            Rankings <small></small>							
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
						Quarter : 
						<select id="quarter_no" class="form-control">
							<option value="1">Quarter 1</option>
							<option value="2">Quarter 2</option>
							<option value="3">Quarter 3</option>
							<option value="4">Quarter 4</option>
							<option value="5">Over - All</option>
						</select>						
					</div>
					
					<div class="col-md-2  form-group">
						<br />
						<button id="btn_search" class="btn btn-success" ><i class="fa fa-search fa-fw"></i> Show Result</button>
					</div>
				</div>
                <div class="row">
                    <div class="col-lg-12" >  
						
						<div class="table-responsive">							
                            <table id="tbl_ranking" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <tr>
											<th>Top</th>
											<th>LRN No.</th>
											<th>Student Name</th>
											<th>Gender</th>
											<th>Grade Level</th>
											<th>Section</th>
											<th>Average</th>
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
	
	<!-- custom script -->
	<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip({html:true});
		});
		
		$(document).on("click","#btn_search",function(){
			var schoolyear_id = parseInt($("#schoolyear_id").val());
			var gradelevel_id = parseInt($("#gradelevel_id").val());
			var quarter_no = parseInt($("#quarter_no").val());
						
			if (schoolyear_id && gradelevel_id && quarter_no){
				$.post("ranking_action.php",{action:1, schoolyear_id:schoolyear_id,
											gradelevel_id:gradelevel_id, 
											quarter_no:quarter_no
										  },function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						$("#tbl_ranking tbody").html(data);						
						$('[data-toggle="tooltip"]').tooltip({html:true});
					}
				});
			}else{
				alert("Error: All fields must be filled!");
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
