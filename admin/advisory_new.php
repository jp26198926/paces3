<div class="modal " id="advisory_new" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog modal-sm" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					Set Adviser	
				</h4>
				
			</div>   
            <div class="modal-body">
				<input type="hidden" class="section_id" value="0" />
				
				<div class="row">
                    <div class="col-md-12  form-group">                           
                        <label >Adviser<span class='text-danger'>*</span></label>
                        <select id="txt_adviser" class="form-control" >
							<option value="0"> No Adviser </option>
							<?php
								include('connect.php');
								
								$sql = "SELECT faculty_id,  CONCAT(lastname, ', ', firstname, ' ', middlename) as adviser
										FROM faculty_tbl ORDER BY lastname, firstname, middlename;";
								
								$pop = $mysqli->query($sql);
								while ($row = $pop->fetch_object()){
									$faculty_id = $row->faculty_id;
									$adviser = ucwords($row->adviser);
									
									echo "<option value='{$faculty_id}'>{$adviser}</option>";
								}
								
								$mysqli->close();
							?>
						</select>
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
                        								
						<div class="progress" id='advisory_progress' style='display:none'>
							<div class="progress-bar progress-bar-striped active" role="progressbar"
							aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
								Saving...Please wait!
							</div>
						</div>
						<div id="advisory_error" class="pull-left alert alert-danger" style='display:none;'>
							<i class='fa fa-times-circle '> <span id='advisory_error_msg'>Error: Critical Error Encountered!</span></i>
						</div>
                    </div>	
                </div>
			</div>
			
        </div>
    </div>
</div>