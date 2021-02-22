<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document" style="margin: 10% auto;">
	    <div class="modal-content">
	      	<div class="modal-header" style="background-color: #404E67;color:#fff">
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label> Sub Moda</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							
							<div class="form-group">
								<label>Kategori<span style="color:red"> *</span></label>
								<input type="text" id="kategori" name="kategori" class="form-control" maxlength="200" />
							</div>
	
							<div class="form-group">
								<label>Moda<span style="color:red"> *</span></label>
								<select name="moda" id="moda" class="form-control">
			                      <?php 
			                      foreach($moda as $row)
			                      { 
			                      	echo '<option value="'.$row->id.'">'.$row->moda_name.'</option>';
			                      }
			                      ?>
			                    </select>
							</div>	
						</div>
						
					</div>
					<input type="hidden" name="id" id="id" value="">
					<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
				</div>
				<div class="modal-footer">
		        	<div class="pull-right">
			            <button type="button" id="btnSubmit" class="btn btn-primary btn-block">Submit</button>
			        </div>
		        </div>
			</form>
		</div>
	</div>
</div>