<div class="modal " id="faculty_new" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog modal-lg" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					New Entry	
				</h4>
				
			</div>   
            <div class="modal-body">
				<div class="row">
                    <div class="col-md-4  form-group">                           
                        <label >Lastname<span class='text-danger'>*</span></label>
                        <input id="txt_lastname" type='text' class='form-control  txt_faculty '  />
					</div>	
					<div class="col-md-4  form-group">                           
                        <label >Firstname<span class='text-danger'>*</span></label>
                        <input id="txt_firstname" type='text' class='form-control txt_faculty '  />
					</div>	
					<div class="col-md-4  form-group">                           
                        <label >Middlename</label>
                        <input id="txt_middlename" type='text' class='form-control  txt_faculty '  />
					</div>	
				</div>	

				<div class="row">
                    <div class="col-md-4  form-group">                           
                        <label >Gender</label>
                        <select id="txt_gender"  class='form-control  txt_faculty '>
							<option value=""> -- Select Gender -- </option>
							<?php
								include('connect.php');
								
								$sql = "SELECT * FROM gender_tbl ORDER BY gender DESC;";
								$pop = $mysqli->query($sql);
								while ($row = $pop->fetch_object()){
									$gender_id = $row->gender_id;
									$gender = $row->gender;
									
									echo "<option value='{$gender_id}'> {$gender} </option>";
								}
								
								$mysqli->close();
							?>
						</select>
					</div>	
					<div class="col-md-4  form-group">                           
                        <label >Birthday</label>
                        <input id="txt_birthday" type='date' class='form-control txt_faculty '  />
					</div>	
					<div class="col-md-4  form-group">                           
                        <label >Designation</label>
                        <input id="txt_designation" type='text' class='form-control  txt_faculty '  />
					</div>	
				</div>	
				
				<div class="row">
					<div class="col-md-4  form-group">                           
                        <label >Contact No</label>
                        <input id="txt_contact" type='text' class='form-control  txt_faculty '  />
					</div>	
					<div class="col-md-4  form-group">                           
                        <label >Emergency Contact Person</label>
                        <input id="txt_emergency_person" type='text' class='form-control  txt_faculty '  />
					</div>	
					<div class="col-md-4  form-group">                           
                        <label >Emergency Contact No</label>
                        <input id="txt_emergency_contact" type='text' class='form-control txt_faculty '  />
					</div>	
				</div>
				
				<div class="row">
					<div class="col-md-4  form-group">                           
                        <label >PRC License</label>
                        <input id="txt_prc" type='text' class='form-control  txt_faculty '  />
					</div>	
					<div class="col-md-8  form-group">                           
                        <label >Address</label>
                        <input id="txt_address" type='text' class='form-control  txt_faculty '  />
					</div>						
				</div>
				
				<div class="row">
					<div class="col-md-3  form-group">                           
                        <label >SSS No.</label>
                        <input id="txt_sss" type='text' class='form-control  txt_faculty '  />
					</div>	
					<div class="col-md-3  form-group">                           
                        <label >TIN No.</label>
                        <input id="txt_tin" type='text' class='form-control  txt_faculty '  />
					</div>	
					<div class="col-md-3  form-group">                           
                        <label >PhilHealth No.</label>
                        <input id="txt_philhealth" type='text' class='form-control  txt_faculty '  />
					</div>	
					<div class="col-md-3  form-group">                           
                        <label >Pagibig No.</label>
                        <input id="txt_pagibig" type='text' class='form-control  txt_faculty '  />
					</div>	
				</div>
				
			</div>
			<div class="modal-footer">
				<div class="row form-group text-center" >
                    <div class="col-sm-12">
						<div class='pull-right' id='cc_buttons'>
							<button id="btn_save" class='btn btn-success'><i class='fa fa-check fa-fw'></i> Save</button>
							<button class='btn btn-warning' data-dismiss='modal'><i class='fa fa-times fa-fw'></i> Cancel</button>
						</div>
                        								
						<div class="progress" id='faculty_progress' style='display:none'>
							<div class="progress-bar progress-bar-striped active" role="progressbar"
							aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
								Saving...Please wait!
							</div>
						</div>
						<div id="faculty_error" class="pull-left alert alert-danger" style='display:none;'>
							<i class='fa fa-times-circle '> <span id='faculty_error_msg'>Error: Critical Error Encountered!</span></i>
						</div>
                    </div>	
                </div>
			</div>
			
        </div>
    </div>
</div>