<div class="modal " id="enrolled_offence" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					New Offence		
				</h4>
				<input type="hidden" class="student_id" value="0" />
			</div>   
            <div class="modal-body">
				<div class="row">
                    <div class="col-md-6">
						<label>Incident Date</label>
                        <input type="date" class="form-control" id="incident_date" >
                    </div>
					<div class="col-md-6">
						<label for="incident_type">Incident Type</label>
						<select class="form-control" name="incident_type" id="incident_type" >
							<option value = "Attendance">Attendance</option>									
							<option value = "Conduct">Conduct</option>
							<option value = "Theft/Damage of Property">Theft/Damage of Property</option>
							<option value = "Minor Offences">Minor Offences</option>
							<option value = "Serious Offences">Serious Offences</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" style="margin-top:0.5em;">
						<label for="description">Description</label>
						<select class="form-control" name="description" id="description" value="<?php echo !empty($dbData['description'])?$dbData['description']:''; ?>">
							<option value = "truancy">Truancy </option>
							<option value = "leaving_school grounds without permission">Leaving school grounds without permission</option>
							<option value = "extortion" >Extortion</option>
							<option value = "forgery" >Forgery</option>
							<option value = "bullying" >Bullying</option>
							<option value = "disruptive_behaviour" >Disruptive behaviour</option>
							<option value = "abuse_technology" >Abuse of technology</option>
							<option value = "defiance_rudeness" >Open Defiance and/or rudeness</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" style="margin-top:0.5em;">
						<label>Comments</label>
						<textarea id="comments" class="form-control"></textarea>
                    </div>
				</div>
							
			</div>
			<div class="modal-footer">
				<div class="row form-group text-center" >
                    <div class="col-sm-12">
						<div class='pull-right' id='cc_buttons'>
							<button id="btn_offence_save" class='btn btn-success'><i class='fa fa-check fa-fw'></i> Save</button>
							<button class='btn btn-warning' data-dismiss='modal'><i class='fa fa-times fa-fw'></i> Cancel</button>
						</div>
                        								
						<div class="progress" id='offence_progress' style='display:none'>
							<div class="progress-bar progress-bar-striped active" role="progressbar"
							aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
								Saving...Please wait!
							</div>
						</div>
						<div id="offence_error" class="pull-left alert alert-danger">
							<i class='fa fa-warning '> <span id='offence_error_msg'>View Offences: goto Offences menu -> Search </span></i>
						</div>
						
						
                    </div>	
                </div>
			</div>
			
        </div>
    </div>
</div>