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
                            Security <small></small>							
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->
				
				<!-- Page Body -->
						
							<div class="row">
								<div class="col-md-12 text-center" style="margin-bottom:0.8em;">
									<span class="alert alert-warning">Please answer below questions. This will help you to reset your password in case you forget!</span>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>What is the name of your first pet?</label>
										<input type="text" id="answer1" class="form-control" />
									</div>
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Who is your favorite teacher?</label>
										<input type="text" id="answer2" class="form-control" />
									</div>
								</div>
							</div>		
							
							<div class="row ">
								<div class="col-md-4" ></div>
								<div class="col-md-4 text-center" >	
									<button type="btn" id="btn_answer_save" class="btn btn-success" >Save</button>
								</div>
								<div class="col-md-4 " ></div>
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
				$.post("security_action.php",{action:1},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						data = JSON.parse(data);						
						
						$("#answer1").val(data["answer1"]);
						$("#answer2").val(data["answer2"]);
					}
				});
		});
		
		$(document).on("click","#btn_answer_save",function(){
				
			var answer1 = $("#answer1").val();
			var answer2 = $("#answer2").val();			
			
			if (answer1 && answer2){
				$.post("security_action.php",{action:2, answer1:answer1, answer2:answer2},function(data){
						
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							alert("Successfully Saved!");
						}
					});
				}else{				
					alert("Error: Please answer all questions!");
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
