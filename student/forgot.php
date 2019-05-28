<?php
	session_start();
	
	if (!empty($_SESSION['student_id'])){		
		header("Location: grade.php");		
	}
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PACES</title>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container col-md-4">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Forgot Password</div>
        <div class="card-body">
          <form>
			<div class="form-group">
              <div class="form-label-group">
				<label>Username</label>
				<input type="text" id="username" class="form-control" autofocus />
              </div>
            </div>
			
            <div class="form-group">
              <div class="form-label-group">
				<label>What is the name of your first pet?</label>
				<input type="text" id="answer1" class="form-control"  />
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
				<label>Who is your favorite teacher?</label>
				<input type="text" id="answer2" class="form-control" />
              </div>
            </div>  
			
			<hr />
			
			<div class="form-group">
              <div class="form-label-group">
				<label>New Password</label>
				<input type="password" id="password" class="form-control" />
              </div>
            </div> 
			<div class="form-group">
              <div class="form-label-group">
				<label>Confirm Password</label>
				<input type="password" id="repassword" class="form-control" />
              </div>
            </div> 
			
            <a id="btn_change_password" class="login_button btn btn-primary btn-block" href="#">Change Password</a>
			
			<div  class="forgot_error text-center" style='display:none'>
				<div class="alert alert-danger">
					<strong>
						<i class="ace-icon fa fa-times"></i>						
					</strong>
					<span class="forgot_error_msg">
						Critical Error Encountered!
					</span>
																
					<br />
				</div>
			</div>
														
			<div class="forgot_waiting text-center" style='display:none'>
				<div class="progress">
					<div class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
						Validating your credential... Please wait!
					</div>
				</div>
			</div>
			
		  </form>
          
		  <div class="text-center">
			<a class="d-block small" href="../index.php">Home Page</a>	
		  </div>
		  
		  
		  
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
	
	<script>
			$(document).ready(function(){
				$('#inputUsername').trigger('select','focus');
			});
			
			$(document).on('keypress','#answer1, #answer2, #password, #repassword',function(e){
				if (e.which==13){
					$('#btn_change_password').trigger('click');
				}
			});
			
			$(document).on('click','#btn_change_password',function(e){
				e.preventDefault();	
				
				var username = $("#username").val();
				var answer1 = $("#answer1").val();
				var answer2 = $("#answer2").val();
				var password = $("#password").val();
				var repassword = $("#repassword").val();
				
				if (username && answer1 && answer2 && password && repassword) {
					
					if (password == repassword){
					
						$.post("forgot_action.php",{username:username, answer1:answer1, answer2:answer2,
													password:password, repassword:repassword},function(data){						
							if (data.indexOf("Error:")>-1) {							
								$("#username").trigger('select','focus');
								$(".forgot_error_msg").text(data);
								$(".forgot_error").stop(true,true).show().delay(20000).fadeOut("slow");
							}else{
								alert("Successfully changed!");
								window.location = "login.php";
							}						
						});
					}else{
						$("#password").trigger('select','focus');
						$(".forgot_error_msg").text("Password does not match!");
						$(".forgot_error").stop(true,true).show().delay(20000).fadeOut("slow");
					}
				}else{
					$("#username").trigger('select','focus');
					$(".forgot_error_msg").text("All Fields are required");
					$(".forgot_error").stop(true,true).show().delay(20000).fadeOut("slow");
				}
				
				
			});
	</script>

  </body>

</html>
