<div class="modal fade" id="grade_upload_modal" data-keyboard="false" data-backdrop="static" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
				<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
				<h4 class="blue bigger"><i class='fa fa-calendar fa-fw'> </i>Upload Grade</h4>				
			</div>
			
            <div class="modal-body">
            	<div class="row">
            		<div class="col-xs-12">
            			<p class="alert-warning">Note: Make it sure the record in your file is accurate!</p>
            		</div>
            	</div>
            	<div class="row">					
					<div class="col-xs-4">
						<label>Year Level</label>
						<select id="upload_schoolyear_id" class="form-control" disabled>
							<?php
								include('connect.php');
								$sql = "SELECT schoolyear_id, CONCAT(schoolyear_start, '-', schoolyear_end) as schoolyear, status_id
										FROM schoolyear_tbl ORDER BY schoolyear_start DESC;";
								$pop = $mysqli->query($sql);
												
								if ($pop){
									while($row = $pop->fetch_object()){
										$id = $row->schoolyear_id;
										$val = $row->schoolyear;
										$status_id = $row->status_id;

										if (intval($status_id) == 2){ //2 - current year
											echo "<option value='{$id}' selected='selected'>{$val}</option>";
										}else{
											echo "<option value='{$id}'>{$val}</option>";
										}
									}
								}else{
									echo $mysqli->error;
								}
												
								$mysqli->close();
							?>
						</select>	
					</div>
					<div class="col-xs-4">
						<label>Grade Level</label>
						<select id="upload_gradelevel_id" class="form-control" >
							<option value="0">-- Select --</option>
							<?php
								include('connect.php');
								$sql = "SELECT gradelevel_id, gradelevel_name
										FROM gradelevel_tbl 
										WHERE status_id=1
										ORDER BY gradelevel_name;";

								$pop = $mysqli->query($sql);
												
								if ($pop){
									while($row = $pop->fetch_object()){
										$id = $row->gradelevel_id;
										$val = $row->gradelevel_name;
										
										echo "<option value='{$id}'>{$val}</option>";										
									}
								}else{
									echo $mysqli->error;
								}
												
								$mysqli->close();
							?>
						</select>	
					</div>
					<div class="col-xs-4">
						<label>Section</label>
						<select id="upload_section_id" class="form-control" >
							<option value="0">-- Select --</option>
						</select>	
					</div>
				</div>
				<br />
				<div class="row">
					<div class="col-xs-12" id="col_upload_subject_id" style="display:none;">
						<label>Subject</label> 
						<select id="upload_subject_id" class="form-control" >
							<option value="0">-- Select --</option>
							<?php
								include('connect.php');
								$sql = "SELECT subject_id, subject_name FROM subject_tbl WHERE status_id=1 ORDER BY subject_name;";
								$pop = $mysqli->query($sql);
												
								if ($pop){
									while($row = $pop->fetch_object()){
										$id = $row->subject_id;
										$val = $row->subject_name;														
										echo "<option value='{$id}'>{$val}</option>";
									}
								}else{
									echo $mysqli->error;
								}
												
								$mysqli->close();
							?>
						</select>	
					</div>
					<div class="col-xs-12" id="col_upload_quarter_id" style="display:none;">
						<label>Quarter</label> 
						<select id="upload_quarter_id" class="form-control">
							<option value="0">-- Select --</option>
							<?php
								include('connect.php');
								$sql = "SELECT quarter_id, quarter_name FROM quarter_tbl WHERE status_id=1;";
								$pop = $mysqli->query($sql);
												
								if ($pop){
									while($row = $pop->fetch_object()){
										$id = $row->quarter_id;
										$val = $row->quarter_name;														
										echo "<option value='{$id}'>{$val}</option>";
									}
								}else{
									echo $mysqli->error;
								}
												
								$mysqli->close();
							?>
						</select>	
					</div>
				</div>
				<br />
				<div class="row">					
					<div class="form-group">
						<div class="col-xs-12">
							<form method="post" id="frm_grade_upload" name="frm_grade_upload" >	
								<input type="file" name="file_grade_upload" id="file_grade_upload" />
							</form>
						</div>
					</div>	
				</div>	
            </div>	
			
			<div class="modal-footer">
				<div class="pull-right modal_button">
					<button type="button" id="btn_grade_upload_save" class="btn btn-success" style="display: none;"><span class='fa fa-forward'></span> Process Data </button>
					<button type="button" id="btn_grade_upload_save" class="btn btn-primary" ><span class='fa fa-upload'></span> Upload </button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" ><span class='fa fa-times'> Close</button>
				</div>
				
				<div  class="pull-left modal_error" style="display:none; max-height: 200px; overflow-y: scroll;">
					<div class="alert alert-danger text-left">
						<strong>
							<i class="ace-icon fa fa-times-circle"></i>							
						</strong>
						<span class="modal_error_msg" >
							Error: Critical Error Encountered!
						</span>
						
						<br />
					</div>
				</div>
			
				<div  class="pull-left modal_success" style="display:none;">
					<div class="alert alert-success"
						<strong>
							<i class="ace-icon fa fa-times"></i>							
						</strong>
						<span class="modal_success_msg">
							Success
						</span>
						
						<br />
					</div>
				</div>
				
				<div class="modal_waiting" style='display:none'>
					<div class="progress">
						<div class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
							Request is being processed... Please wait!
						</div>
					</div>
				</div>
				  
			</div>
			
        </div>
    </div>
</div>