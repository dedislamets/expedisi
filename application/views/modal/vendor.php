<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document" style="margin: 10% auto;max-width: 900px;">
	    <div class="modal-content" id="app">
	      	<div class="modal-header" style="background-color: #404E67;color:#fff">
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label> Customer</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name ="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							
							<div class="form-group">
								<label>Nama Instansi<span style="color:red"> *</span></label>
								<input type="text" id="cust_name" name="cust_name" class="form-control" maxlength="200" />
							</div>	
							<div class="form-group">
								<label>Alamat<span style="color:red"> *</span></label>
								<textarea name="cust_address" id="cust_address" rows="4" class="form-control required" placeholder="" style="height: 100px;" v-model:value="alamat" onkeydown="gantiAlamat()"> </textarea>
							</div>
						</div>
						<div class="col-sm-6">
							
							<div class="form-group m-b-0">
								<label>Kota/Region *</label>
								<input type="text" id="region" name="region" class="form-control" />
							</div>
							<div class="form-group m-b-0">
								<label>Attention</label>
								<input type="text" id="attn" name="attn" class="form-control" maxlength="200" />
							</div>
							
							<div class="form-group m-b-0">
								<label>Phone 1</label>
								<input type="text" id="phone1" name="phone1" class="form-control" />
							</div>	
							<div class="form-group m-b-0">
								<label>Phone 2</label>
								<input type="text" id="phone2" name="phone2" class="form-control" />
							</div>		
						</div>
					</div>
					<h4 class="info-text" style="padding-left: 10px;">Additional Address
                      <button class="btn btn-grd-invers" id="btnAddAlamat" ><i class="icofont icofont-ui-add"></i> Tambah baru</button>
                  	</h4>
					<div class="">
                  		<input type="hidden" id="total-row" name="total-row" :value="totalrow">
						
						<div class="dt-responsive table-responsive table-brg">
		                  	<table id="ViewTable" class="table table-bordered" style="margin-top: 0 !important;width: 100% !important;">
		                      	<thead class="text-primary" style="background: linear-gradient(to right, #3f535a, #212425);color: #fff !important;">
		                          	<tr>
		                              <th width="250">
		                                Tag
		                              </th>
		                              <th>
		                                Alamat
		                              </th>
		                              <th>
		                                Action
		                              </th>
		                          	</tr>
		                      	</thead>
		                      	<tbody id="tbody-table">
		                      		<template v-for="(log, index) in history">
				                            <tr>
					                          	<td :data-id="index+1">
					                            	<input type="text" :name="'tag_'+ (index+1)" :id="'tag_'+ (index+1)" class="form-control" :value="log.tag" :readonly="log.main == 1">
					                          	</td>
					                          	<td>
					                            	<textarea :name="'alamat_'+ (index+1)" :id="'alamat_'+ (index+1)" rows="4" :class="'form-control ' + (log.main==1 ? 'main' : '') " placeholder="" style="height: 100px;" :readonly="log.main == 1">{{ log.other_address }} </textarea>
					                          	</td>
					                          	<td style="width:8%">
						                            <input type="hidden" :id="'id_detail_'+ (index+1)" :name="'id_detail_'+ (index+1)" class="form-control " :value="log.id">
						                            <a href="javascript:void(0)" v-if="log.main != 1" class="btn hor-grd btn-grd-danger" onclick="cancel(this)">
						                              <i class="icofont icofont-trash"></i> Del</a>
						                        </td>
					                        </tr>
			                        </template>  
		                      	</tbody>
		                  	</table>
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