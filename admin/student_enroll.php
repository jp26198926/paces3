<div class="modal " id="student_enroll" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					Enrollment	
					<input type='hidden' id='student_id' value='0' />
				</h4>
				
			</div>   
            <div class="modal-body">
				<div class="row">					
                    <div class="col-md-8  form-group">                           
                        <label >Student Name</label>
						<input type='text' id="txt_enroll_student" class="form-control" readonly />
					</div>	
					<div class="col-md-4  form-group">                           
                        <label >School Year</label>
						<input type='text' id="txt_enroll_schoolyear" class="form-control" readonly />
					</div>					
				</div>
						
				<div class="row">
					<div class="col-md-6  form-group">                           
                        <label >Grade Level</label>
						<input type='text' id="txt_enroll_gradelevel" class="form-control" readonly />
					</div>
                    <div class="col-md-6  form-group">                           
                        <label >Set Section<span class='text-danger'>*</span></label>
                        <select id="txt_enroll_section" class="form-control">
							<?php
								include('connect.php');
								
								$sql = "SELECT * FROM section_tbl ORDER BY section_name;";
								$pop = $mysqli->query($sql);
								if ($pop){
									while($row = $pop->fetch_object()){
										$section_id = $row->section_id;
										$section_name = $row->section_name;
										echo "<option value='{$section_id}'> {$section_name} </option>";;
									}
								}
								
								$mysqli->close();
							?>
						</select>
					</div>					
				</div>
				
				<hr />
				
				<div class="row">
					<div class="col-md-12 text-center">
						<span class="alert-success"><label>Create Online Account</label></span>
						
					</div>
				</div>
				
				<div class="row">					
                    <div class="col-md-4  form-group">                           
                        <label >Username<span class="text-danger">*</span></label>
						<input type='text' id="txt_enroll_username" class="form-control"  />
					</div>	
					<div class="col-md-4  form-group">                           
                        <label >Password<span class="text-danger">*</span></label>
						<input type='password' id="txt_enroll_password" class="form-control"  />
					</div>
					<div class="col-md-4  form-group">                           
                        <label >Re-Password<span class="text-danger">*</span></label>
						<input type='password' id="txt_enroll_repassword" class="form-control"  />
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<div class="row form-group text-center" >
                    <div class="col-sm-12">
						<div class='pull-right' id='cc_buttons'>
							<button id="btn_enroll_save" class='btn btn-primary'><i class='fa fa-check fa-fw'></i> Enroll</button>
							<button class='btn btn-danger' data-dismiss='modal'><i class='fa fa-times fa-fw'></i> Cancel</button>
						</div>
                        								
						<div class="progress" id='payment_progress' style='display:none'>
							<div class="progress-bar progress-bar-striped active" role="progressbar"
							aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
								Saving...Please wait!
							</div>
						</div>
						<div id="payment_error" class="pull-left alert alert-danger" style='display:none;'>
							<i class='fa fa-times-circle '> <span id='payment_error_msg'>Error: Critical Error Encountered!</span></i>
						</div>
                    </div>	
                </div>
			</div>
			
        </div>
    </div>
</div>