<div id="modalModa" class="modal" >
	<div class="modal-dialog" role="document" style="margin: 10% auto;max-width: 900px;">
	  	<div class="modal-content">
		    <div class="modal-header" style="background-color: #404E67;color:#fff">
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label >Pilih Moda</label> <label id="lbl-title-moda"></label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
		    <div class="modal-body" >
		    	<div class="col-sm-12">
	                <div style="padding: 30px;background: linear-gradient(to right, #f6182d, #1c0200);color:#fff;width: 100%;border-radius: 10px;margin-bottom: 35px;">
	                  <div class="row">
	                    
	                    <div class="col-lg-12 col-xl-12 tab-with-img">
	                      <div class="sub-title">Pilih Moda</div>
	                      <input type="hidden" name="moda_tran" id="moda_tran">
	                      <ul class="nav nav-tabs md-tabs img-tabs b-none tablinks" role="tablist">
	                      	<?php 
	                        $urut=1;
	                        foreach($moda as $key => $value): ?>
	                        	<li class="nav-item">
		                          	<a class="nav-link <?php $urut==1 ? 'active': '' ?>" data-toggle="tab" href="#<?= $key ?>" role="tab" aria-expanded="true">
		                            	<img src="<?= base_url(); ?>assets/images/<?= $value['img'] ?>" class="img-fluid img-circle" alt="">
		                            	<span class="quote"><?= $key ?></span>
		                          	</a>
	                        	</li>
	                        <?php $urut++?>
                          	<?php endforeach; ?>
	                      </ul>

	                      <div class="tab-content card-block" style="padding: 0;padding-top: 20px;">
	                      	<?php 
	                        $urut=1;
	                        foreach($moda as $key => $value): ?>
		                        <div class="tab-pane <?php $urut==1 ? 'active': '' ?>" id="<?= $key ?>" role="tabpanel" aria-expanded="true">
		                          <div style="overflow-y: scroll;overflow-x: hidden;max-height: 500px;">
		                          	<?php foreach($value['data'] as $key2 => $value2): ?>

			                            <h3 class="kategory-moda"><?= $key2 ?></h3>
			                            <?php foreach($value2 as $key3 => $value3): ?>
			                            <div class="row list-moda" id="<?= $value3->id ?>" data-moda="<?= $key ?>" data-kat="<?= $key2 ?>" data-sub="<?= $value3->moda_subkategori ?>" >
			                              <div class="col-sm-2">
			                                <img src="<?= base_url(); ?>assets/images/<?= $value3->moda_subimage ?>" class="img-fluid" style="background-color: #fff;height: 110px;width: 130px;">
			                              </div>
			                              <div class="col-sm-10">
			                                <div class="row">
			                                  <div class="col-sm-7">
			                                  <div style="font-size: 26px;font-weight: bold;"><?= $value3->moda_subkategori ?></div>
			                                    <p style="margin-bottom: 0px;">Rp 5.000</p>
			                                    <p style="margin-bottom: 0px;">Min 20Kg</p>
			                                  </div>
			                                  <div class="col-sm-5" style="padding-right: 5%;padding-top: 20px;">
			                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeSmall" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"></path></svg>
			                                  </div>
			                                </div>
			                              </div>
			                            </div>
			                            <hr style="width: 100%;border-top: 2px solid #fff;">
			                            <?php endforeach; ?>
		                            <?php endforeach; ?>
		                          </div>
		                        </div>
	                        <?php $urut++?>
                          	<?php endforeach; ?>
	                        
	                      </div>
	                    </div>
	                  
	                  </div>
	                </div>
	            </div> 
		    </div>
	  	</div>
	</div>
</div>

