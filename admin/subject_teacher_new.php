<div class="modal " id="subject_teacher_new" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog modal-sm" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					Add Subject
				</h4>
				
			</div>   
            <div class="modal-body">
				
				<div class="row">
                    <div class="col-md-12  form-group">                           
                        <label >Grade Level<span class='text-danger'>*</span></label>
                        <select id="txt_gradelevel" class="form-control" >
							<option value="0"> -- Select -- </option>
							<?php
								include('connect.php');
								
								$sql = "SELECT gradelevel_id, gradelevel_name
										FROM gradelevel_tbl;";
								
								$pop = $mysqli->query($sql);
								while ($row = $pop->fetch_object()){
									$gradelevel_id = $row->gradelevel_id;
									$gradelevel_name = $row->gradelevel_name;
									
									echo "<option value='{$gradelevel_id}'>{$gradelevel_name}</option>";
								}
								
								$mysqli->close();
							?>
						</select>
					</div>					
				</div>
				
				<div class="row">
                    <div class="col-md-12  form-group">                           
                        <label >Section<span class='text-danger'>*</span></label>
                        <select id="txt_section" class="form-control" >
							<option value="0"> -- Select -- </option>
							
						</select>
					</div>					
				</div>
				
				<div class="row">
                    <div class="col-md-12  form-group">                           
                        <label >Subject<span class='text-danger'>*</span></label>
                        <select id="txt_subject" class="form-control" >
							<option value="0"> -- Select -- </option>
							<?php
								include('connect.php');
								
								$sql = "SELECT subject_id, subject_name
										FROM subject_tbl
										ORDER BY subject_name;";
								
								$pop = $mysqli->query($sql);
								while ($row = $pop->fetch_object()){
									$id = $row->subject_id;
									$val = $row->subject_name;
									
									echo "<option value='{$id}'>{$val}</option>";
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