<?php
	include('param.php');
	
	$account_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
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
		include('payment_new.php');
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
                            Payment <small>Ledger</small>
							<div class="pull-right">
								<a href="account.php?id=<?= $account_id; ?>" id="btn_search" class="btn btn-warning" ><i class="fa fa-reply fa-fw"></i> Accounts</a> 
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
											<th>OR Number</th>
											<th>OR Date</th>
											<th>Amount</th>											
											<th>Balance</th>
											<th>Remarks</th>
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
			var account_id = "<?= $account_id; ?>";
			
			if (parseInt(account_id) > 0){
				$.post("payment_action.php",{action:1, account_id:account_id},function(data){
					
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

						$("#tbl_payment tbody").html(ledger);
						
                    }
				});
			}
		});
		
		$(document).on("click","#btn_new",function(){
			var student_id = $("#student_id").val();
			
			if (parseInt(student_id) > 0){
				$.post("payment_action.php",{action:2, student_id:student_id},function(data){
					
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						$("#txt_balance").val(data);
						$("#payment_new").modal();	
						
						$("#txt_or_no").select().focus();
					}
				});
			}else{
				alert("Error: Critical Error Encountered!");
			}
		});
		
		$(document).on("click","#btn_save",function(){
			var student_id = parseInt($("#student_id").val());
			var or_no = parseFloat($("#txt_or_no").val());
			var or_date = $("#txt_or_date").val();
			var amount = $("#txt_amount").val();
			var remarks = $("#txt_remarks").val();
			
			if (student_id > 0){
				$.post("payment_action.php",{action:3, student_id:student_id, or_no:or_no, or_date:or_date, amount:amount, remarks:remarks},function(data){
					
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						$("#tbl_payment tbody").html(data);
						$("#payment_new").modal('hide');
						$(".txt_payment").val('');
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
