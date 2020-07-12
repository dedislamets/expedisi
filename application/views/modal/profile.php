<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label> Change Password</label></h4>
	      	</div>
	      	
	      	<form id="Form" name="Form" method="POST" class="form-horizontal" action="<?php echo base_url() ?>index.php/Profile/update">
	        <div class="modal-body">	
				<label class="block clearfix" style="margin-bottom: 11px;">
					<span class="block input-icon input-icon-right">
						<input type="password" id="last_password" name="last_password" class="form-control" placeholder="Last Password" />
						<i class="ace-icon fa fa-user"></i>
					</span>
					<?php echo form_error('last_password'); ?>
				</label>

				<label class="block clearfix" style="margin-bottom: 11px;">
					<span class="block input-icon input-icon-right">
						<input type="password" id="password" name="password" class="form-control" placeholder="New Password" />
						<i class="ace-icon fa fa-lock"></i>
					</span>
					<?php echo form_error('password'); ?>
				</label>


				<label class="block clearfix" style="margin-bottom: 11px;">
					<span class="block input-icon input-icon-right">
						<input type="password" id="ulangi_password" name="ulangi_password" class="form-control" placeholder="New Password" />
						<i class="ace-icon fa fa-lock"></i>
					</span>
					<?php echo form_error('ulangi_password'); ?>
				</label>					
				
				<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
				
			</div>
	        <div class="modal-footer">
	        	<div class="pull-right">
		            <input type="hidden" id="txtRecnum" name="txtRecnum" />
		            <button type="button" id="btnSubmit" class="btn btn-primary btn-block">Submit</button>
		        </div>
	        </div>
	        </form>
	    </div>
	</div>
</div>