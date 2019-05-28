<div class="modal " id="payment_new" data-keyboard="false" data-backdrop="static" style='z-index: 10028;'>
    <div class="modal-dialog" id="modal-danger">
        <div class="modal-content">
            <div class="modal-header">				
				<h4 class="modal-title" style='font-weight: bold;'>
					<span class='fa fa-edit'> </span>
					New Entry				
				</h4>
				
			</div>   
            <div class="modal-body">
				<div class="row">
                    <div class="col-md-6  form-group">                           
                        <label >OR Number<span class='text-danger'>*</span></label>
                        <input id="txt_or_no" type='text' class='form-control numeric txt_payment '  />
					</div>
					<div class="col-md-6  form-group" >                           
                        <label >OR Date<span class='text-danger'>*</span></label>
                        <input id="txt_or_date" type='date' class='form-control text-center txt_payment' value="<?= date('Y-m-d'); ?>"  />
					</div>
				</div>
				
				<div class="row">
                    <div class="col-md-6  form-group">                           
                        <label >Current Balance</label>
                        <input id="txt_balance" type='text' class='form-control text-right txt_payment' readonly />
					</div>
					<div class="col-md-6  form-group" >                           
                        <label >Amount Paid<span class='text-danger'>*</span></label>
                        <input id="txt_amount" type='text' class='form-control numeric text-right txt_payment'  placeholder='0.00' />
					</div>
				</div>
				
				<div class="row">
                    <div class="col-md-12  form-group">                           
                        <label >Remarks</label>
                        <textarea id="txt_remarks" class="form-control txt_payment"></textarea>
					</div>					
				</div>
							
			</div>
			<div class="modal-footer">
				<div class="row form-group text-center" >
                    <div class="col-sm-12">
						<div class='pull-right' id='cc_buttons'>
							<button id="btn_save" class='btn btn-primary'><i class='fa fa-check fa-fw'></i> Save</button>
							<button class='btn btn-danger' data-dismiss='modal'><i class='fa fa-times fa-fw'></i> Cancel</button>
						</div>
                        								
						<div class="progress" id='payment_progress' style='display:none'>
							<div class="progress-bar progress-bar-striped active" role="progressbar"
							aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
								Saving...Please wait!
							</div>
						</div>
						<div id="payment_error" class="pull-left alert alert-danger" style='display:none;'>
							<i class='fa fa-times-circle '> <span id='payment_error_msg'>Error: Critical Error Encountered!</span></i>
						</div>
                    </div>	
                </div>
			</div>
			
        </div>
    </div>
</div>