<div id="modalBrowse" class="modal" >
	<div class="modal-dialog" role="document" style="margin: 10% auto;max-width: 900px;">
	  	<div class="modal-content">
		    <div class="modal-header" style="background-color: #404E67;color:#fff">
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label >Cari SPK/DO</label> <label id="lbl-title-do"></label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
		    <div class="modal-body" >
		    	<div class="dt-responsive table-responsive">
		    		<input type="hidden" name="id-row" id="id-row">
	                <table id="ViewTableSPK" class="table table-striped">
	                    <thead class="text-primary">
	                        <tr>
	                            <th>
	                              No SPK 
	                            </th>
	                            <th>
	                              Project
	                            </th>
	                            <th>
	                              Tanggal
	                            </th>
	                            <th>
	                              Pengirim
	                            </th>
	                            <th>
	                              Kota Pengirim
	                            </th>
	                            <th>
	                              Penerima
	                            </th>
	                            <th>
	                              Kota Penerima
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
		            <input type="text" id="txtSelectedBrg" name="txtSelectedBrg">
		        </div>
		    </div>
	  	</div>
	</div>
</div>

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
						<input type="text" id="phone2" name="phone2" class="form-control" />
					</div>		
					
					<input type="hidden" name="id" id="id" value="">
					<input type="hidden" name="tipe" id="tipe" value="">
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
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label >Cari Master</label> <label id="lbl-title-cust"></label></h4>
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

<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header" style="background-color: #404E67;color:#fff">
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label> Barang</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="FormAdd" name ="FormAdd" class="grab form-horizontal" role="form">
				<div class="modal-body">
			
					
					<div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control" id="cari_barang" name="cari_barang" class="form-control" maxlength="200">
							<span class="input-group-addon"><i class="icofont icofont-search"></i> &nbsp;&nbsp;Keyword</span>
						</div>
					</div>
					<div class="form-group">
						<label>Nama Barang<span style="color:red"> *</span></label>
						<div class="input-group">
							<input type="text" class="form-control" id="nama_barang" name="nama_barang" class="form-control" maxlength="200" readonly>
						</div>
					</div>	
					<div class="form-group">
						<label>Kode Barang<span style="color:red"> *</span></label>
						<div class="input-group">
							<input type="text" class="form-control" id="kode_barang" name="kode_barang" class="form-control" readonly >
							
						</div>
					</div>
					
					<div class="form-group">
						<label>Berat Barang</label>
						<input type="text" id="berat_barang" name="berat_barang" class="form-control" readonly />
					</div>		
					<div class="form-group">
						<label>Satuan</label>
						<select id="satuan" name="satuan" class="form-control">
		                   <option value="Kg">Kg</option>
		                   <option value="M">Meter</option>
		                   <option value="Ton">Ton</option>
		                   
		                </select>
					</div>		
					<div class="form-group">
						<label>Qty</label>
						<input type="number" id="qty" name="qty" class="form-control"  />
					</div>				
				
				</div>
				<div class="modal-footer">
		        	<div class="pull-right">
			            <button type="button" id="btnSubmitBrg" class="btn btn-primary btn-block">Submit</button>
			        </div>
		        </div>
			</form>
		</div>
	</div>
</div>

<div id="modalBarang" class="modal" >
	<div class="modal-dialog" role="document" style="margin: 10% auto;max-width: 900px;">
	  	<div class="modal-content">
		    <div class="modal-header" style="background-color: #404E67;color:#fff">
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label >Cari Master</label> <label id="lbl-title-cust"></label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
		    <div class="modal-body" >
		    	<div class="dt-responsive table-responsive">
		    		<input type="hidden" name="id-row" id="id-row">
	                <table id="ModalTableBrg" class="table table-striped" style="width: 100%">
	                    <thead class="text-primary">
	                        <tr>
	                            <th>
	                              Nama Barang
	                            </th>
	                            <th>
	                              Jenis Barang
	                            </th>
	                            <th class="text-center">
	                              Berat
	                            </th>
	                             <th class="text-center">
	                              Satuan
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
		            <input type="text" id="txtSelectedBrg" name="txtSelectedBrg">
		        </div>
		    </div>
	  	</div>
	</div>
</div>
