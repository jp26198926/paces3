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
                            SMS Settings							
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->
				
				<!-- Page Body -->
				
                <div class="row">
                    <div class="col-md-3" >
                    	<p>
                    		We use itextmo API for SMS notification, for more details please check this 
                    		<a href="https://www.itexmo.com/Developers/index.php"> link </a>
                    	</p>
                    	<p class="text-danger">
                    		Note: Trial API Code will be automatically expired if no transaction for 5 days!
                    	</p>
                    </div>
                    <div class="col-md-6" >
                    	<div class="row" style="margin-top: 0.5em;">
                    		<div class="col-md-12">
                    			<label>API Code</label>
                    			<input type="text" id="txt_sms_api_code" class="form-control" />
                    		</div>
                    	</div>
                    	<div class="row" style="margin-top: 0.5em;">
                    		<div class="col-md-12">
                    			<label>Registered Mobile No.</label>
                    			<input type="text" id="txt_sms_mobile" class="form-control" />
                    		</div>
                    	</div>
                    	<div class="row" style="margin-top: 0.5em;">
                    		<div class="col-md-12">
                    			<label>Registered Email</label>
                    			<input type="text" id="txt_sms_email" class="form-control" />
                    		</div>
                    	</div>
                    	<div class="row" style="margin-top: 0.5em;">
                    		<div class="col-md-12">
                    			<label>Registered Name</label>
                    			<input type="text" id="txt_sms_name" class="form-control" />
                    		</div>
                    	</div>

                    	<div class="row" style="margin-top: 1em;">
                    		<div class="col-md-6 text-right">
                    			<button id="btn_save" class="btn btn-success"><i class="fa fa-check fa-fw"></i> Save Changes </button>
                    		</div>
                    		<div class="col-md-6 text-left">
                    			<button id="btn_test" class="btn btn-primary"><i class="fa fa-send fa-fw"></i> Test SMS </button>
                    		</div>
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
			
			$.post("settings_sms_action.php",{action:1},function(data){
				if(data.indexOf("<!DOCTYPE html>")>-1){
					alert("Error: Session Time-Out, You must login again to continue.");
					location.reload(true);                     
				}else if (data.indexOf("Error: ")>-1) {                          
					alert(data);                        
				}else{
					if (data){
						var row = JSON.parse(data);

						var sms_api_code = row.sms_api_code;
						var sms_mobile = row.sms_mobile;
						var sms_email = row.sms_email
						var sms_name = row.sms_name;
						
						$("#txt_sms_api_code").val(sms_api_code);
						$("#txt_sms_mobile").val(sms_mobile);
						$("#txt_sms_email").val(sms_email);
						$("#txt_sms_name").val(sms_name);

					}else{
						alert("Error: There is an error retrieving the data!");
					}
					
				}
			});	
		});	

		$(document).on("click","#btn_save",function(){
			var sms_api_code = $("#txt_sms_api_code").val();
			var sms_mobile = $("#txt_sms_mobile").val();
			var sms_email = $("#txt_sms_email").val();
			var sms_name = $("#txt_sms_name").val();

			if (sms_api_code && sms_mobile && sms_email && sms_name){
				if (confirm("Are you sure you want to save the change?")){
					$.post("settings_sms_action.php",{	
														action:2,
														sms_api_code:sms_api_code,
														sms_mobile:sms_mobile,
														sms_email:sms_email,
														sms_name:sms_name
													 },function(data){
						if(data.indexOf("<!DOCTYPE html>")>-1){
							alert("Error: Session Time-Out, You must login again to continue.");
							location.reload(true);                     
						}else if (data.indexOf("Error: ")>-1) {                          
							alert(data);                        
						}else{
							alert(data);  
						}
					});	
				}				
			}else{
				alert("Error: All fields are required!");
			}
		});

		$(document).on("click","#btn_test",function(){
			var recepient_no = prompt("Please enter recepient mobile number");

			if (recepient_no != null) {
				$.post("settings_sms_action.php",{	
														action:3,
														recepient_no:recepient_no,
														msg:"Test SMS"
													 },function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
						alert("Error: Session Time-Out, You must login again to continue.");
						location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
						alert(data);                        
					}else{
						alert(data);  
					}
				});	
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
