<div class="modal " id="tuition_modify" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					Modify Tuition		
				</h4>
				
			</div>   
            <div class="modal-body">
				<input type='hidden' class='tuition_id' value='0' />
				
				<div class="row">
                    <div class="col-md-6  form-group">                           
                        <label >School Year <span class='text-danger'>*</span></label>
                        <div class="form-group">
							<select id="schoolyear_id_update" class="form-control">
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

					<div class="col-md-6  form-group">                           
                        <label >Grade Level <span class='text-danger'>*</span></label>
                        <div class="form-group">
							<select id="gradelevel_id_update" class="form-control">
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
                    <div class="col-md-6  form-group">                           
                        <label >Tuition Fee  <span class='text-danger'>*</span></label>
                        <input id="txt_tuition_fee_update" type='text' class='form-control numeric text-center' value='0.00' />
					</div>	
					<div class="col-md-6  form-group">                           
                        <label >General Fee  <span class='text-danger'>*</span></label>
                        <input id="txt_general_fee_update" type='text' class='form-control numeric text-center' value='0.00' />
					</div>		
				</div>
				<div class="row">
                    <div class="col-md-6  form-group">                           
                        <label >Auxiliary Fee  <span class='text-danger'>*</span></label>
                        <input id="txt_auxiliary_fee_update" type='text' class='form-control numeric text-center' value='0.00' />
					</div>	
					<div class="col-md-6  form-group">                           
                        <label >Other Fee  <span class='text-danger'>*</span></label>
                        <input id="txt_other_fee_update" type='text' class='form-control numeric text-center' value='0.00'  />
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
                        								
						<div class="progress" id='gradelevel_progress' style='display:none'>
							<div class="progress-bar progress-bar-striped active" role="progressbar"
							aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
								Saving...Please wait!
							</div>
						</div>
						<div id="schoolyear_error" class="pull-left alert alert-danger" style='display:none;'>
							<i class='fa fa-times-circle '> <span id='schoolyear_error_msg'>Error: Critical Error Encountered!</span></i>
						</div>
                    </div>	
                </div>
			</div>
			
        </div>
    </div>
</div>