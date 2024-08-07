<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document" style="margin: 10% auto;max-width: 900px;">
	    <div class="modal-content" id="app">
	      	<div class="modal-header" style="background-color: #404E67;color:#fff">
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label> Project</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							
							<div class="form-group">
								<label>Prefix<span style="color:red"> *</span></label>
								<input type="text" id="prefix" name="prefix" class="form-control" maxlength="200" />
							</div>

							<div class="form-group">
								<label>Nama Project<span style="color:red"> *</span></label>
								<input type="text" id="nama_project" name="nama_project" class="form-control" />
							</div>	
							<div class="form-group">
								<label>Aktif</label><br>
								<input type="checkbox" id="status" name="status" class="js-single" checked />
							</div>
						</div>
						
					</div>
					<input type="hidden" name="id" id="id" value="">
					<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
				</div>
				<div class="modal-footer d-flex flex-column">
		        	<div class="d-flex justify-content-end align-items-end align-self-end">
			            <button type="button" id="btnSubmit" class="btn btn-primary btn-block">Submit</button>
			        </div>
			        
		        </div>
			</form>
		</div>
	</div>
</div>