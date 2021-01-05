<style type="text/css">
  .btn-primary {
    border-color: transparent;
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
  .table-brg {
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
  .input-group-addon {
    background-color: #01a9ac !important;
  }
  .second-modal { z-index: 1070 }

  div.modal-backdrop + div.modal-backdrop {
     z-index: 1060; 
  }
</style>

<div class="page-body">
  <div class="row">
    <div class="col-sm-12">

      <div class="card z-depth-0">
        <div class="card-header" style="background-color: #404E67;color:#fff">
          <div class="row">
              <div class="col-xl-10">
                  <h4>SPK/DO Transaction</h4>
                  <span>Halaman ini menampilkan data connote yang tersimpan</span>
              </div>
              <div class="col-xl-2">
                <input type="hidden" name="mode" id="mode" value="<?= $mode ?>">
                <!-- <div class="status-trans">INPUT</div> -->
                  <!-- <a href="<?= base_url() ?>connote" class="btn btn-grd-success" ><i class="icofont icofont-ui-add"></i> Tambah baru</a> -->
              </div>
          </div>
        </div>
        <div class="card-block">
          <form id="form-wizard" name="form-wizard" action="" method="" style="padding-top: 20px;">
            
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">NAMA PROJECT</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-bg-inverse" id="project" name="project" placeholder="Masukkan nama project" value="<?= empty($data) ? "" : $data['nama_project'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">NO SPK/DO/DN</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-bg-inverse" id="nomor_spk" name="nomor_spk" placeholder="Masukkan nomor SPK" value="<?= empty($data) ? "" : $data['spk_no'] ?>">
              </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" style="font-weight: bold;">TANGGAL DO </label>
                <div class="col-sm-10">
                  <input class="form-control form-bg-inverse" type="date" id="tgl_do" name="tgl_do" value="<?= empty($data) ? "" : $data['tgl_spk']  ?>" />
                </div>
              </div>
            

            <div class="row" id="pengirim">
              <div class="col-sm-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-6 bg-c-lite-green">
                          <div class="card-block text-white">
                            <div class="row b-b-default m-b-20 p-b-5">
                              <div class="col-sm-6  f-w-600">Pengirim</div>
                              <div class="col-sm-6">
                                <a href="#" class="btn btn-primary btn-mini waves-effect waves-light btnCariPengirim" style="float: right;color: #fff;">Cari</a>
                                <a href="#" class="btn btn-primary btn-mini waves-effect waves-light btn-grd-success btnAddPengirim" style="float: right;color: #fff;">Tambah</a>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-10 col-sm-offset-1">
                                
                                <div class="form-group">
                                  <label>Nama Pengirim <small>(required)</small></label>
                                  <input name="nama_pengirim" readonly id="nama_pengirim" type="text" class="form-control" placeholder="">
                                  <input type="hidden" name="id_pengirim" id="id_pengirim" value="<?= empty($data) ? "" : $data['id_pengirim']?>">
                                </div>
                                <div class="form-group">
                                  <label>Alamat Pengirim <small>(required)</small></label>
                                  <textarea name="alamat_pengirim" id="alamat_pengirim" v-model:value="alamat_pengirim" rows="4" class="form-control required" placeholder="" style="height: 100px;" ><?= empty($data) ? "" : $data['alamat_pengirim']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Kota/Kab <small></small></label>
                                    <select name="region_pengirim" id="region_pengirim" class="js-example-basic-single col-sm-12">
                                      <option value="">Pilih Kota</option>
                                      <?php 
                                      foreach($kota_asal as $row)
                                      { 
                                        if( empty($data) ? "" : $data['kota_pengirim'] === $row->kota){
                                          echo '<option value="'.$row->kota.'" selected >'.$row->kota.'</option>';
                                        }else{
                                          echo '<option value="'.$row->kota.'">'.$row->kota.'</option>';
                                        }
                                      }
                                      ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                  <label>Kecamatan <small>(required)</small></label>
                                  <select name="kecamatan_pengirim" id="kecamatan_pengirim" class="js-example-basic-single col-sm-12">
                                    <option value="">Pilih Kecamatan</option>
                                    <?php 
                                      foreach($kec_pengirim as $row)
                                      { 
                                        if( empty($data) ? "" : $data['kec_pengirim'] === $row->kecamatan){
                                          echo '<option value="'.$row->kecamatan.'" selected >'.$row->kecamatan.'</option>';
                                        }else{
                                          echo '<option value="'.$row->kecamatan.'">'.$row->kecamatan.'</option>';
                                        }
                                      }
                                      ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label>Zip Code <small></small></label>
                                    <select name="zip_pengirim" id="zip_pengirim" class="js-example-basic-single col-sm-12">
                                      <option  value="">Pilih Kodepos</option>
                                      <?php 
                                        foreach($zip_pengirim as $row)
                                        { 
                                          if( empty($data) ? "" : $data['zip_pengirim'] === $row->kodepos){
                                            echo '<option value="'.$row->kodepos.'" selected >'.$row->kodepos.'</option>';
                                          }else{
                                            echo '<option value="'.$row->kodepos.'">'.$row->kodepos.'</option>';
                                          }
                                        }
                                      ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                  <label>No Handphone <small>(required)</small></label>
                                  <input name="phone_pengirim" id="phone_pengirim" v-model:value="hp_pengirim" type="text" class="form-control" value="<?= empty($data) ? "" : $data['hp_pengirim']?>">
                                </div>
                                <div class="form-group">
                                  <label>Attention </label>
                                  <input name="attn_pengirim" id="attn_pengirim" type="text" class="form-control" value="<?= empty($data) ? "" : $data['attn_pengirim']?>">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6" style="background: linear-gradient(to right, #546D77, #3F5159);;color: #fff;">
                          <div class="card-block">
                            <div class="row b-b-default m-b-20 p-b-5">
                              <div class="col-sm-6  f-w-600">Penerima</div>
                              <div class="col-sm-6">
                                <a href="#" class="btn btn-primary btn-mini waves-effect waves-light btnCariPenerima" style="float: right;color: #fff;">Cari</a>
                                <a href="#" class="btn btn-primary btn-mini waves-effect waves-light btn-grd-success btnAddPenerima" style="float: right;color: #fff;">Tambah</a>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-10 col-sm-offset-1">
                                  <div class="form-group">
                                    <label>Nama Penerima <small>(required)</small></label>
                                    <input name="nama_penerima" id="nama_penerima" type="text" class="form-control" placeholder="" readonly>
                                    <input type="hidden" name="id_penerima" id="id_penerima" value="<?= empty($data) ? "" : $data['id_penerima']?>">
                                  </div>
                                  <div class="form-group">
                                    <label>Alamat Penerima <small>(required)</small></label>
                                    <textarea name="alamat_penerima" id="alamat_penerima"  rows="4" class="form-control" style="height: 100px;"><?= empty($data) ? "" : $data['alamat_penerima']?></textarea>
                                  </div>
                                  <div class="form-group">
                                    <label>Kota/Kab <small></small></label>
                                    <select name="region_penerima" id="region_penerima" class="js-example-basic-single col-sm-12">
                                      <option value="">Pilih Kota</option>
                                      <?php 
                                      foreach($kota_asal as $row)
                                      { 
                                        if( empty($data) ? "" : $data['kota_penerima'] === $row->kota){
                                          echo '<option value="'.$row->kota.'" selected >'.$row->kota.'</option>';
                                        }else{
                                          echo '<option value="'.$row->kota.'">'.$row->kota.'</option>';
                                        }
                                      }
                                      ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label>Kecamatan <small>(required)</small></label>
                                    <select name="kecamatan_penerima" id="kecamatan_penerima" class="js-example-basic-single col-sm-12">
                                      <option value="">Pilih Kecamatan</option>
                                      <?php 
                                      foreach($kec_penerima as $row)
                                      { 
                                        if( empty($data) ? "" : $data['kec_penerima'] === $row->kecamatan){
                                          echo '<option value="'.$row->kecamatan.'" selected >'.$row->kecamatan.'</option>';
                                        }else{
                                          echo '<option value="'.$row->kecamatan.'">'.$row->kecamatan.'</option>';
                                        }
                                      }
                                      ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                      <label>Zip Code <small></small></label>
                                      <select name="zip_penerima" id="zip_penerima" class="js-example-basic-single col-sm-12">
                                        <option value="">Pilih Kodepos</option>
                                        <?php 
                                        foreach($zip_penerima as $row)
                                        { 
                                          if( empty($data) ? "" : $data['zip_penerima'] === $row->kodepos){
                                            echo '<option value="'.$row->kodepos.'" selected >'.$row->kodepos.'</option>';
                                          }else{
                                            echo '<option value="'.$row->kodepos.'">'.$row->kodepos.'</option>';
                                          }
                                        }
                                        ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                    <label>No Handphone <small>(required)</small></label>
                                    <input name="phone_penerima" id="phone_penerima" type="text" class="form-control" value="<?= empty($data) ? "" : $data['hp_penerima']?>" >
                                  </div>
                                  <div class="form-group">
                                    <label>Attention </label>
                                    <input name="attn_penerima" id="attn_penerima" type="text" class="form-control" value="<?= empty($data) ? "" : $data['attn_penerima']?>">
                                  </div>
                              </div>
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
                <div class="dt-responsive table-responsive table-brg">
                  <input type="hidden" id="total-row" name="total-row" value="<?= $totalrow ?>">
                  <table id="ViewTableBrg" class="table table-striped" style="margin-top: 0 !important;width: 100% !important;">
                      <thead class="text-primary">
                          <tr>
                              <th>
                                No
                              </th>
                              <th>
                                Aksi
                              </th>
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
                      <tbody id="tbody-table">
                          <?php 
                          $urut=1;
                          foreach($data_detail as $row): ?>
                            <tr>
                              <td style="width:1%"><?=$urut?></td>
                              <td>
                                <input type="text" id="kode<?=$urut?>" name="kode<?=$urut?>" class="form-control hidden" value="<?=$row['id_barang']?>">
                                <input type="text" id="id_detail<?=$urut?>" name="id_detail<?=$urut?>" class="form-control hidden" value="<?=$row['id']?>">
                                <a href="#" class="btn hor-grd btn-grd-success" onclick="cari_dealer(this)">
                                  <i class="icofont icofont-search"></i> Cari
                                </a>
                                <a href="javascript:void(0)" class="btn hor-grd btn-grd-danger" onclick="cancel(this)"><i class="icofont icofont-trash"></i> Del</a>
                              </td>
                              <td><?=$row['nama_barang']?></td>
                              <td><?=$row['berat']?></td>
                              <td>
                                <input type="text" name="satuan<?=$urut?>" id="satuan<?=$urut?>" class="form-control" value="<?=$row['satuan']?>"/>
                              </td>
                              <td>
                                <input type="number" id="qty<?=$urut?>" name="qty<?=$urut?>" placeholder="Qty" class="form-control" style="width:100%" value="<?=$row['qty']?>">
                              </td>
                            </tr>
                            <?php $urut++?>
                          <?php endforeach; ?>

                      </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-10 col-sm-offset-1" style="margin-top: 10px;">
                <input type="hidden" id="csrf_token_sub" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
                <button class="btn btn-block btn-grd-success" id="btn-finish">Simpan</button>
              </div>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>
<?php
  $this->load->view($modal); 
?>

