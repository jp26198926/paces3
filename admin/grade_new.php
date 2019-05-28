<div class="modal " id="grade_new" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog modal-sm" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					Input Grade
				</h4>
				
				<input type='hidden' class='quarter_no' value='0' />
				<input type='hidden' class='student_id' value='0' />
				
			</div>   
            <div class="modal-body">
				<div class="row">
                    <div class="col-md-12  form-group">                           
                        <label id="lbl_field" >Grade<span class='text-danger'>*</span></label>
                        <input id="txt_grade" type='text' class='form-control numeric txt_grade text-center '  />
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
                        								
						<div class="progress" id='grade_progress' style='display:none'>
							<div class="progress-bar progress-bar-striped active" role="progressbar"
							aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
								Saving...Please wait!
							</div>
						</div>
						<div id="grade_error" class="pull-left alert alert-danger" style='display:none;'>
							<i class='fa fa-times-circle '> <span id='grade_error_msg'>Error: Critical Error Encountered!</span></i>
						</div>
                    </div>	
                </div>
			</div>
			
        </div>
    </div>
</div>