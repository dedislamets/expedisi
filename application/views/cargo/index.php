<style type="text/css">
  .lokasi {
    font-size: 13px;
    font-weight: bold;
    padding: 10px;
    background-image: linear-gradient(to right, #ffb56a , red) !important;
  }
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
                <input type="text" class="form-control form-bg-inverse" id="nomor_rs" name="nomor_rs" placeholder="" required>
              </div>
            </div>
            
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">NO SPK/DO/DN</label>
              <div class="col-sm-10">
                <div class="input-group input-group-button m-b-0">
                  <input type="text" class="form-control" id="nomor_spk" name="nomor_spk" readonly>
                  <span class="input-group-addon btn btn-grd-inverse" id="btnBrowse" style="border-width: 0;background-color: #01a9ac;">
                    <span class="">Browse..</span>
                  </span>
                </div>
                <input type="hidden" class="form-control" id="id_spk" name="id_spk">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">NAMA PROJECT</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="project" name="project" placeholder="" readonly />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">TANGGAL DO </label>
              <div class="col-sm-10">
                <input class="form-control" type="date" id="tgl_do" name="tgl_do" value="" readonly />
              </div>
            </div>
            

            <div class="row" id="pengirim">
              <div class="col-sm-12">
                <div class="card user-card-full m-b-0">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-6 bg-c-lite-green">
                          <div class="card-block text-white">
                            <div class="row b-b-default m-b-20 p-b-5">
                              <div class="col-sm-6  f-w-600">Pengirim</div>
                              <div class="col-sm-6">
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-10 col-sm-offset-1">
                                <h3 id="attn_pengirim"></h3>
                                <h3 id="nama_pengirim"></h3>
                                <h5 id="alamat_pengirim"></h5>
                                <p class="m-b-0" id="kota_pengirim"></p>
                                <p class="m-b-0" id="kec_pengirim"><span id="zip_pengirim"></span></p>
                                <p class="m-b-0" id="hp_pengirim"></p>
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
                                  <h3 id="attn_penerima"></h3>
                                  <h3 id="nama_penerima"></h3>
                                  <h5 id="alamat_penerima"></h5>
                                  <p class="m-b-0" id="kota_penerima"></p>
                                  <p class="m-b-0" id="kec_penerima"><span id="zip_penerima"></span></p>
                                  <p class="m-b-0" id="hp_penerima"></p>
                                </div>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="" id="barang">
              <div class="card z-depth-bottom-1">
                <div class="card-header" style="padding: 10px 20px;">

                </div>
                <div class="card-block panels-wells">
                  <div class="col-sm-12">
                    <div class="dt-responsive table-responsive">
                      
                      <table id="ViewTableBrg" class="table table-striped" style="margin-top: 0 !important;width: 100% !important;">
                          <thead class="text-primary">
                              <tr>
                                  <th>
                                    Nama Barang
                                  </th>
                                  <th>
                                    Berat
                                  </th>
                                  <th>
                                    Satuan
                                  </th>
                                  <th>
                                    Qty
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

            <div class="m-t-20" id="moda">
              <input type="hidden" name="resi" id="resi" value="<?= $resi ?>">
              <div class="card z-depth-0">
                <div class="card-header" style="padding: 10px 20px;">
                  <h4 style="font-size: 2.2rem;font-weight: bold;"><button type="button" id="btnModa" class="btn hor-grd btn-grd-inverse ">Pilih Moda Transportasi</button></h4>
                </div>
                <div class="card-block panels-wells">
                  <div class="row">
                    <div class="col">
                      <div class="well well-lg">
                        <div class="row" id="darat-kg" >
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

            <div class="" id="deliv">
              <h4 class="info-text" style="margin-top: 30px;padding-left: 10px;">Detail Pengiriman
              </h4>
              <div class="card z-depth-0">
                <div class="card-header" style="padding: 10px 20px;">
                  
                </div>
                <div class="card-block panels-wells">
                  <div class="row">
                    <div class="col">
                      <div class="well well-lg">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" style="font-weight: bold;">AWB NO</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="awb" name="awb" placeholder="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" style="font-weight: bold;">ORIGIN</label>
                          <div class="col-sm-4">
                            <input type="text" class="form-control" id="origin" name="origin" placeholder="">
                          </div>
                          <label class="col-sm-2 col-form-label" style="font-weight: bold;">DESTINATION</label>
                          <div class="col-sm-4">
                            <input type="text" class="form-control" id="dest" name="dest" placeholder="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" style="font-weight: bold;">NOMOR PELAYARAN</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="pelayaran_no" name="pelayaran_no" placeholder="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" style="font-weight: bold;">FLIGHT NO</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="flight_no" name="flight_no" placeholder="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" style="font-weight: bold;">FLIGHT DATE</label>
                          <div class="col-sm-10">
                            <input class="form-control" type="date" />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" style="font-weight: bold;">AGENT/VENDOR</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="agent" name="agent" placeholder="">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" style="font-weight: bold;">PICKUP DATE</label>
                          <div class="col-sm-10">
                            <input class="form-control" type="date" />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" style="font-weight: bold;">PICKUP ADDRESS</label>
                          <div class="col-sm-10">
                            <textarea rows="5" cols="5" class="form-control" placeholder="Masukkan alamat pickup" style="height: auto;"></textarea>
                          </div>
                        </div>
                        <hr>
                        <h4>Riwayat Pengiriman
                          <button type="button" id="btnModa" class="btn hor-grd btn-grd-inverse" style="float: right;">Update Status</button>

                        </h4>
                        <div class="card card-border-danger">
                          <div class="card-block">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="well m-b-0 p-10">
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <p style="font-style: italic">Barang sudah dipickup</p>
                                      <p class="m-b-0">Updated by: Noname</p>
                                    </div>
                                    <div class="col-sm-4">
                                      <div class="lokasi">Lokasi terakhir update yang diambil dari kordinat google maps</div>
                                    </div>
                                    <div class="col-sm-2">
                                      <div style="font-size: 1.5rem;padding: 10px;text-align: right;font-weight: bold;">PICKUP</div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                          <div class="card-footer" style="background-color: #ed3535;">
                            <div class="task-list-table" style="color: #fff">
                              <p class="task-due"><strong> Time Updated : </strong><strong class="label label-primary">23 hours</strong></p>
                            </div>
                            <div class="task-board m-0">
                              <a href="invoice.html" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i></a>
                              <div class="dropdown-secondary dropdown">
                                <button class="btn btn-info btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown14" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                <div class="dropdown-menu" aria-labelledby="dropdown14" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                  <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Print Invoice</a>
                                  <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Download invoice</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Edit Invoice</a>
                                  <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Remove Invoice</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card card-border-danger">
                          <div class="card-block">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="well m-b-0 p-10">
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <p style="font-style: italic">Tiket Pesawat sudah di booking</p>
                                      <p class="m-b-0">Updated by: Noname</p>
                                    </div>
                                    <div class="col-sm-4">
                                      <div class="lokasi">Lokasi terakhir update yang diambil dari kordinat google maps</div>
                                    </div>
                                    <div class="col-sm-2">
                                      <div style="font-size: 1.5rem;padding: 10px;text-align: right;font-weight: bold;">BOOKING</div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                          <div class="card-footer" style="background-color: #ed3535;">
                            <div class="task-list-table" style="color: #fff">
                              <p class="task-due"><strong> Time Updated : </strong><strong class="label label-primary">23 hours</strong></p>
                            </div>
                            <div class="task-board m-0">
                              <a href="invoice.html" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i></a>
                              <div class="dropdown-secondary dropdown">
                                <button class="btn btn-info btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown14" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                <div class="dropdown-menu" aria-labelledby="dropdown14" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                  <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Print Invoice</a>
                                  <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Download invoice</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Edit Invoice</a>
                                  <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Remove Invoice</a>
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

