<div class="modal" id="ModalCust">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header" style="background-color: #404E67;color:#fff">
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label>Input Master Customer</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name ="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
			
					<div class="form-group">
						<label>Nama Instansi<span style="color:red"> *</span></label>
						<input type="text" id="cust_name" name="cust_name" class="form-control" maxlength="200" />
					</div>	
					<div class="form-group">
						<label>Alamat<span style="color:red"> *</span></label>
						<textarea name="cust_address" id="cust_address" rows="4" class="form-control required" placeholder="" style="height: 100px;"> </textarea>
					</div>
					<div class="form-group">
						<label>Kota/Region</label>
						<input type="text" id="region" name="region" class="form-control" />
					</div>
					<div class="form-group">
						<label>Attention</label>
						<input type="text" id="attn" name="attn" class="form-control" maxlength="200" />
					</div>
					
					<div class="form-group">
						<label>Phone 1</label>
						<input type="text" id="phone1" name="phone1" class="form-control" />
					</div>	
					<div class="form-group">
						<label>Phone 2</label>
						<input type="text" id="phone1" name="phone2" class="form-control" />
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

<div id="modalCust2" class="modal" >
	<div class="modal-dialog" role="document" style="margin: 10% auto;max-width: 900px;">
	  	<div class="modal-content">
		    <div class="modal-header" style="background-color: #404E67;color:#fff">
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label>Cari Master Customer</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
		    <div class="modal-body" >
		    	<div class="dt-responsive table-responsive">
	                <table id="ViewTable" class="table table-striped">
	                    <thead class="text-primary">
	                        <tr>
	                            <th>
	                              Nama Customer
	                            </th>
	                            <th>
	                              Region
	                            </th>
	                            <th class="text-center">
	                              Phone 1
	                            </th>
	                            <th>
	                              Phone 2
	                            </th>
	                            <th>
	                              Attention
	                            </th>
	                            <th>
	                              Aktif
	                            </th>
	                            <th class="text-left">
	                              Aksi
	                            </th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                      
	                    </tbody>
	                </table>
	            </div>
			    <div style="display: none">
		            <input type="text" id="txtSelected" name="txtSelected">
		        </div>
		    </div>
	  	</div>
	</div>
</div>