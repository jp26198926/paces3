<div class="modal " id="register" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog modal-lg" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					Student Registration				
				</h4>
				
			</div>   
            <div class="modal-body">
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group">
									<label for="lrn_number">LRN Number</label>
										<input type="text" name="LRN_Number" id="lrn_number" class="form-control" onkeypress="return isNumberKey(event)" placeholder="LRN Number" >
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<select id="sy" class="form-control">
											<option value="0">-- School Year --</option>
											<?php
												include('admin/connect.php');
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
								
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
									<label for="FirstName">First Name</label>
										<input type="text" name="FirstName" id="FirstName" class="form-control" placeholder="First Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
									<label for="MiddleName">Middle Name</label>
										<input type="text" name="MiddleName" id="MiddleName" class="form-control" placeholder="Middle Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
									<label for="LastName">Last Name</label>
										<input type="text" name="LastName" id="LastName" class="form-control " placeholder="Last Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-3 col-md-3">
									<div class="form-group">
									<label for="ExtName">Extention Name: eg. JR., SR. etc.</label>
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
									<label for="BirthPlace"> Birth Place</label>
										<input type="text" name="BirthPlace" id="BirthPlace" class="form-control " placeholder="Birth Place" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label for="Address"> Home Address </label>
										<input type="text" name="Address" id="Address" class="form-control " placeholder="Address" >
									</div>
								</div>
							</div>
							
							<hr />
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
												<label for="LastSchoolAttended"> Last School Attended </label>
												<input type="text" name="LastSchoolAttended" id="LastSchoolAttended" class="form-control " placeholder="Last School Attended" >
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<select id="grade_completed" class="form-control">
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
								<label for="GeneralAverage"> General Average </label>
										<input type="text" name="GeneralAverage" id="GeneralAverage" class="form-control " placeholder="General Average" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-6 col-md-6">
									<div class="form-group">
									<label for="GuardiansName"> Guardian's Name</label>
										<input type="text" name="GuardiansName" id="GuardiansName" class="form-control" placeholder="Guardian's Name" >
									</div>
								</div>
								<div class="col-md-12 col-md-6 col-md-6">
									<div class="form-group">
									<label for="GuardiansContact"> Guardians Contact Number</label>
										<input type="text" onkeypress="return isNumberKey(event)" name="GuardiansContact" id="GuardiansContact" class="form-control" placeholder="Contact Number" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label for="FathersName"> Fathers Name</label>
										<input type="text" name="FathersName" id="FathersName" class="form-control " placeholder="Father's Name" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
									<label for="FathersOccupation"> Fathers Occupation</label>
										<input type="text" name="FathersOccupation" id="FathersOccupation" class="form-control" placeholder="Father's Occupation" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label for="FathersContact"> Fathers Contact Number</label>
										<input type="text" onkeypress="return isNumberKey(event)" name="FathersContact" id="FathersContact" class="form-control " placeholder="Father's Contact Number" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label for="FathersReligion">Fathers Religion</label>
										<input type="text" name="FathersReligion" id="FathersReligion" class="form-control" placeholder="Father's Religion" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
											<label for="MothersMName">Mother's Maiden Name </label>
										<input type="text" name="MothersMName" id="MothersMName" class="form-control " placeholder="Mother's Maiden Name" >
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
									<label for="MothersOccupation">Mothers Occupation </label>
										<input type="text" name="MothersOccupation" id="MothersOccupation" class="form-control" placeholder="Mother's Occupation" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label for="MothersContact">Mothers Contact Number </label>
										<input type="text" onkeypress="return isNumberKey(event)" name="MothersContact" id="MothersContact" class="form-control " placeholder="Mother's Contact Number" >
									</div>
								</div>
								<div class="col-md-12 col-md-4 col-md-4">
									<div class="form-group">
										<label for="MothersReligion">Mothers Religion </label>
										<input type="text" name="MothersReligion" id="MothersReligion" class="form-control" placeholder="Mother's Religion" >
									</div>
								</div>
							</div> 
							
							<div class="row ">
								<div class="col-md-8" >
									<?php 
								        require_once 'library/securimage/securimage.php'; 
								        echo Securimage::getCaptchaHtml(); 
								    ?>
								</div>
								<div class="col-md-4 text-right" >
									<button id="btnSave" type="btn" class="btn btn-success ">Register</button>
									<button type="btn" class="btn btn-warning" data-dismiss="modal">Cancel</button>
								</div>
								
							</div>
			</div>
			
			<div class="modal-footer">
			
			</div>
			
        </div>
    </div>
</div>