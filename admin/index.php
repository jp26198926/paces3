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
                            Dashboard                            
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->
				
				<!-- Page Body -->
                <div class="row">
                    <div class="col-lg-12">                        
						<div style="float:left; width:auto; padding:10px;"><a href="student.php" id="addq"><img src="../images/Student-id-icon.png" height="64" width="64"><br>Student</a></div>
						<div style="float:left; width:auto; padding:10px;"><a href="faculty.php" id="addq"><img src="../images/Teachers-icon.png" height="64" width="64"><br>Faculty</a></div>
						<div style="float:left; width:auto; padding:10px;"><a href="schoolyear.php" id="addq"><img src="../images/calendar.jpg" height="64" width="64"><br>School Year</a></div>
						<div style="float:left; width:auto; padding:10px;"><a href="subject.php" id="addq"><img src="../images/subjectlist.jpg" height="64" width="64"><br>Subjects></div>
						<div style="float:left; width:auto; padding:10px;"><a href="offences.php" id="addq"><img src="../images/guidance.png" height="64" width="64"><br>Offences</a></div>
						<div style="float:left; width:auto; padding:10px;"><a href="user.php" id="addq"><img src="../images/logincreate.jpg" height="64" width="64"><br>USER ACCOUNTS</a></div>
						<div style="float:left; width:auto; padding:10px;"><a href="cashier.php" id="addq"><img src="../images/cashier.jpg" height="64" width="64"><br>Cashier</a></div>
						<div style="float:left; width:auto; padding:10px;"><a rel="facebox" href="advisory.php" id="addq"><img src="../images/teacher-icon.png" height="64" width="64"><br>Advisory</a></div>
						<div style="float:left; width:auto; padding:10px;"><a href="tuition.php" id="addq"><img src="../images/payment-icon.png" height="64" width="64"><br>Tuition</a></div>
						<div style="float:left; width:auto; padding:10px;"><a href="section.php" id="addq"><img src="../images/pie-chart-icon.png" height="64" width="64"><br>Section</a></div>                   
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

</body>

</html>
