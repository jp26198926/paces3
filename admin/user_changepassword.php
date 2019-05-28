<div class="modal " id="user_changepassword" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					Change Password		
				</h4>
				
			</div>   
            <div class="modal-body">
				<input type="hidden" class="user_id" value="0" />
				
				<div class="row">                 
                    <div class="col-md-6  form-group">                           
                        <label>Password<span class='text-danger'>*</span></label>
                        <input id="txt_password_update" type='password' class='form-control txt_user '  />
					</div>	
					<div class="col-md-6  form-group">                           
                        <label>Re-Password<span class='text-danger'>*</span></label>
                        <input id="txt_repassword_update" type='password' class='form-control txt_user '  />
					</div>
				</div>				
							
			</div>
			<div class="modal-footer">
				<div class="row form-group text-center" >
                    <div class="col-sm-12">
						<div class='pull-right' id='cc_buttons'>
							<button id="btn_update_password" class='btn btn-success'><i class='fa fa-check fa-fw'></i> Update</button>
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