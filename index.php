
<?php
$basedir = realpath(__DIR__);
    ob_start();	
    include('header.php'); 
    $buffer=ob_get_contents();
    ob_end_clean();

    $title = "Pasay Adventist Church Elementary School"; /* This should be declared - MAKE SURE TO CHANGE THIS */
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

    echo $buffer;
	
	
	
?>

<body>

<?php include 'nav.php'; ?>
	
<div class="container">

	<!-- /* UNIQUE CONTENT GOES HERE | DITO LANG PWEDE MAG EDIT NG SITE CONTENT */ -->
<header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('images/paces1.png')">
            <div class="carousel-caption d-none d-md-block">
            
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('images/filweek2.jpg')">
            <div class="carousel-caption d-none d-md-block">
            
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('images/pasayquad2.jpg')">
            <div class="carousel-caption d-none d-md-block">
            
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4">Pasay Adventist Church Elementary School</h1>

      <!-- Marketing Icons Section -->
      <div class="row">
        <div class="col-lg-4 mb-4" style="padding-top: 70px; margin-top: -70px;" id="mission">
          <div class="card h-100">
            <h4 class="card-header"  >Mission</h4>
            <div class="card-body">
              <p class="card-text">To restore in man the image  of its Maker by preparing pupils for effective and rewarding citizenship on this earth and in the New Earth. </p>
            </div>
            
          </div>
        </div>
        <div class="col-lg-4 mb-4" style="padding-top: 70px; margin-top: -70px;" id="vision">
          <div class="card h-100">
            <h4 class="card-header" >Vision</h4>
            <div class="card-body">
              <p class="card-text">A dynamic, progressive and Christ-centered school whose teachers, staff and pupils are committed to the ideals of Adventist Education>
            </div>
           
          </div>
        </div>
        <div class="col-lg-4 mb-4" style="padding-top: 70px; margin-top: -70px;" id="goals">
          <div class="card h-100">
            <h4 class="card-header" >Goals & Objectives</h4>
            <div class="card-body">
              <p class="card-text"><li>A Christian school where God comes first</li>
								<li>Christian values are taught and encouraged</li>
								<li>Caring family environment</li>
								<li>Student success, achievement and priority</li>
								<li>Small classes allowing more individual attention</li>
				</p>
            </div>
     
          </div>

        </div>
		 
      </div>
      <!-- /.row -->

     
      <!-- Features Section -->
      <div class="row">
        <div class="col-lg-6" style="padding-top: 70px; margin-top: -70px;" id="history" >
          <h2>School History</h2>
        
          <p>
			The school was located at  #2059 Donada Street 1300 Pasay City Philippines. Pasay Adventist Elementary School has a rich history for the first Adventist School established in Pasay was on 1930.

				
			 Since then, educational development in this site was established; And more and more schools was established outside Pasay City. The school was closed in 1941 due to the Second World War but in 1945, it reopened with five grades. From then on, it branched out into an academy and later, the elementary was renamed, PASAY ADVENTIST CHURCH ELEMENTARY SCHOOL.
		</p>
        </div>
        <div class="col-lg-6">
          <img class="img-fluid rounded" src="images/filweek.jpg" alt="">
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Call to Action Section -->
      <div class="row mb-4">
        <div class="col-md-8">
          <p>It was said that PACES legacy goes on with known graduates leaving footprints that encompasses the globe. Footprints that were highlighted by the positive contributions of its products. </p>
        </div>
        <div class="col-md-4">
          <a class="btn btn-lg btn-secondary btn-block" href="https://www.facebook.com/Pasay-Adventist-Church-Elementary-School-158641041491695">Like us on Facebook</a>
        </div>
      </div>

    </div>
    <!-- /.container -->
	
	
	
	
	
	
	
	
	
	
	
	<!-- /* Hanggang dito lang  */ -->

</div>


<?php 
	include('footer.php'); 
	include('register.php');
