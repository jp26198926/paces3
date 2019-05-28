<div class="modal " id="student_registration" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
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
								
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" name="LRN_Number" id="lrn_number" class="form-control"  placeholder="LRN Number" >
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<select id="sy" class="form-control">
											<option value="0">-- School Year --</option>
											<?php
												include('connect.php');
												$sql = "SELECT schoolyear_id, CONCAT('SY ',schoolyear_start,'-',schoolyear_end) as school_year FROM schoolyear_tbl ORDER BY schoolyear_start";
												$pop = $mysqli->query($sql);
												
												if ($pop){
													while($row = $pop->fetch_object()){
														$schoolyear_id = $row->schoolyear_id;
														$school_year = $row->school_year;
														
														echo "<option value='{$schoolyear_id}'>{$school_year}</option>";
													}
												}else{
													echo $mysqli->error;
												}
												
												$mysqli->close();
											?>
										</select>
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<select id="gradelevel" class="form-control">
											<option value="0">-- Grade Level --</option>
											<?php
												include('connect.php');
												$sql = "SELECT gradelevel_id, gradelevel_name FROM gradelevel_tbl ORDER BY gradelevel_name";
												$pop = $mysqli->query($sql);
												
												if ($pop){
													while($row = $pop->fetch_object()){
														$gradelevel_id = $row->gradelevel_id;
														$gradelevel_name = $row->gradelevel_name;
														
														echo "<option value='{$gradelevel_id}'>{$gradelevel_name}</option>";
													}
												}else{
													echo $mysqli->error;
												}
												
												$mysqli->close();
											?>
										</select>
									</div>
								</div>
								
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
										<input type="text" name="FirstName" id="FirstName" class="form-control" placeholder="First Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
										<input type="text" name="MiddleName" id="MiddleName" class="form-control" placeholder="Middle Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
										<input type="text" name="LastName" id="LastName" class="form-control " placeholder="Last Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
										<input type="text" name="ExtName" id="ExtName" class="form-control " placeholder="Ext." >
									</div>
								</div>
							</div>					
					
					
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<select  id="gender" class="form-control">
											<option value="0">-- Gender --</option>
											<option value="1">Male</option>	
											<option value="2">Female</option>
										</select>
									</div>
								</div>
								
								<div class="col-md-1 text-right">
									<div class="form-group">
										Birth Day
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="date" name="Birthday" id="Birthday" class="form-control">
									</div>
								</div>
								
								<div class="col-md-5">
									<div class="form-group">
										<input type="text" name="BirthPlace" id="BirthPlace" class="form-control " placeholder="Birth Place" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" name="Address" id="Address" class="form-control " placeholder="Address" >
									</div>
								</div>
							</div>
							
							<hr />
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" name="LastSchoolAttended" id="LastSchoolAttended" class="form-control " placeholder="Last School Attended" >
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<select id="grade_completed" class="form-control">
											<option value="0">-- Grade Completed --</option>
											<?php
												include('connect.php');
												$sql = "SELECT gradelevel_id, gradelevel_name FROM gradelevel_tbl ORDER BY gradelevel_name";
												$pop = $mysqli->query($sql);
												
												if ($pop){
													while($row = $pop->fetch_object()){
														$gradelevel_id = $row->gradelevel_id;
														$gradelevel_name = $row->gradelevel_name;
														
														echo "<option value='{$gradelevel_id}'>{$gradelevel_name}</option>";
													}
												}else{
													echo $mysqli->error;
												}
												
												$mysqli->close();
											?>
										</select>
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" name="GeneralAverage" id="GeneralAverage" class="form-control " placeholder="General Average" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-6 col-md-6">
									<div class="form-group">
										<input type="text" name="GuardiansName" id="GuardiansName" class="form-control" placeholder="Guardian's Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-6 col-md-6">
									<div class="form-group">
										<input type="text" onkeypress="return isNumberKey(event)" name="GuardiansContact" id="GuardiansContact" class="form-control" placeholder="Contact Number" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" name="FathersName" id="FathersName" class="form-control " placeholder="Father's Name" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<input type="text" name="FathersOccupation" id="FathersOccupation" class="form-control" placeholder="Father's Occupation" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<input type="text" onkeypress="return isNumberKey(event)" name="FathersContact" id="FathersContact" class="form-control " placeholder="Father's Contact Number" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<input type="text" name="FathersReligion" id="FathersReligion" class="form-control" placeholder="Father's Religion" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" name="MothersMName" id="MothersMName" class="form-control " placeholder="Mother's Maiden Name" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<input type="text" name="MothersOccupation" id="MothersOccupation" class="form-control" placeholder="Mother's Occupation" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<input type="text" onkeypress="return isNumberKey(event)" name="MothersContact" id="MothersContact" class="form-control " placeholder="Mother's Contact Number" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<input type="text" name="MothersReligion" id="MothersReligion" class="form-control" placeholder="Mother's Religion" >
									</div>
								</div>
							
				</div>				
			</div>

			<div class="modal-footer">
				<div class="row form-group text-center" >
                    <div class="col-sm-12">
						<div class='pull-right' id='cc_buttons'>
							<button id="btn_registration_save" class='btn btn-primary'><i class='fa fa-check fa-fw'></i> Save</button>
							<button class='btn btn-danger' data-dismiss='modal'><i class='fa fa-times fa-fw'></i> Cancel</button>
						</div>
                        								
						<div class="progress" id='registration_progress' style='display:none'>
							<div class="progress-bar progress-bar-striped active" role="progressbar"
							aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
								Saving...Please wait!
							</div>
						</div>
						<div id="registration_error" class="pull-left alert alert-danger" style='display:none;'>
							<i class='fa fa-times-circle '> <span id='type_error_msg'>Error: Critical Error Encountered!</span></i>
						</div>
                    </div>	
                </div>
			</div>
			
        </div>
    </div>
</div>