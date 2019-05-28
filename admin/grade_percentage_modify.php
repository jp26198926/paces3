<div class="modal " id="grade_percentage_modify" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog modal-sm" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					Modify Grade Percentage	
				</h4>
				
			</div>   
            <div class="modal-body">
				<input type='hidden' class='grade_percentage_id' value='0' />
				<div class="row">
                    <div class="col-md-12  form-group">                           
                        <label >Subject<span class='text-danger'>*</span></label>
                        <select id="txt_grade_percentage_subject_update" class='form-control'>
                        	<?php
                        		include('connect.php');
                        		$sql = "SELECT subject_id, subject_name FROM subject_tbl ORDER BY subject_name;";

                        		$pop = $mysqli->query($sql);
                        		if ($pop){
                        			while($row = $pop->fetch_object()){
                        				$id = $row->subject_id;
                        				$val = $row->subject_name;

                        				echo "<option value='{$id}'>{$val}</option>";
                        			}
                        		}
                        		$mysqli->close();
                        	?>
                        </select>
					</div>					
				</div>
				<div class="row">
                    <div class="col-md-12  form-group">                           
                        <label >Category<span class='text-danger'>*</span></label>
                        <select id="txt_grade_percentage_category_update" class='form-control'>
                        	<?php
                        		include('connect.php');
                        		$sql = "SELECT gradecategory_id, gradecategory_name FROM grade_category_tbl ORDER BY gradecategory_name;";

                        		$pop = $mysqli->query($sql);
                        		if ($pop){
                        			while($row = $pop->fetch_object()){
                        				$id = $row->gradecategory_id;
                        				$val = $row->gradecategory_name;

                        				echo "<option value='{$id}'>{$val}</option>";
                        			}
                        		}
                        		$mysqli->close();
                        	?>
                        </select>
					</div>					
				</div>
				<div class="row">
                    <div class="col-md-12  form-group">                           
                        <label >Percentage (%)<span class='text-danger'>*</span></label>
                        <input id="txt_grade_percentage_val_update" type='text' class='form-control numeric txt_grade_percentage '  />
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
                        								
						<div class="progress" id='grade_percentage_progress' style='display:none'>
							<div class="progress-bar progress-bar-striped active" role="progressbar"
							aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
								Saving...Please wait!
							</div>
						</div>
						<div id="grade_percentage_error" class="pull-left alert alert-danger" style='display:none;'>
							<i class='fa fa-times-circle '> <span id='grade_percentage_error_msg'>Error: Critical Error Encountered!</span></i>
						</div>
                    </div>	
                </div>
			</div>
			
        </div>
    </div>
</div>