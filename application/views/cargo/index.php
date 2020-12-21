<style type="text/css">
  .info-text{
    margin-bottom: 12px;
    padding-left: 10%;
    font-size: 36px;
    font-weight: bold;
  }
  .img-tabs a img {
    border: 3px solid;
  }
  .md-tabs .nav-item {
    width: calc(100% / 3);
    text-align: center;
  }
  .md-tabs .nav-item a {
    background-color: #fff
  }
  .md-tabs .nav-item.open .nav-link, .md-tabs .nav-item.open .nav-link:focus, .md-tabs .nav-item.open .nav-link:hover, .md-tabs .nav-link.active, .md-tabs .nav-link.active:focus, .md-tabs .nav-link.active:hover {
    background-color: #fff;
  }
  .quote{
    display: block;
  }
  .sub-title{
    color: #fff;
  }
  .kategory-moda{
    padding: 10px;
    background-color: #e1e1e1;
    color: #000;
    border-radius: 4px;
    margin-bottom: 17px;
  }
  .MuiSvgIcon-fontSizeSmall {
    font-size: 1.25rem;
    float: right;
  }
  .MuiSvgIcon-root {
      fill: currentColor;
      width: 1em;
      height: 1em;
      display: inline-block;
      font-size: 2.1rem;
      transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
      flex-shrink: 0;
      user-select: none;
  }
  .list-moda{
    cursor: pointer;
  }
  .list-selected{
    background-image:linear-gradient(to right,  #144322 , red, yellow) !important;
  }
  .table-responsive {
    background: linear-gradient(to right, #546D77, #3F5159);
    color: #fff;
  }
  #ViewTableBrg>thead{
    background: linear-gradient(to right, #3f535a, #212425);
    color: #fff !important;
  }
  .form-bg-inverse {
    background-color: #404E67 !important;
    border-color: #404E67 !important;
    color: #fff !important;
  }
  .status-trans{
    font-size: 22px;
    font-weight: bold;
    color: darkorange;
    background-color: black;
    padding: 10px;
    text-align: center;
  }
</style>

<div class="page-body">
  <div class="row">
    <div class="col-sm-12">

      <div class="card z-depth-0">
        <div class="card-header" style="background-color: #404E67;color:#fff">
          <div class="row">
              <div class="col-xl-10">
                  <h4>Routing Slip Transaction</h4>
                  <span>Halaman ini menampilkan data connote yang tersimpan</span>
              </div>
              <div class="col-xl-2">
                <div class="status-trans">INPUT</div>
                  <!-- <a href="<?= base_url() ?>connote" class="btn btn-grd-success" ><i class="icofont icofont-ui-add"></i> Tambah baru</a> -->
              </div>
          </div>
        </div>
        <div class="card-block">
          <form id="form-wizard" name="form-wizard" action="" method="" style="padding-top: 20px;">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">NO ROUTING</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-bg-inverse" id="nomor_rs" name="nomor_rs" placeholder="Masukkan nomor routing slip">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">NO SPK/DO/DN</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-bg-inverse" id="nomor_spk" name="nomor_spk" placeholder="Masukkan nomor SPK">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">NAMA PROJECT</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-bg-inverse" id="project" name="project" placeholder="Masukkan nama project">
              </div>
            </div>
            

            <div class="row" id="pengirim">
              <div class="col-sm-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-6 bg-c-lite-green">
                          <div class="card-block text-white">
                            <div class="row b-b-default m-b-20 p-b-5">
                              <div class="col-sm-6  f-w-600">Vendor</div>
                              <div class="col-sm-6">
                                <a href="#" class="btn btn-primary btn-mini waves-effect waves-light" style="float: right;color: #fff;">Tambah</a>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-10 col-sm-offset-1">
                                <div class="form-group">
                                  <label>Asal <small>(required)</small></label>
                                  <select name="asal" id="asal" class="js-example-basic-single col-sm-12" v-model:value="asal">
                                    <option disabled value="">Pilih Asal</option>
                                    <?php 
                                    foreach($kota_asal as $row)
                                    { 
                                      echo '<option value="'.$row->kecamatan.'">'.$row->kecamatan.'</option>';
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Nama Pengirim <small>(required)</small></label>
                                  <input name="nama_pengirim" readonly id="nama_pengirim" v-model:value="nama_pengirim" type="text" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                  <label>Alamat Pengirim <small>(required)</small></label>
                                  <textarea name="alamat_pengirim" id="alamat_pengirim" v-model:value="alamat_pengirim" rows="4" class="form-control required" placeholder="" style="height: 100px;" readonly> </textarea>
                                </div>
                                <div class="form-group">
                                    <label>Zip Code <small>(required)</small></label>
                                    <input name="zip_pengirim" id="zip_pengirim" type="text" class="form-control" placeholder="" readonly>
                                </div>
                                <div class="form-group">
                                  <label>No Handphone <small>(required)</small></label>
                                  <input name="phone_pengirim" id="phone_pengirim" readonly v-model:value="hp_pengirim" type="text" class="form-control" placeholder="">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6" style="background: linear-gradient(to right, #546D77, #3F5159);;color: #fff;">
                          <div class="card-block">
                              <div class="row b-b-default m-b-20 p-b-5">
                                <div class="col-sm-6  f-w-600">Penerima</div>
                                <div class="col-sm-6" style="height: 28px;">
                                  
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group">
                                      <label>Tujuan <small>(required)</small></label>
                                      <select name="asal" id="asal" class="js-example-basic-single col-sm-12" v-model:value="asal">
                                        <option disabled value="">Pilih tujuan</option>
                                        <?php 
                                        foreach($kota_tujuan as $row)
                                        { 
                                          echo '<option value="'.$row->kecamatan.'">'.$row->kecamatan.'</option>';
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Nama Penerima <small>(required)</small></label>
                                      <input name="nama_penerima" id="nama_penerima" v-model:value="nama_penerima" type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label>Alamat Penerima <small>(required)</small></label>
                                      <textarea name="alamat_penerima" id="alamat_penerima" v-model:value="alamat_penerima" rows="4" class="form-control" placeholder="" style="height: 100px;"> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Zip Code <small>(required)</small></label>
                                        <input name="zip_penerima" id="zip_penerima" type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label>No Handphone <small>(required)</small></label>
                                      <input name="phone_penerima" id="phone_penerima" v-model:value="hp_penerima" type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="row" id="moda">
              <input type="hidden" name="resi" id="resi" value="<?= $resi ?>">
              <div class="col-sm-12">
                <div style="padding: 30px;background: linear-gradient(to right, #546D77, #3F5159);color:#fff;width: 100%;border-radius: 10px;margin-bottom: 35px;">
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

            <div class="row" id="barang">
              <h4 class="info-text" style="margin-top: 30px;padding-left: 10px;">Input Data Barang
                  <button class="btn btn-grd-inverse" id="btnAdd"><i class="icofont icofont-ui-add"></i> Tambah baru</button>
              </h4>
              <div class="col-sm-12">
                <div class="dt-responsive table-responsive">
                  
                  <table id="ViewTableBrg" class="table table-striped" style="margin-top: 0 !important;width: 100% !important;">
                      <thead class="text-primary">
                          <tr>
                              <th>
                                Nama Barang
                              </th>
                              <th>
                                Qty
                              </th>
                              <th>
                                Satuan
                              </th>
                              <th>
                                Berat Actual
                              </th>
                              <th>
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

            <div class="" id="deliv">
              <h4 class="info-text" style="margin-top: 30px;padding-left: 10px;">Detail Pengiriman
              </h4>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" style="font-weight: bold;">PICKUP DATE</label>
                <div class="col-sm-10">
                  <input class="form-control" type="date" />
                </div>
              </div>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>
<div id="app">
  <form >
    
    
    

    <!-- <div class="row" id="preview">
      <hr style="width: 81%;border-top: 2px dotted rgba(0,0,0,.3);">
      <h4 class="info-text"> Summary </h4>
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1" style="border: 1px dotted;border-radius: 10px;padding: 10px;background-color: #fff;">
          <div class="row">
            <div class="col-sm-6" style="border-right: 2px dotted;">
              <div class="row">
                  <div class="col-sm-12">
                      <div class="row">
                        <div class="col-sm-4">
                          <img style="height: 38px;margin-top: 10px;" src="assets\images\logo.png" >
                        </div>
                        <div class="col-sm-8">
                          <div>Wilayah Pusat</div>
                          <div>Jl. Raya Kalimalang KM 108, Bekasi</div>
                          <div>Telp. 08656787878</div>
                        </div>
                      </div>
                      <hr style="width: 100%;border-top: 2px dotted rgba(0,0,0,.3);">
                      <div class="row">
                        <div class="col-sm-3">
                          <div>Tanggal</div>
                        </div>
                        <div class="col-sm-9">
                          <div>11 Desember 2020</div>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom: 10px;">
                        <div class="col-sm-3">
                          <div>Pengirim:</div>
                        </div>
                        <div class="col-sm-9">
                          <div id="t_npeni">{{ nama_pengirim }}</div>
                          <div id="t_apeni">{{ alamat_pengirim }}</div>
                          <div id="t_telppeni">Telp. {{ hp_pengirim }}</div>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom: 10px;">
                        <div class="col-sm-3">
                          <div>Penerima:</div>
                        </div>
                        <div class="col-sm-9">
                          <div id="t_npen">{{ nama_penerima }}</div>
                          <div id="t_apen">{{ alamat_penerima }}</div>
                          <div id="t_telppen">Telp. {{ hp_penerima }}</div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <div>Moda :</div>
                        </div>
                        <div class="col-sm-3">
                          <div id="t_moda">Darat</div>
                        </div>
                        <div class="col-sm-3">
                          <div>Service :</div>
                        </div>
                        <div class="col-sm-3">
                          <div id="t_services">Reguler</div>
                        </div>
                      </div>
          
                      <div class="row">
                        <div class="col-sm-3">
                          <div>Payment :</div>
                        </div>
                        <div class="col-sm-3">
                          <div id="metode">Tunai</div>
                        </div>
                        <div class="col-sm-3">
                          <div>Tarif :</div>
                        </div>
                        <div class="col-sm-3">
                          <div id="t_services">100.000</div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <div>Kasir :</div>
                        </div>
                        <div class="col-sm-9">
                          <div>Dedi Slamet</div>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="row">
                <h2 style="text-align: center;width: 100%;" id="rute">{{ asal }} - {{ tujuan }}</h2>
              </div>
              <div class="row" style="margin-bottom: 10px;">
                <div class="col-sm-10 col-sm-offset-1">
                  <img src="<? echo $barcode; ?>" class="img-fluid" style="width: 100%;"></div>
              </div>
              <div class="row" style="font-weight: bold;">
                <div class="col-sm-7">Barang</div>
                <div class="col-sm-2">Qty</div>
                <div class="col-sm-3">Satuan</div>
              </div>
              <hr style="width: 100%;border-top: 2px dotted rgba(0,0,0,.3);">
              <div class="row">
                <div class="col-sm-7">Tiang Telp</div>
                <div class="col-sm-2">10</div>
                <div class="col-sm-3">Pcs</div>
              </div>
              <div class="row">
                <div class="col-sm-7">Kabel Udara</div>
                <div class="col-sm-2">10</div>
                <div class="col-sm-3">Mtr</div>
              </div>
              <hr style="width: 100%;border-top: 2px dotted rgba(0,0,0,.3);">
              <div class="row">
                <div class="col-sm-3">
                  <div>Berat</div>
                </div>
                <div class="col-sm-9">
                  <div>300 kg</div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <div>Total Tarif</div>
                </div>
                <div class="col-sm-9">
                  <div id="t_tarif">2.000.000,-</div>
                </div>
              </div>
            </div>
            <p style="width: 100%;padding-top: 15px;text-align: center;font-size: 12px;">Untuk mengetahui status kiriman anda silahkan kunjungin website kami di www.aaaaa.co.id</p>
          </div>
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1" style="margin-top: 10px;">
        <button class="btn btn-block btn-grd-success" id="btn-finish">Proses & Cetak</button>
      </div>
    </div>
    <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
  </form>
</div>
<?php
  $this->load->view($modal); 
?>

