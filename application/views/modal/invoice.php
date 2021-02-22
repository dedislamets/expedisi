<div id="modalBrowse" class="modal" >
	<div class="modal-dialog" role="document" style="margin: 10% auto;max-width: 900px;">
	  	<div class="modal-content">
		    <div class="modal-header" style="background-color: #404E67;color:#fff">
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label >Cari Routing Slip</label> <label id="lbl-title-do"></label></h4>
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
	                              No Routing 
	                            </th>
	                            <th>
	                              Tgl Routing 
	                            </th>
	                            <th>
	                              SPK/DO 
	                            </th>
	                            <th>
	                              Project
	                            </th>
	                            <th>
	                              Penerima
	                            </th>
	                            <th>
	                              Moda
	                            </th>
	                            <th>
	                              Status
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
			    
		    </div>
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
