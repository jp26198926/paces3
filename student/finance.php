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
                            Finances <small></small>							
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->
				
				<!-- Page Body -->
				<div class="row">
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-6 form-group">
								Tuition Fee : 
								<input id="txt_tuition" type="text" class="form-control" value="20,000.00" readonly />					
							</div>
						
							<div class="col-md-6  form-group">
								General Fee : 
								<input id="txt_general" type="text" class="form-control" value="<?= $gradelevel; ?>" readonly />							
							</div>
							
							<div class="col-md-6  form-group">
								Other Fee : 
								<input id="txt_other" type="text" class="form-control" value="<?= $section; ?>" readonly />							
							</div>
							
							<div class="col-md-6  form-group">
								Auxiliary Fee : 
								<input id="txt_auxiliary" type="text" class="form-control" value="<?= $section; ?>" readonly />							
							</div>
							
							
							<div class="col-md-12  form-group">
								Discount (%) : 
								<input id="txt_discount" type="text" class="form-control" value="<?= $section; ?>" readonly />							
							</div>
								
							<div class="col-md-12  form-group">
								Grand Total : 
								<input id="txt_total" type="text" class="form-control" value="<?= $section; ?>" readonly />							
							</div>
								
							<div class="col-md-12  form-group form-group-lg has-error">
								Balance : 
								<input id="txt_balance" type="text" class="form-control" value="<?= $section; ?>" readonly />							
							</div>
							
						</div>
					</div>
					
					<div class="col-md-8">
						<div class="row">
							<div class="col-lg-12" >  
								
								<div class="table-responsive">		
									<label>Payment History</label>
									<table id="tbl_finance" class="table table-bordered table-hover table-striped">
										<thead>
											<tr>
												<tr>											
													<th>OR No.</th>
													<th>OR Date</th>
													<th>Amount</th>
													<th>Running Bal.</th>
													<th>Remarks</th>											
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
					</div>
					
				</div>
                
				
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
			$('[data-toggle="tooltip"]').tooltip({html:true});
			
			$.post("finance_action.php",{	action:1},function(data){
				if(data.indexOf("<!DOCTYPE html>")>-1){
					alert("Error: Session Time-Out, You must login again to continue.");
					location.reload(true);                     
				}else if (data.indexOf("Error: ")>-1) {                          
					alert(data);                        
				}else{
					var account = data.split("~:||:~")[0];
					var payment = data.split("~:||:~")[1];
					
					account = JSON.parse(account);
					
					$("#txt_tuition").val(account["tuition_fee"]);
					$("#txt_general").val(account["general_fee"]);
					$("#txt_other").val(account["other_fee"]);
					$("#txt_auxiliary").val(account["auxiliary_fee"]);
					$("#txt_discount").val(account["discount_percentage"]);
					$("#txt_total").val(account["grand_total"]);
					$("#txt_balance").val(account["balance"]);
					
					$("#tbl_finance tbody").html(payment);						
					$('[data-toggle="tooltip"]').tooltip({html:true});
				}
			});
			
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
