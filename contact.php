
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

<div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Contact
        <small>Pasay Adventist Church Elementary School</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active">Contact</li>
      </ol>

      <!-- Content Row -->
      <div class="row">
        <!-- Map Column -->
        <div class="col-lg-8 mb-4">
          <!-- Embedded Google Map -->
          <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.7898206611276!2d120.99337471483977!3d14.554008489832148!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c96472fd4143%3A0xf967f7e74fa0a5d5!2sPasay+Adventist+Church+Elementary+School!5e0!3m2!1sen!2sph!4v1535405318108"></iframe>
        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-4 mb-4">
          <h3>Contact Details</h3>
          <p>
            Gil Puyat Avenue, Pasay City
            <br>1300 Buendia Ave
            <br>
          </p>
          <p>
            <abbr title="Phone">P</abbr>: (02) 525 5758
          </p>
          <p>
            <abbr title="Email">E</abbr>:
            <a href="mailto:paces_official@gmail.com">paces_official@gmail.com
            </a>
          </p>
          <p>
            <abbr title="Hours">H</abbr>: Monday - Friday: 9:00 AM to 5:00 PM
          </p>
        </div>
      </div>
      <!-- /.row -->


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
