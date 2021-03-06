<div class="modal " id="tuition_new" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					New Tuition	
				</h4>
				
			</div>   
            <div class="modal-body">
				<div class="row">
                    <div class="col-md-6  form-group">                           
                        <label >School Year <span class='text-danger'>*</span></label>
                        <div class="form-group">
							<select id="schoolyear_id" class="form-control">
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
							<select id="gradelevel_id" class="form-control">
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
				
				
				
			</div>
			<div class="modal-footer">
				<div class="row form-group text-center" >
                    <div class="col-sm-12">
						<div class='pull-right' id='cc_buttons'>
							<button id="btn_save" class='btn btn-success'><i class='fa fa-check fa-fw'></i> Save</button>
							<button class='btn btn-warning' data-dismiss='modal'><i class='fa fa-times fa-fw'></i> Cancel</button>
						</div>
                        								
						<div class="progress" id='gradelevel_progress' style='display:none'>
							<div class="progress-bar progress-bar-striped active" role="progressbar"
							aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
								Saving...Please wait!
							</div>
						</div>
						<div id="gradelevel_error" class="pull-left alert alert-danger" style='display:none;'>
							<i class='fa fa-times-circle '> <span id='gradelevel_error_msg'>Error: Critical Error Encountered!</span></i>
						</div>
                    </div>	
                </div>
			</div>
			
        </div>
    </div>
</div>