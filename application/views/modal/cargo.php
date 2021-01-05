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
	                        <li class="nav-item">
	                          <a class="nav-link active" data-toggle="tab" href="#home8" role="tab" aria-expanded="true">
	                            <img src="<?= base_url(); ?>assets/images/darat.png" class="img-fluid img-circle" alt="">
	                            <span class="quote">Darat</span>
	                          </a>
	                        </li>
	                        <li class="nav-item">
	                          <a class="nav-link" data-toggle="tab" href="#profile8" role="tab" aria-expanded="false">
	                            <img src="<?= base_url(); ?>assets/images/laut.png" class="img-fluid img-circle" alt="">
	                            <span class="quote">Laut</span>
	                          </a>
	                        </li>
	                        <li class="nav-item">
	                          <a class="nav-link" data-toggle="tab" href="#messages8" role="tab" aria-expanded="false">
	                            <img src="<?= base_url(); ?>assets/images/udara.png" class="img-fluid img-circle" alt="">
	                            <span class="quote">Udara</span>
	                          </a>
	                        </li>
	                      </ul>

	                      <div class="tab-content card-block" style="padding: 0;padding-top: 20px;">
	                        <div class="tab-pane active" id="home8" role="tabpanel" aria-expanded="true">
	                          <div style="overflow-y: scroll;overflow-x: hidden;max-height: 500px;">
	                            <h3 class="kategory-moda">Umum</h3>
	                            <div class="row list-moda" id="darat-kg" >
	                              <div class="col-sm-2">
	                                <img src="<?= base_url(); ?>assets/images/kg.png" class="img-fluid" style="background-color: #fff;height: 110px;width: 130px;">
	                              </div>
	                              <div class="col-sm-10">
	                                <div class="row">
	                                  <div class="col-sm-7">
	                                  <div style="font-size: 26px;font-weight: bold;">KG</div>
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

	                            <h3 class="kategory-moda">Van</h3>
	                            <div class="row list-moda" id="darat-van" >
	                              <div class="col-sm-2">
	                                <img src="<?= base_url(); ?>assets/images/van_blind-van.jpg" class="img-fluid" style="background-color: #fff;">
	                              </div>
	                              <div class="col-sm-10">
	                                <div class="row">
	                                  <div class="col-sm-7">
	                                  <div style="font-size: 26px;font-weight: bold;">BLIND VAN</div>
	                                    <p style="margin-bottom: 0px;">Rp 1.970.000</p>
	                                    <p style="margin-bottom: 0px;">Max 0.72 Ton</p>
	                                  </div>
	                                  <div class="col-sm-5" style="padding-right: 5%;padding-top: 20px;">
	                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeSmall" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"></path></svg>
	                                  </div>
	                                </div>
	                              </div>
	                            </div>
	                            <hr style="width: 100%;border-top: 2px solid #fff;">

	                            <h3 class="kategory-moda">Pickup</h3>
	                            <div class="row list-moda" id="darat-pickup-bak" >
	                              <div class="col-sm-2">
	                                <img src="<?= base_url(); ?>assets/images/pickup_bak.jpg" class="img-fluid " style="background-color: #fff;">
	                              </div>
	                              <div class="col-sm-10">
	                                <div class="row">
	                                  <div class="col-sm-7">
	                                    <div style="font-size: 26px;font-weight: bold;">BAK</div>
	                                    <p style="margin-bottom: 0px;">Rp 1.985.000</p>
	                                    <p style="margin-bottom: 0px;">Max 1 Ton</p>
	                                  </div>
	                                  <div class="col-sm-5" style="padding-right: 5%;padding-top: 20px;">
	                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeSmall" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"></path></svg>
	                                  </div>
	                                </div>
	                                
	                              </div>
	                            </div>
	                            <hr style="width: 100%;border-top: 2px solid #fff;">
	                            <div class="row list-moda" id="darat-pickup-box" >
	                              <div class="col-sm-2">
	                                <img src="<?= base_url(); ?>assets/images/pickup_box.jpg" class="img-fluid " style="background-color: #fff;">
	                              </div>
	                              <div class="col-sm-10">
	                                <div class="row">
	                                  <div class="col-sm-7">
	                                    <div style="font-size: 26px;font-weight: bold;">BOX</div>
	                                    <p style="margin-bottom: 0px;">Rp 2.193.000</p>
	                                    <p style="margin-bottom: 0px;">Max 1 Ton</p>
	                                  </div>
	                                  <div class="col-sm-5" style="padding-right: 5%;padding-top: 20px;">
	                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeSmall" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"></path></svg>
	                                  </div>
	                                </div>
	                              </div>
	                            </div>
	                            <hr style="width: 100%;border-top: 2px solid #fff;">

	                            <h3 class="kategory-moda">Colt Diesel Engkel (CDE)</h3>
	                            <div class="row list-moda" id="darat-cde-bak" >
	                              <div class="col-sm-2">
	                                <img src="<?= base_url(); ?>assets/images/cde_box.jpg" class="img-fluid " style="background-color: #fff;">
	                              </div>
	                              <div class="col-sm-10">
	                                <div class="row">
	                                  <div class="col-sm-7">
	                                    <div style="font-size: 26px;font-weight: bold;">BAK</div>
	                                    <p style="margin-bottom: 0px;">Rp 2.635.000</p>
	                                    <p style="margin-bottom: 0px;">Max 2.5 Ton</p>
	                                  </div>
	                                  <div class="col-sm-5" style="padding-right: 5%;padding-top: 20px;">
	                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeSmall" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"></path></svg>
	                                  </div>
	                                </div>
	                              </div>
	                            </div>
	                            <hr style="width: 100%;border-top: 2px solid #fff;">
	                            <div class="row list-moda" id="darat-cde-box" >
	                              <div class="col-sm-2">
	                                <img src="<?= base_url(); ?>assets/images/cde_bak.jpg" class="img-fluid " style="background-color: #fff;">
	                              </div>
	                              <div class="col-sm-10">
	                                <div class="row">
	                                  <div class="col-sm-7">
	                                    <div style="font-size: 26px;font-weight: bold;">BOX</div>
	                                    <p style="margin-bottom: 0px;">Rp 2.635.000</p>
	                                    <p style="margin-bottom: 0px;">Max 2.6 Ton</p>
	                                  </div>
	                                  <div class="col-sm-5" style="padding-right: 5%;padding-top: 20px;">
	                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeSmall" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"></path></svg>
	                                  </div>
	                                </div>
	                              </div>
	                            </div>
	                            <hr style="width: 100%;border-top: 2px solid #fff;">

	                            <h3 class="kategory-moda">Colt Diesel Double (CDD)</h3>
	                            <div class="row list-moda" id="darat-cdd-bak" >
	                              <div class="col-sm-2">
	                                <img src="<?= base_url(); ?>assets/images/cdd_bak.jpg" class="img-fluid " style="background-color: #fff;">
	                              </div>
	                              <div class="col-sm-10">
	                                <div class="row">
	                                  <div class="col-sm-7">
	                                    <div style="font-size: 26px;font-weight: bold;">BAK</div>
	                                    <p style="margin-bottom: 0px;">Rp 2.834.000</p>
	                                    <p style="margin-bottom: 0px;">Max 5 Ton</p>
	                                  </div>
	                                  <div class="col-sm-5" style="padding-right: 5%;padding-top: 20px;">
	                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeSmall" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"></path></svg>
	                                  </div>
	                                </div>
	                              </div>
	                            </div>
	                            <hr style="width: 100%;border-top: 2px solid #fff;">
	                            <div class="row list-moda" id="darat-cdd-box" >
	                              <div class="col-sm-2">
	                                <img src="<?= base_url(); ?>assets/images/cdd_box.jpg" class="img-fluid " style="background-color: #fff;">
	                              </div>
	                              <div class="col-sm-10">
	                                <div class="row">
	                                  <div class="col-sm-7">
	                                    <div style="font-size: 26px;font-weight: bold;">BOX</div>
	                                    <p style="margin-bottom: 0px;">Rp 2.834.000</p>
	                                    <p style="margin-bottom: 0px;">Max 5 Ton</p>
	                                  </div>
	                                  <div class="col-sm-5" style="padding-right: 5%;padding-top: 20px;">
	                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeSmall" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"></path></svg>
	                                  </div>
	                                </div>
	                              </div>
	                            </div>
	                            <hr style="width: 100%;border-top: 2px solid #fff;">

	                            <h3 class="kategory-moda">FUSO</h3>
	                            <div class="row list-moda" id="darat-fuso-bak" >
	                              <div class="col-sm-2">
	                                <img src="<?= base_url(); ?>assets/images/fuso_box.jpg" class="img-fluid " style="background-color: #fff;">
	                              </div>
	                              <div class="col-sm-10">
	                                <div class="row">
	                                  <div class="col-sm-7">
	                                    <div style="font-size: 26px;font-weight: bold;">BAK</div>
	                                    <p style="margin-bottom: 0px;">Rp 3.834.000</p>
	                                    <p style="margin-bottom: 0px;">Max 8 Ton</p>
	                                  </div>
	                                  <div class="col-sm-5" style="padding-right: 5%;padding-top: 20px;">
	                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeSmall" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"></path></svg>
	                                  </div>
	                                </div>
	                              </div>
	                            </div>
	                            <hr style="width: 100%;border-top: 2px solid #fff;">
	                            <div class="row list-moda" id="darat-fuso-box" >
	                              <div class="col-sm-2">
	                                <img src="<?= base_url(); ?>assets/images/fuso_bak.jpg" class="img-fluid " style="background-color: #fff;">
	                              </div>
	                              <div class="col-sm-10">
	                                <div class="row">
	                                  <div class="col-sm-7">
	                                    <div style="font-size: 26px;font-weight: bold;">BOX</div>
	                                    <p style="margin-bottom: 0px;">Rp 3.834.000</p>
	                                    <p style="margin-bottom: 0px;">Max 8 Ton</p>
	                                  </div>
	                                  <div class="col-sm-5" style="padding-right: 5%;padding-top: 20px;">
	                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeSmall" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"></path></svg>
	                                  </div>
	                                </div>
	                              </div>
	                            </div>
	                            <hr style="width: 100%;border-top: 2px solid #fff;">

	                            <h3 class="kategory-moda">Tronton</h3>
	                            <div class="row list-moda" id="darat-tronton-wingbox" >
	                              <div class="col-sm-2">
	                                <img src="<?= base_url(); ?>assets/images/tronton_wingbox.jpg" class="img-fluid " style="background-color: #fff;">
	                              </div>
	                              <div class="col-sm-10">
	                                <div class="row">
	                                  <div class="col-sm-7">
	                                    <div style="font-size: 26px;font-weight: bold;">WINGBOX</div>
	                                    <p style="margin-bottom: 0px;">Rp 5.834.000</p>
	                                    <p style="margin-bottom: 0px;">Max 20 Ton</p>
	                                  </div>
	                                  <div class="col-sm-5" style="padding-right: 5%;padding-top: 20px;">
	                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeSmall" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"></path></svg>
	                                  </div>
	                                </div>
	                              </div>
	                            </div>
	                            <hr style="width: 100%;border-top: 2px solid #fff;">
	                            
	                          </div>
	                        </div>
	                        <div class="tab-pane" id="profile8" role="tabpanel" aria-expanded="false">
	                          <h3 class="kategory-moda">Umum</h3>
	                          <div class="row list-moda" id="laut-kg" >
	                            <div class="col-sm-2">
	                              <img src="<?= base_url(); ?>assets/images/kg.png" class="img-fluid" style="background-color: #fff;height: 110px;width: 130px;">
	                            </div>
	                            <div class="col-sm-10">
	                              <div class="row">
	                                <div class="col-sm-7">
	                                <div style="font-size: 26px;font-weight: bold;">KG</div>
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
	                        </div>
	                        <div class="tab-pane" id="messages8" role="tabpanel" aria-expanded="false">
	                          <h3 class="kategory-moda">Umum</h3>
	                          <div class="row list-moda" id="udara-kg"  >
	                            <div class="col-sm-2">
	                              <img src="<?= base_url(); ?>assets/images/kg.png" class="img-fluid" style="background-color: #fff;height: 110px;width: 130px;">
	                            </div>
	                            <div class="col-sm-10">
	                              <div class="row">
	                                <div class="col-sm-7">
	                                <div style="font-size: 26px;font-weight: bold;">KG</div>
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
	                        </div>
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