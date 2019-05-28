<?php
	session_start();
	
	if (!empty($_SESSION['user_id'])){		
		header("Location: index.php");		
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
        <div class="card-header">Login</div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <div class="form-label-group">
				<label for="inputUsername">Username</label>
                <input type="text" id="inputUsername" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
                
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
				<label for="inputPassword">Password</label>				
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                
              </div>
            </div>   
			
            <a id="btn_login" class="login_button btn btn-primary btn-block" href="#">Login</a>
			
			<div  class="login_error text-center" style='display:none'>
				<div class="alert alert-danger">
					<strong>
						<i class="ace-icon fa fa-times"></i>						
					</strong>
					<span class="login_error_msg">
						Critical Error Encountered!
					</span>
																
					<br />
				</div>
			</div>
														
			<div class="login_waiting text-center" style='display:none'>
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
			
			$(document).on('keypress','#inputUsername, #inputPassword',function(e){
				if (e.which==13){
					$('#btn_login').trigger('click');
				}
			});
			
			$(document).on('click','#btn_login',function(e){
				e.preventDefault();	
				
				var u = $("#inputUsername").val();
				var p = $("#inputPassword").val();				
				
				if (u && p) {
					
					$('#inputUsername, #inputPassword').attr('disabled','disabled');
					$('.login_button, .login_error, .forgot-password-link').hide();
					$('.login_waiting').show();
					
					$.post("login_action.php",{uname: u, upass: p},function(data){						
						if (data.indexOf("Error:")>-1) {
							$("#inputUsername, #inputPassword").val("");
							$('#inputUsername, #inputPassword').removeAttr('disabled');
							$('.login_button').show();							
							$('.login_waiting').hide();							
							
							$("#inputUsername").trigger('select','focus');
							$(".login_error_msg").text(data);
							$(".login_error").stop(true,true).show().delay(15000).fadeOut("slow");
						}else{
							window.location = data;
						}						
					});
				}else{
					$("#inputUsername").trigger('select','focus');
					$(".login_error_msg").text("Login Failed!, Try Again.");
					$(".login_error").stop(true,true).show().delay(15000).fadeOut("slow");
				}
				
				
			});
	</script>

  </body>

</html>
