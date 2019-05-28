<div class="modal " id="enrolled_info" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog modal-lg" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					Student Information			
				</h4>
				
			</div>   
            <div class="modal-body">
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group">
										<label>LRN Number</label>
										<input type="text" name="LRN_Number" id="lrn_no_info" class="form-control enrolled_field" onkeypress="return isNumberKey(event)" placeholder="LRN Number" >
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>School Year</label>
										<select id="sy_info" class="form-control enrolled_field">
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
										<label>Grade Level</label>
										<select id="gradelevel_info" class="form-control enrolled_field">
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
										<label>Firstname</label>
										<input type="text" name="FirstName" id="firstname_info" class="form-control enrolled_field" placeholder="First Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
										<label>Middlename</label>
										<input type="text" name="MiddleName" id="middlename_info" class="form-control enrolled_field" placeholder="Middle Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
										<label>Lastname</label>
										<input type="text" name="LastName" id="lastname_info" class="form-control enrolled_field" placeholder="Last Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
										<label>Extension</lable>
										<input type="text" name="ExtName" id="extname_info" class="form-control enrolled_field" placeholder="Ext." >
									</div>
								</div>
							</div>					
					
					
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Gender</label>
										<select  id="gender_info" class="form-control enrolled_field">
											<option value="0">-- Gender --</option>
											<option value="1">Male</option>	
											<option value="2">Female</option>
										</select>
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>Birthday</label>
										<input type="date" name="Birthday" id="birthday_info" class="form-control enrolled_field" >
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label>Birth Place</label>
										<input type="text" name="BirthPlace" id="birthplace_info" class="form-control enrolled_field" placeholder="Birth Place" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Address</label>
										<input type="text" name="Address" id="address_info" class="form-control enrolled_field" placeholder="Address" >
									</div>
								</div>
							</div>
							
							<hr />
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>last School Attended</label>
										<input type="text" name="LastSchoolAttended" id="lastschoolattended_info" class="form-control enrolled_field" placeholder="Last School Attended" >
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>Grade Completed</label>
										<select id="grade_completed_info" class="form-control enrolled_field">
											<option value="0">-- Grade Completed --</option>
											<?php
												include('admin/connect.php');
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
										<label>General Average</label>
										<input type="text" name="GeneralAverage" id="generalaverage_info" class="form-control enrolled_field" placeholder="General Average" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-6 col-md-6">
									<div class="form-group">
										<label>Guardian's Name</label>
										<input type="text" name="GuardiansName" id="guardiansname_info" class="form-control enrolled_field" placeholder="Guardian's Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-6 col-md-6">
									<div class="form-group">
										<label>Guardian's Contact</label>
										<input type="text" onkeypress="return isNumberKey(event)" name="GuardiansContact" id="guardianscontact_info" class="form-control enrolled_field" placeholder="Contact Number" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Father's Name</label>
										<input type="text" name="FathersName" id="fathersname_info" class="form-control enrolled_field" placeholder="Father's Name" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label>Father's Occupation</label>
										<input type="text" name="FathersOccupation" id="fathersoccupation_info" class="form-control enrolled_field" placeholder="Father's Occupation" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label>Father's Contact</label>
										<input type="text" onkeypress="return isNumberKey(event)" name="FathersContact" id="fatherscontact_info" class="form-control enrolled_field" placeholder="Father's Contact Number" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label>Father's Religion</label>
										<input type="text" name="FathersReligion" id="fathersreligion_info" class="form-control enrolled_field" placeholder="Father's Religion" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Mother's Name</label>
										<input type="text" name="MothersMName" id="mothersname_info" class="form-control enrolled_field" placeholder="Mother's Maiden Name" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label>Mother's Occupation</label>
										<input type="text" name="MothersOccupation" id="mothersnameoccupation_info" class="form-control enrolled_field" placeholder="Mother's Occupation" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label>Mother's Contact</label>
										<input type="text" onkeypress="return isNumberKey(event)" name="MothersContact" id="motherscontact_info" class="form-control enrolled_field" placeholder="Mother's Contact Number" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label>Mother's Religion</label>
										<input type="text" name="MothersReligion" id="mothersreligion_info" class="form-control enrolled_field" placeholder="Mother's Religion" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label>Username</label>
										<input type="text" name="MothersReligion" id="username_info" class="form-control enrolled_field" placeholder="Username" >
									</div>
								</div>
							</div> 
							
							<div class="row ">
								<div class="col-md-4" ></div>
								<div class="col-md-4 text-center" >									
									<button type="btn" class="btn btn-warning" data-dismiss="modal">Close</button>
								</div>
								<div class="col-md-4 " ></div>
							</div>
			</div>
			
			<div class="modal-footer">
			
			</div>
			
        </div>
    </div>
</div>