?>
		
	
	<script>
		function reloadCaptcha()
	    {
	        //$('#siimage').prop('src', './securimage_show.php?sid=' + Math.random());
	        $("#btn_captcha_refresh").trigger("click");
	    }

		function isNumberKey(evt){
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if (charCode != 46 && charCode > 31 
				&& (charCode < 48 || charCode > 57))
				return false;

			return true;
		}
		
		$(document).on("click","#menu_registration",function(){			
			$("#register").modal();
		});
	
		$(document).on("click","#btnSave",function(){
			var action = 3; //default action = 3 means new entry
			var student_id = parseInt($("#student_id").val());
			var lrn = $("#lrn_number").val();
			var sy = parseInt($("#sy").val());
			var gradelevel = parseInt($("#gradelevel").val());
			var firstname = $("#FirstName").val();
			var lastname = $("#LastName").val();
			var middlename = $("#MiddleName").val();
			var extname = $("#ExtName").val();
			var gender = $("#gender").val();
			var birthday = $("#Birthday").val();
			var birthplace = $("#BirthPlace").val();
			var address = $("#Address").val();
			var last_school_attended = $("#LastSchoolAttended").val();
			var grade_completed = $("#grade_completed").val();
			var general_average = $("#GeneralAverage").val();
			var guardians_name = $("#GuardiansName").val();
			var guardians_contact = $("#GuardiansContact").val();
			var fathers_name = $("#FathersName").val();
			var fathers_occupation = $("#FathersOccupation").val();
			var fathers_contact = $("#FathersContact").val();
			var fathers_religion = $("#FathersReligion").val();
			var mothers_mname = $("#MothersMName").val();
			var mothers_occupation = $("#MothersOccupation").val();
			var mothers_contact = $("#MothersContact").val();
			var mothers_religion = $("#MothersReligion").val();

			var captcha = $("#captcha_code").val();
			
			if (student_id){ //update
				action = 4; 
			}else{ //new entry
				action = 3;
			}
			
			if (sy && gradelevel && firstname && lastname && middlename){

				//validate captcha
				$.post("admin/student_action.php",{action:7, captcha:captcha},function(data){
					if(data.indexOf("<!DOCTYPE html>")>-1){
	                    alert("Error: Session Time-Out, You must login again to continue.");
	                    location.reload(true);                     
					}else if (data.indexOf("Error: ")>-1) {                          
	                    alert(data); 
	                }else{	
	                	//success                	
	                	reloadCaptcha();

	                	//start saving data
	                	$.post("admin/student_action.php",{
							action:action,
							student_id:student_id,
							lrn:lrn,
							sy:sy,
							gradelevel:gradelevel,
							firstname:firstname,
							lastname:lastname,
							middlename:middlename,
							extname:extname,
							gender:gender,
							birthday:birthday,
							birthplace:birthplace,
							address:address,
							last_school_attended:last_school_attended,
							grade_completed:grade_completed,
							general_average:general_average,
							guardians_name:guardians_name,
							guardians_contact:guardians_contact,
							fathers_name:fathers_name,
							fathers_occupation:fathers_occupation,
							fathers_contact:fathers_contact,
							fathers_religion:fathers_religion,
							mothers_mname:mothers_mname,
							mothers_occupation:mothers_occupation,
							mothers_contact:mothers_contact,
							mothers_religion:mothers_religion,
							captcha:captcha
						},function(data){
							
							if(data.indexOf("<!DOCTYPE html>")>-1){
		                        alert("Error: Session Time-Out, You must login again to continue.");
		                        location.reload(true);                     
							}else if (data.indexOf("Error: ")>-1) {                          
		                        alert(data);                        
		                    }else{	
								$("#register").modal("hide");
							
								var msg = "Hi " + firstname.toUpperCase() + ", \n\n";
									msg += "Thank you for registering to PACES. To complete the enrollment process, ";
									msg += "please visit our campus for the assessment. \n\n\n";
									msg += "Thank you!";
								
								alert(msg);
		                        
								location.reload();
		                    }
						});
	                }
				});
			}else{				
				alert("Error: Firstname, Lastname, Middlename, SY and Grade Level are required field!");
			}
		});
		
		
	</script>

</body>


</html>
