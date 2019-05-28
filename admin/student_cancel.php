<div class="modal " id="student_cancel" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-question-circle'> </span>
					Cancel Registration
					<input type="hidden" class="hidden_student_id" value=0 />					
				</h4>
				
			</div>   
            <div class="modal-body">
            	<div class="row">
            		<div class="col-md-12">
            			<p><i class="fa fa-question-circle fa-fw fa-2x text-danger"></i>Are you sure you want to cancel this record?</p>
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-md-12  form-group">                           
                        <label >Provide reason of cancellation</label>
						<textarea id="txt_registration_cancel" rows="5" class="form-control"></textarea>
					</div>	
            	</div>
							
			</div>

			<div class="modal-footer">
				<div class="row form-group text-center" >
                    <div class="col-sm-12">
						<div class='pull-right' id='cc_buttons'>
							<button id="btn_registration_cancel_save" class='btn btn-primary'><i class='fa fa-forward fa-fw'></i> Proceed</button>
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