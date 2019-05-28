<div class="modal " id="user_modify" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					Modify User		
				</h4>
				
			</div>   
            <div class="modal-body">
				<input type="hidden" class="user_id" value="0" />
				
				<div class="row">
                    <div class="col-md-6  form-group">                           
                        <label>Username<span class='text-danger'>*</span></label>
                        <input id="txt_username_update" type='text' class='form-control txt_user '  />
					</div>	
					<div class="col-md-6  form-group">                           
                        <label>Access Level<span class='text-danger'>*</span></label>
                        <select id="txt_access_update" class="form-control txt_user">
							<option value=''> -- Select -- </option>
							<?php
								include('connect.php');
								
								$sql = "SELECT * FROM access_tbl ORDER BY access_name;";;
								$pop = $mysqli->query($sql);
								if ($pop){
									while($row = $pop->fetch_object()){
										$access_id = $row->access_id;
										$access_name = $row->access_name;
										
										echo "<option value='{$access_id}'>{$access_name}</option>";
									}
								}
								
								$mysqli->close();
							?>
						</select>
					</div>					
				</div>				
				
				
				<div class="row">
                    <div class="col-md-6  form-group">                           
                        <label>Fullname<span class='text-danger'>*</span></label>
                        <select id="txt_fullname_update" class="form-control txt_user">
							<option value=''> -- Select -- </option>
							<?php
								include('connect.php');
								
								$sql = "SELECT faculty_id, UPPER(CONCAT(lastname,', ',firstname,' ',middlename)) as fullname 
										FROM faculty_tbl ORDER BY lastname,firstname,middlename;";
								$pop = $mysqli->query($sql);
								if ($pop){
									while($row = $pop->fetch_object()){
										$faculty_id = $row->faculty_id;
										$fullname = $row->fullname;
										
										echo "<option value='{$faculty_id}'>{$fullname}</option>";
									}
								}
								
								$mysqli->close();
							?>
						</select>
					</div>
					<div class="col-md-6  form-group">                           
                        <label>Designation</label>
                        <input  type='text' class='form-control txt_designation txt_user ' readonly />
					</div>
				</div>
							
			</div>
			<div class="modal-footer">
				<div class="row form-group text-center" >
                    <div class="col-sm-12">
						<div class='pull-right' id='cc_buttons'>
							<button id="btn_update" class='btn btn-success'><i class='fa fa-check fa-fw'></i> Save</button>
							<button class='btn btn-warning' data-dismiss='modal'><i class='fa fa-times fa-fw'></i> Cancel</button>
						</div>
                        								
						<div class="progress" id='user_progress' style='display:none'>
							<div class="progress-bar progress-bar-striped active" role="progressbar"
							aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
								Saving...Please wait!
							</div>
						</div>
						<div id="user_error" class="pull-left alert alert-danger" style='display:none;'>
							<i class='fa fa-times-circle '> <span id='user_error_msg'>Error: Critical Error Encountered!</span></i>
						</div>
                    </div>	
                </div>
			</div>
			
        </div>
    </div>
</div>