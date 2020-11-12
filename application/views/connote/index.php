<div class="row">
    <div class="col-xl-10 col-sm-offset-1">
        <div class="wizard-container">

            <div class="card wizard-card" data-color="red" id="wizardProfile">
                <form id="form-wizard" name="form-wizard" action="" method="">
                    <div class="wizard-header">
                        <h3>
                           <b style="font-weight: bold;">Connote</b> Entry <br>
                           <small>Halaman untuk memasukkan data Connote </small>
                        </h3>
                    </div>

                    <div class="wizard-navigation">
                        <ul>
                            <li style="border-right: 1px solid #fff;"><a href="#moda" data-toggle="tab">Moda</a></li>
                            <li style="border-right: 1px solid #fff;"><a href="#pengirim" data-toggle="tab">Pengirim</a></li>
                            <li style="border-right: 1px solid #fff;"><a href="#penerima" data-toggle="tab">Penerima</a></li>
                            <li style="border-right: 1px solid #fff;"><a href="#barang" data-toggle="tab">Barang</a></li>
                            <li style="border-right: 1px solid #fff;"><a href="#layanan" data-toggle="tab">Layanan</a></li>
                            <li><a href="#preview" data-toggle="tab">Preview</a></li>
                        </ul>

                    </div>

                  <div class="tab-content">
                      <div class="tab-pane" id="moda">
                        <div class="row">
                            <h4 class="info-text">Pilih Moda & Tujuan</h4>
                            <input type="hidden" name="resi" id="resi" value="<?= $resi ?>">
                            <div class="col-sm-10 col-sm-offset-1">
                              <div style="padding: 30px;background-color: #404E67;color:#fff;width: 100%;border-radius: 10px;margin-bottom: 35px;">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Asal </label>
                                      <select name="asal" id="asal" class="js-example-basic-single col-sm-12">
                                        <?php 
                                        foreach($kota_asal as $row)
                                        { 
                                          echo '<option value="'.$row->kota_asal.'">'.$row->kota_asal.'</option>';
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Tujuan </label>
                                      <select name="tujuan" id="tujuan" class="js-example-basic-single col-sm-12">
                                          <?php 
                                          foreach($kota_tujuan as $row)
                                          { 
                                            echo '<option value="'.$row->kota_tujuan.'">'.$row->kota_tujuan.'</option>';
                                          }
                                          ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Moda </label>
                                      <select name="moda_tran" id="moda_tran" class="js-example-basic-single col-sm-12">
                                        <?php 
                                          foreach($moda as $row)
                                          { 
                                            echo '<option value="'.$row->kode_moda.'">'.$row->nama_moda.'</option>';
                                          }
                                          ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          
                        </div>
                      </div>
                      <div class="tab-pane" id="pengirim">
                          <div class="col-sm-10 col-sm-offset-1">
                              <div style="padding: 10px;background-color: #404E67;color:#fff;width: 100%;border-radius: 10px;margin-bottom: 35px;">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Asal</label>
                                    <div class="col-sm-10">
                                        <input name="origin1" type="text" class="form-control asal" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tujuan</label>
                                    <div class="col-sm-10">
                                        <input name="destinasi1" type="text" class="form-control tujuan" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Moda</label>
                                    <div class="col-sm-10">
                                        <input name="moda1" type="text" class="form-control moda" readonly="">
                                    </div>
                                </div>
                              
                              </div>
                          </div>
                          <hr style="width: 81%;border-top: 2px dotted rgba(0,0,0,.3);">
                          <h4 class="info-text"> Informasi Pengirim</h4>
                          <div class="col-sm-10 col-sm-offset-1">
                              <div class="form-group">
                                <label>Nama Pengirim <small>(required)</small></label>
                                <input name="nama_pengirim" id="nama_pengirim" type="text" class="form-control" placeholder="">
                              </div>
                              <div class="form-group">
                                <label>Alamat Pengirim <small>(required)</small></label>
                                <textarea name="alamat_pengirim" id="alamat_pengirim" rows="4" class="form-control required" placeholder="" style="height: 100px;"> </textarea>
                              </div>
                              <div class="form-group">
                                <label>Origin </label>
                                <input name="origin3" type="text" class="form-control asal" readonly="">
                              </div>
                              <div class="form-group">
                                  <label>Zip Code <small>(required)</small></label>
                                  <input name="zip_pengirim" id="zip_pengirim" type="text" class="form-control" placeholder="">
                              </div>
                              <div class="form-group">
                                <label>No Handphone <small>(required)</small></label>
                                <input name="phone_pengirim" id="phone_pengirim" type="text" class="form-control" placeholder="">
                              </div>
                          </div>
                      </div>
                      <div class="tab-pane" id="penerima">
                          <div class="col-sm-10 col-sm-offset-1">
                              <div style="padding: 10px;background-color: #404E67;color:#fff;width: 100%;border-radius: 10px;margin-bottom: 35px;">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Asal</label>
                                    <div class="col-sm-10">
                                        <input name="origin2" type="text" class="form-control asal" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tujuan</label>
                                    <div class="col-sm-10">
                                        <input name="destinasi2" type="text" class="form-control tujuan" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Moda</label>
                                    <div class="col-sm-10">
                                        <input name="moda2" type="text" class="form-control moda" readonly="">
                                    </div>
                                </div>
                              
                              </div>
                          </div>
                          <hr style="width: 81%;border-top: 2px dotted rgba(0,0,0,.3);">
                          <h4 class="info-text"> Informasi Penerima</h4>
                          <div class="col-sm-10 col-sm-offset-1">
                              <div class="form-group">
                                <label>Nama Penerima <small>(required)</small></label>
                                <input name="nama_penerima" id="nama_penerima" type="text" class="form-control" placeholder="">
                              </div>
                              <div class="form-group">
                                <label>Alamat Penerima <small>(required)</small></label>
                                <textarea name="alamat_penerima" id="alamat_penerima" rows="4" class="form-control" placeholder="" style="height: 100px;"> </textarea>
                              </div>
                              <div class="form-group">
                                <label>Destinasi </label>
                                <input name="origin3" type="text" class="form-control tujuan" readonly="">
                              </div>
                              <div class="form-group">
                                  <label>Zip Code <small>(required)</small></label>
                                  <input name="zip_penerima" id="zip_penerima" type="text" class="form-control" placeholder="">
                              </div>
                              <div class="form-group">
                                <label>No Handphone <small>(required)</small></label>
                                <input name="phone_penerima" id="phone_penerima" type="text" class="form-control" placeholder="">
                              </div>
                          </div>
                      </div>
                      <div class="tab-pane" id="barang">
                          <!-- <h4 class="info-text" style="font-weight: bold"> Input Data Barang yang akan di kirim</h4> -->
                           <div class="card-header" style="background-color: #404E67;color:#fff">
                              <div class="row">
                                <div class="col-xl-3">
                                  <button class="btn btn-grd-success" id="btnAdd"><i class="icofont icofont-ui-add"></i> Tambah baru</button>
                                </div>
                                <div class="col-xl-9">
                                  <h3 style="text-align: right;">Input Data Barang</h3>
                                  <input type="hidden" name="total_qty" name="total_qty" value="10">
                                  <input type="hidden" name="total_berat_actual" name="total_berat_actual" value="200">
                                </div>
                              </div>
                           </div>
                          <div class="card-block">
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
                      <div class="tab-pane" id="layanan">
                          <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                              <div style="padding: 10px;background-color: #404E67;color:#fff;width: 100%;border-radius: 10px;margin-bottom: 35px;">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Asal</label>
                                    <div class="col-sm-10">
                                        <input name="origin3" type="text" class="form-control asal" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tujuan</label>
                                    <div class="col-sm-10">
                                        <input name="destinasi3" type="text" class="form-control tujuan" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Moda</label>
                                    <div class="col-sm-10">
                                        <input name="moda3" type="text" class="form-control moda" readonly="">
                                    </div>
                                </div>
                              
                              </div>
                          </div>
                          <hr style="width: 81%;border-top: 2px dotted rgba(0,0,0,.3);">
                              <div class="col-sm-12">
                                  <h4 class="info-text"> Pilih layanan yang diinginkan </h4>
                              </div>
                            
                              <div class="col-sm-10 col-sm-offset-1">
                                   <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Paket</label>
                                      <div class="col-sm-10">
                                        <select name="paket" id="paket" class="form-control">
                                            
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Estimasi</label>
                                      <div class="col-sm-10">
                                          <input name="estimasi" id="estimasi" type="text" class="form-control" disabled="">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Biaya</label>
                                      <div class="col-sm-10">
                                          <input name="biaya" id="biaya"  type="text" class="form-control" disabled="">
                                      </div>
                                    </div>
                              </div>
                          </div>
                      </div>
                      <div class="tab-pane" id="preview">
                        <div class="row">
                          <div class="col-sm-10 col-sm-offset-1" style="border: 1px dotted;border-radius: 10px;padding: 10px;">
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
                                            <div id="t_npeni">Dedi Slamet</div>
                                            <div id="t_apeni">Perum Graha Prima Blok ID NO 111. Bekasi</div>
                                            <div id="t_telppeni">Telp. 08656787878</div>
                                          </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px;">
                                          <div class="col-sm-3">
                                            <div>Penerima:</div>
                                          </div>
                                          <div class="col-sm-9">
                                            <div id="t_npen">Dedi Slamet</div>
                                            <div id="t_apen">Perum Graha Prima Blok ID NO 111. Bekasi</div>
                                            <div id="t_telppen">Telp. 08656787878</div>
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
                                  <h2 style="text-align: center;width: 100%;" id="rute">JAKARTA - LAMPUNG</h2>
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
                      </div>
                  </div>
                  <div class="wizard-footer height-wizard">
                              <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
                      <div class="pull-right">
                          <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Next' />
                          <input type='button' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' name='finish' value='Finish' />

                      </div>

                      <div class="pull-left">
                          <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
                      </div>
                      <div class="clearfix"></div>
                  </div>

                </form>
            </div>
        </div> <!-- wizard container -->
    </div>
</div>
<?php
  $this->load->view($modal); 
?>

