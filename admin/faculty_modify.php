<div class="modal " id="faculty_modify" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog modal-lg" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					Faculty Record
					<span class="pull-right">
						Status: <span id="txt_status_update"></span>
					</span>
				</h4>
				
			</div>   
            <div class="modal-body">
				<input type="hidden" class="faculty_id" value="0" />
				<div class="row">
                    <div class="col-md-4  form-group">                           
                        <label >Lastname<span class='text-danger'>*</span></label>
                        <input id="txt_lastname_update" type='text' class='form-control  txt_faculty '  />
					</div>	
					<div class="col-md-4  form-group">                           
                        <label >Firstname<span class='text-danger'>*</span></label>
                        <input id="txt_firstname_update" type='text' class='form-control txt_faculty '  />
					</div>	
					<div class="col-md-4  form-group">                           
                        <label >Middlename</label>
                        <input id="txt_middlename_update" type='text' class='form-control  txt_faculty '  />
					</div>	
				</div>	

				<div class="row">
                    <div class="col-md-4  form-group">                           
                        <label >Gender</label>
                        <select id="txt_gender_update"  class='form-control  txt_faculty '>
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
                        <input id="txt_birthday_update" type='date' class='form-control txt_faculty '  />
					</div>	
					<div class="col-md-4  form-group">                           
                        <label >Designation</label>
                        <input id="txt_designation_update" type='text' class='form-control  txt_faculty '  />
					</div>	
				</div>	
				
				<div class="row">
					<div class="col-md-4  form-group">                           
                        <label >Contact No</label>
                        <input id="txt_contact_update" type='text' class='form-control  txt_faculty '  />
					</div>	
					<div class="col-md-4  form-group">                           
                        <label >Emergency Contact Person</label>
                        <input id="txt_emergency_person_update" type='text' class='form-control  txt_faculty '  />
					</div>	
					<div class="col-md-4  form-group">                           
                        <label >Emergency Contact No</label>
                        <input id="txt_emergency_contact_update" type='text' class='form-control txt_faculty '  />
					</div>	
				</div>
				
				<div class="row">
					<div class="col-md-4  form-group">                           
                        <label >PRC License</label>
                        <input id="txt_prc_update" type='text' class='form-control  txt_faculty '  />
					</div>	
					<div class="col-md-8  form-group">                           
                        <label >Address</label>
                        <input id="txt_address_update" type='text' class='form-control  txt_faculty '  />
					</div>						
				</div>
				
				<div class="row">
					<div class="col-md-3  form-group">                           
                        <label >SSS No.</label>
                        <input id="txt_sss_update" type='text' class='form-control  txt_faculty '  />
					</div>	
					<div class="col-md-3  form-group">                           
                        <label >TIN No.</label>
                        <input id="txt_tin_update" type='text' class='form-control  txt_faculty '  />
					</div>	
					<div class="col-md-3  form-group">                           
                        <label >PhilHealth No.</label>
                        <input id="txt_philhealth_update" type='text' class='form-control  txt_faculty '  />
					</div>	
					<div class="col-md-3  form-group">                           
                        <label >Pagibig No.</label>
                        <input id="txt_pagibig_update" type='text' class='form-control  txt_faculty '  />
					</div>	
				</div>
				
			</div>
			<div class="modal-footer">
				<div class="row form-group text-center" >
                    <div class="col-sm-12">
						<div class='pull-right' id='cc_buttons'>
							<button id="btn_update" class='btn btn-success'><i class='fa fa-check fa-fw'></i> Update</button>
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