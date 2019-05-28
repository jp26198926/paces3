<div class="modal " id="student_type" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog modal-sm" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					New Entry						
				</h4>
				
			</div>   
            <div class="modal-body">
            	<div class="row">
            		<div class="col-md-12  form-group">                           
                        <label >Student Type</label>
						<select id="txt_student_type" class="form-control">
							<option value="1">New Student</option>
							<option value="2">Old Student</option>
						</select>
					</div>	
            	</div>
				<div id="div_lrn" class="row" style="display:none;">					
                    <div class="col-md-12  form-group">                           
                        <label >Enter LRN Number</label>
						<input type='text' id="txt_lrn_no" class="form-control"  />
					</div>
				</div>				
			</div>

			<div class="modal-footer">
				<div class="row form-group text-center" >
                    <div class="col-sm-12">
						<div class='pull-right' id='cc_buttons'>
							<button id="btn_type_proceed" class='btn btn-primary'><i class='fa fa-forward fa-fw'></i> Proceed</button>
							<button class='btn btn-danger' data-dismiss='modal'><i class='fa fa-times fa-fw'></i> Cancel</button>
						</div>
                        								
						<div class="progress" id='type_progress' style='display:none'>
							<div class="progress-bar progress-bar-striped active" role="progressbar"
							aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
								Saving...Please wait!
							</div>
						</div>
						<div id="type_error" class="pull-left alert alert-danger" style='display:none;'>
							<i class='fa fa-times-circle '> <span id='type_error_msg'>Error: Critical Error Encountered!</span></i>
						</div>
                    </div>	
                </div>
			</div>
			
        </div>
    </div>
</div>