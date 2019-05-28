<?php
	include('param.php');
	
	$student_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
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
                            Account <small>New Entry</small>							
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->
				
				<!-- Page Body -->
                <div class="row">
                    <div class="col-lg-12">                        
						<div class="row">
							<input id="student_id" type="hidden" value="<?= $student_id; ?>" />
								
							<div class="col-xs-6">
								<div class="form-group">
									<label>LRN Number</label>
									<input type="text" id="lrn_number" class="form-control" readonly />
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group">
									<label>Grade Level</label>
									<input type="text" id="gradelevel" class="form-control" readonly />
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group">
									<label>School Year</label>
									<input type="text" id="schoolyear" class="form-control" readonly />
								</div>
							</div>
						</div>	
						
						<div class="row">
							<div class="col-xs-3">
								<div class="form-group">
									<label>Lastname</label>
									<input type="text" id="lastname" class="form-control" readonly />
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group">
									<label>Firstname</label>
									<input type="text" id="firstname" class="form-control" readonly />
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group">
									<label>Middlename</label>
									<input type="text" id="middlename" class="form-control" readonly />
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group">
									<label>Extension</label>
									<input type="text" id="extname" class="form-control" readonly />
								</div>
							</div>
						</div>	
						
						<div class="row">
							<div class="col-xs-6">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Financer Name<span class="text-danger">*</span></label>
											<input type="text" id="financer_name" class="form-control" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Financer Address</label>
											<input type="text" id="financer_address" class="form-control" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Financer Contact<span class="text-danger">*</span></label>
											<input type="text" id="financer_contact" class="form-control" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Financer Relationship</label>
											<input type="text" id="financer_relationship" class="form-control" />
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-xs-6">								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Tuition Fee</label>
											<input type="text" id="tuition_fee" class="form-control numeric text-right" placeholder="0.00" readonly  />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>General Fee</label>
											<input type="text" id="general_fee" class="form-control numeric text-right" placeholder="0.00" readonly  />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Other Fee</label>
											<input type="text" id="other_fee" class="form-control numeric text-right" placeholder="0.00" readonly />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Auxiliary Fee</label>
											<input type="text" id="auxiliary_fee" class="form-control numeric text-right" placeholder="0.00" readonly  />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Discount (%)</label>
											<input type="text" id="discount_percentage" class="form-control numeric text-right" value="0" placeholder="0" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Grand Total</label>
											<input type="text" id="grand_total" class="form-control numeric text-right" placeholder="0.00" readonly />
										</div>
									</div>
								</div>
							</div>
							
							
						</div>	
							
						<div class="row ">
							<div class="col-xs-4" ></div>
							<div class="col-xs-4 text-center" >
								<button id="btnSave" type="btn" class="btn btn-lg btn-success fa fa-check "> Save </button>
								<a href="account.php" class="btn btn-warning btn-lg fa fa-times "> Close </a>
							</div>
							<div class="col-xs-4 " ></div>
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
			var student_id = $("#student_id").val();
			
			if (parseInt(student_id) > 0){
				$.post("account_action.php",{action:1, student_id:student_id},function(data){
					
					if(data.indexOf("<!DOCTYPE html>")>-1){
                        alert("Error: Session Time-Out, You must login again to continue.");
                        location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
                        alert(data); 
						window.location = "account.php";
                    }else{
						data = JSON.parse(data);
						
						var tuition_fee = data["tuition_fee"] ? parseFloat(data["tuition_fee"]) : 0;
						var general_fee = data["general_fee"] ? parseFloat(data["general_fee"]) : 0;
						var other_fee = data["other_fee"] ? parseFloat(data["other_fee"]) : 0;
						var auxiliary_fee = data["auxiliary_fee"] ? parseFloat(data["auxiliary_fee"]) : 0;
						var grand_total = tuition_fee + general_fee + other_fee + auxiliary_fee;
                        
						$("#lrn_number").val(data["lrn_no"]);
						$("#gradelevel").val(data["gradelevel"]);
						$("#schoolyear").val(data["sy"]);
						$("#lastname").val(data["lastname"]);
						$("#firstname").val(data["firstname"]);
						$("#middlename").val(data["middlename"]);
						$("#extname").val(data["extname"]);
						$("#tuition_fee").val(tuition_fee);
						$("#general_fee").val(general_fee);
						$("#other_fee").val(other_fee);
						$("#auxiliary_fee").val(auxiliary_fee);
						$("#grand_total").val(grand_total);
                    }
				});
			}else{
				window.location = "account.php";
			}
		});
		
		$(document).on("keyup","#discount_percentage",function(e){
			$(this).trigger("click");
		});
		
		$(document).on("click","#discount_percentage",function(){			
			if ($(this).val().length > 0){
				var tuition_fee = parseFloat($("#tuition_fee").val());
				var general_fee = parseFloat($("#general_fee").val());
				var other_fee = parseFloat($("#other_fee").val());
				var auxiliary_fee = parseFloat($("#auxiliary_fee").val());
				var grand_total = tuition_fee + general_fee + other_fee + auxiliary_fee;
				var discount_percentage = (parseFloat($("#discount_percentage").val()) / 100);
				
				var discount = grand_total * discount_percentage;
				
				$("#grand_total").val(grand_total - discount);	
			}			
		});
	
		$(document).on("click","#btnSave",function(){
			var action = 4; //default action = 4 means new entry
			var student_id = parseInt($("#student_id").val());
			var tuition_fee = parseFloat($("#tuition_fee").val());
			var general_fee = parseFloat($("#general_fee").val());
			var other_fee = parseFloat($("#other_fee").val());
			var auxiliary_fee = parseFloat($("#auxiliary_fee").val());
			var discount_percentage = parseFloat($("#discount_percentage").val());
			var grand_total = parseFloat($("#grand_total").val());
			var financer_name = $("#financer_name").val();
			var financer_address = $("#financer_address").val();
			var financer_contact = $("#financer_contact").val();
			var financer_relationship = $("#financer_relationship").val();
			
			if (student_id){
				if (financer_name && financer_contact){
					$.post("account_action.php",{
						action:action,
						student_id:student_id,
						tuition_fee:tuition_fee,
						general_fee:general_fee,
						other_fee:other_fee,
						auxiliary_fee:auxiliary_fee,
						discount_percentage:discount_percentage,
						grand_total:grand_total,
						financer_name:financer_name,
						financer_address:financer_address,
						financer_contact:financer_contact,
						financer_relationship:financer_relationship					
					},function(data){
						
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							window.location="account.php?id=" + data;  
						}
					});
				}else{
					alert("Error: Financer Name and Contact are required!");
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
