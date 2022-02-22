<style type="text/css">
  .float{
    position:fixed;
    width:60px;
    height:60px;
    bottom:40px;
    right:40px;
    background-color:#0C9;
    color:#FFF;
    border-radius:50px;
    text-align:center;
    box-shadow: 2px 2px 3px #999;
  }

  .my-float{
    margin-top:22px;
  }
  .preview-dropzone{
        color: firebrick;
        text-align: center;
        display: block;
        width: 100%;
    }
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
  #ViewTableMulti>thead{
    background: linear-gradient(to right, #3f535a, #212425);
    color: #fff !important;
  }
  #ViewTableBiaya>thead{
    background: linear-gradient(to right, #3f535a, #212425);
    color: #fff !important;
  }
  #ViewTableHist>thead{
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
    padding:4px;
    text-align: center;
  }
</style>

<div class="page-body" id="app">
  <div class="row">
    <div class="col-sm-12">

      <div class="card z-depth-0">
        <div class="card-header" style="">
          <div class="row">
              <div class="col-xl-6">
                  <h4 style="font-weight: bold;"><?= $title ?> <a href="<?= base_url() ?>listrs"> Back </a></h4>
                  <span style="font-weight: bold;">Halaman ini menampilkan data connote yang tersimpan</span>
              </div>
              <div class="col-xl-2" >
                <a v-if="mode == 'edit'" href="<?= base_url() ?>cetak/rs?id=<?= empty($data) ? "" : $data['id'] ?>" id="btnCetak" class="btn btn-inverse btn-outline-inverse btn-block" target="_blank">  <i class="icofont icofont-print" ></i>Cetak</a>
              </div>
              <div class="col-xl-2" >
                <a v-if="mode == 'edit'" href="<?= base_url() ?>trace/view/<?= empty($data) ? "" : $data['id'] ?>" id="btnTracking" class="btn btn-inverse btn-outline-inverse btn-block">  <i class="icofont icofont-long-drive" ></i>Tracking</a>
              </div>
              <div class="col-xl-2">
                <div class="status-trans"><?= empty($data) ? "INPUT" : $data['status'] ?></div>
                  <!-- <a href="<?= base_url() ?>connote" class="btn btn-grd-success" ><i class="icofont icofont-ui-add"></i> Tambah baru</a> -->
              </div>
          </div>
        </div>
        <div class="card-block">
          <form id="form-routing" name="form-wizard" action="" method="" style="padding-top: 20px;">
            <input type="hidden" name="mode" id="mode" value="<?= $mode ?>">

            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">NO ROUTING</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nomor_rs" name="nomor_rs" value="<?= empty($data) ? "" : $data['no_routing'] ?>" required :readonly="last_status == 'DITERIMA'">
              </div>
            </div>
            
            <!-- <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">NO SPK/DO/DN</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nomor_spk" name="nomor_spk" readonly v-if="last_status == 'DITERIMA'">

                <div class="input-group input-group-button m-b-0" v-if="last_status != 'DITERIMA'">
                  <input type="text" class="form-control" id="nomor_spk" name="nomor_spk" readonly>
                  <span class="input-group-addon btn btn-grd-inverse" id="btnBrowse" style="border-width: 0;background-color: #01a9ac;">
                    <span class="">Browse..</span>
                  </span>
                </div>
                <input type="hidden" class="form-control" id="id_spk" name="id_spk" >
              </div>
            </div> -->
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">NAMA PROJECT</label>
              <div class="col-sm-10">
                <select name="project" id="project" class="js-example-basic-single col-sm-12" required>
                  <option value="">Pilih Project</option>
                  <?php 
                  foreach($project as $row)
                  { 
                    if( empty($data) ? "" : $data['nama_project'] === $row->nama_project){
                      echo '<option value="'.$row->nama_project.'" selected >'.$row->nama_project.'</option>';
                    }else{
                      echo '<option value="'.$row->nama_project.'">'.$row->nama_project.'</option>';
                    }
                  }
                  ?>
                </select>
                <!-- <input type="text" class="form-control" id="project" name="project" placeholder="Masukkan nama project" value="<?= empty($data) ? "" : $data['nama_project'] ?>"> -->
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">NO SPK/DO/DN</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nomor_spk" name="nomor_spk" placeholder="Masukkan nomor SPK" value="<?= empty($data) ? "" : $data['spk_no'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">TANGGAL DO </label>
              <div class="col-sm-10">
                <input class="form-control" type="date" id="tgl_do" name="tgl_do" value="<?= empty($data) ? "" : $data['tgl_spk']  ?>" />
              </div>
            </div>

            <div class="row" id="pengirim">
              <div class="col-sm-12">
                <div class="card user-card-full" style="border: solid 1px #e2e2e2;">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-6" style="border-right: solid 2px #e2e2e2;">
                          <div class="card-block">
                            <div class="row b-b-default m-b-20 p-b-5">
                              <div class="col-sm-6" style="font-weight: bold;font-size: 20px;">Pengirim</div>
                              <!-- <div class="col-sm-6">
                                <a href="#" class="btn btn-primary btn-mini waves-effect waves-light btnCariPengirim" style="float: right;color: #fff;" v-if="last_status != 'CLOSED'">Cari</a>
                                <a href="#" class="btn btn-primary btn-mini waves-effect waves-light btn-grd-success btnAddPengirim" style="float: right;color: #fff;" v-if="last_status != 'CLOSED'">Tambah</a>
                              </div> -->
                            </div>
                            <div class="row">
                              <div class="col-sm-10 col-sm-offset-1">
                                
                                <div class="form-group">
                                  <label>Site Pengirim <small>(required)</small></label>
                                  <input name="nama_pengirim" id="nama_pengirim" type="text" class="form-control" placeholder="" value="<?= empty($data) ? "" : $data['nama_pengirim']?>">
                                  <input type="hidden" name="id_pengirim" id="id_pengirim" value="<?= empty($data) ? "" : $data['id_pengirim']?>">
                                </div>
                                <div class="form-group">
                                  <label>Alamat Pengirim <small>(required)</small></label>
                                  <textarea name="alamat_pengirim" id="alamat_pengirim" rows="4" class="form-control required" placeholder="" style="height: 100px;" ><?= empty($data) ? "" : $data['alamat_pengirim']?></textarea>
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
                                  <label>No Handphone </label>
                                  <input name="phone_pengirim" id="phone_pengirim" type="text" class="form-control" value="<?= empty($data) ? "" : $data['hp_pengirim']?>">
                                </div>
                                <div class="form-group">
                                  <label>Attention </label>
                                  <input name="attn_pengirim" id="attn_pengirim" type="text" class="form-control" value="<?= empty($data) ? "" : $data['attn_pengirim']?>">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="card-block">
                            <div class="row b-b-default m-b-20 p-b-5">
                              <div class="col-sm-6" style="font-weight: bold;font-size: 20px;">Penerima</div>
                              <!-- <div class="col-sm-6">
                                <a href="#" class="btn btn-primary btn-mini waves-effect waves-light btnCariPenerima" style="float: right;color: #fff;" v-if="last_status != 'CLOSED'">Cari</a>
                                <a href="#" class="btn btn-primary btn-mini waves-effect waves-light btn-grd-success btnAddPenerima" style="float: right;color: #fff;" v-if="last_status != 'CLOSED'">Tambah</a>
                              </div> -->
                            </div>
                            <div class="row">
                              <div class="col-sm-10 col-sm-offset-1">
                                  <div class="form-group">
                                    <label>Site Penerima <small>(required)</small></label>
                                    <input name="nama_penerima" id="nama_penerima" type="text" class="form-control" placeholder="" value="<?= empty($data) ? "" : $data['nama_penerima']?>" >
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
                                    <label>No Handphone</label>
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
                  <button class="btn btn-inverse btn-outline-inverse" id="btnAdd" v-if="last_status != 'CLOSED'"><i class="icofont icofont-ui-add"></i> Tambah baris</button>
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
                                Nama Barang <button type="button" class="btn" style="border-radius: 50%;width: 20px;height: 20px;padding: 3px;text-align: center;font-size: 10px;margin-left: 5px;" id="btnCreateBrg" @click="modalbarang($event)">
                                  <i class="icofont icofont-ui-add"></i></button>
                              </th>
                              <th>
                                Qty
                              </th>
                              <th>
                                Satuan
                              </th>
                              <th>
                                Berat Kg <span style="color:orange">(isi 0 jika Charter)</span>
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
                                <a href="#" class="btn btn-inverse btn-outline-inverse hidden" onclick="cari_dealer(this)" v-if="last_status != 'CLOSED'">
                                  <i class="icofont icofont-search"></i> Cari
                                </a>
                                <a href="javascript:void(0)" class="btn btn-inverse btn-outline-inverse" onclick="cancel(this)" v-if="last_status != 'CLOSED'"><i class="icofont icofont-trash"></i> Del</a>
                              </td>
                              <td>
                                <select id="id_barang<?=$urut?>" name="id_barang<?=$urut?>" class="form-control">
                                    <option value="">Pilih Barang</option>
                                    <?php 
                                    foreach($barang as $res)
                                    { 
                                      if( empty($row) ? "" : $row['id_barang'] === $res['id_barang']){
                                        echo '<option value="'.$res['id_barang'].'" selected >'.$res['nama_barang'].'</option>';
                                      }else{
                                        echo '<option value="'.$res['id_barang'].'">'.$res['nama_barang'].'</option>';
                                      }
                                    }
                                    ?>
                                </select>
                              </td>
                              <td>
                                <input type="number" id="qty<?=$urut?>" name="qty<?=$urut?>" placeholder="Qty" class="form-control" style="width:100%" value="<?=$row['qty']?>">
                              </td>
                              
                              <td>
                                <input type="text" name="satuan<?=$urut?>" id="satuan<?=$urut?>" class="form-control" value="<?=$row['satuan']?>"/>
                              </td>
                              <td><input type="number" id="kg<?=$urut?>" name="kg<?=$urut?>" placeholder="Kg" class="form-control" style="width:100%" value="<?=$row['kg']?>"></td>
                            </tr>
                            <?php $urut++?>
                          <?php endforeach; ?>

                      </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- <div class="row" id="pengirim">
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
                        <div class="col-sm-6" style="background: linear-gradient(to right, #546D77, #3F5159);color: #fff;">
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
                              <tr>
                                <td colspan="4" class="text-center">Tidak ada data tersedia</td>
                              </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>-->

            <div class="m-t-20" id="moda">
              <h4 class="info-text" style="margin-top: 30px;padding-left: 10px;">Moda Transportasi
              </h4>
              <div class="card z-depth-0">
                <div class="card-header" style="padding: 10px 20px;">
                  <!-- <h4 style="font-size: 2.2rem;font-weight: bold;" v-if="last_status != 'DITERIMA'">
                    <button type="button" id="btnModa" class="btn hor-grd btn-grd-inverse ">Pilih Moda Transportasi</button>
                  </h4> -->
                  <!-- <input type="hidden" name="moda_tran" id="moda_tran" value="<?= empty($data) ? "" : $data['id_moda'] ?>"> -->
                  <input type="hidden" name="jenis_moda" id="jenis_moda">
                  
                </div>
                <div class="card-block panels-wells">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" style="font-weight: bold;">Moda <small>(required)</small></label>
                    <div class="col-sm-10">
                      <select name="moda_tran" id="moda_tran" class="form-control">
                        <option value="">Pilih Moda</option>
                        <?php 
                        foreach($moda_only as $row)
                        { 
                          if( empty($data) ? "" : $data['id_moda'] === $row->id){
                            echo '<option value="'.$row->id.'" selected >'.$row->moda_name.'</option>';
                          }else{
                            echo '<option value="'.$row->id.'">'.$row->moda_name.'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" style="font-weight: bold;">Kategori <small>(required)</small></label>
                    <div class="col-sm-10">
                      <select name="moda_kat" id="moda_kat" class="form-control">
                        
                      </select>
                    </div>
                  </div>
                  
                  <div class="row hidden">
                    <div class="col">
                      <div class="well well-lg">
                        <div class="row" >
                          <div class="col-sm-2">
                            <img src="<?= base_url(); ?>assets/images/kg.png" id="img-moda" class="img-fluid" style="background-color: #fff;height: 110px;width: 130px;">
                          </div>
                          <div class="col-sm-10">
                            <div class="row">
                              <div class="col-sm-7">
                                <input type="hidden" name="text-moda" id="text-moda" >
                              <div style="font-size: 26px;font-weight: bold;" id="t_moda">KG</div>
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
                <div class="card">
                  <div class="card-block">
                    
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">TGL PICKUP</label>
                      <div class="col-sm-4">
                        <input class="form-control" type="date" id="pickup_date" name="pickup_date" value="<?= empty($data) ? "" : $data['pickup_date'] ?>" />
                      </div>
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">WAKTU PICKUP</label>
                      <div class="col-sm-4">
                        <input type="time" class="form-control" id="pickup_time" name="pickup_time" value="<?= empty($data) ? "" : $data['pickup_time'] ?>">
                      </div>
                    </div>
                    <div class="form-group row hidden">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">ALAMAT PICKUP</label>
                      <div class="col-sm-10">
                        <textarea rows="5" cols="5" class="form-control" id="pickup_address" name="pickup_address" placeholder="Masukkan alamat pickup" style="height: auto;" ><?= empty($data) ? "" : $data['pickup_address'] ?></textarea>
                      </div>
                    </div>
                    <div class="form-group row hidden">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">SITE NAME</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="site_name" name="site_name" value="<?= empty($data) ? "" : $data['site_name'] ?>" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">NOMOR KENDARAAN</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nomor_plat" name="nomor_plat" value="<?= empty($data) ? "" : $data['no_kendaraan'] ?>" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">DRIVER / SUPIR</label>
                      <div class="col-sm-10" >
                        <input type="text" class="form-control" id="driver" name="driver" value="<?= empty($data) ? "" : $data['driver'] ?>" >
                      </div>
                    </div>
                    <div class="dp hidden" id="dp-laut">
                  
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="font-weight: bold;">NAMA PELAYARAN</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="pelayaran_no" name="pelayaran_no" placeholder="" value="<?= empty($data) ? "" : $data['no_pelayaran'] ?>">
                        </div>
                      </div>
                      <div class="form-group row hidden">
                        <label class="col-sm-2 col-form-label" style="font-weight: bold;">TGL PELAYARAN</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="date" id="tgl_pelayaran" name="tgl_pelayaran" value="<?= empty($data) ? "" : $data['tgl_pelayaran'] ?>" />
                        </div>
                      </div>
                      <div class="form-group row">
                        
                        <label class="col-sm-2 col-form-label" style="font-weight: bold;">ETD</label>
                        <div class="col-sm-4">
                          <input type="date" class="form-control" id="etd_laut" name="etd_laut" placeholder="" value="<?= empty($data) ? "" : $data['etd'] ?>">
                        </div>

                        <label class="col-sm-2 col-form-label" style="font-weight: bold;">ETA</label>
                        <div class="col-sm-4">
                          <input type="date" class="form-control" id="eta_laut" name="eta_laut" placeholder="" value="<?= empty($data) ? "" : $data['eta'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="dp hidden" id="dp-udara">
               
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="font-weight: bold;">AWB NO</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="awb" name="awb" value="<?= empty($data) ? "" : $data['awb'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="font-weight: bold;">ORIGIN</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="origin" name="origin" value="<?= empty($data) ? "" : $data['origin'] ?>">
                        </div>
                        <label class="col-sm-2 col-form-label" style="font-weight: bold;">DESTINATION</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="dest" name="dest" value="<?= empty($data) ? "" : $data['destination'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="font-weight: bold;">FLIGHT NO</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="flight_no" name="flight_no" value="<?= empty($data) ? "" : $data['flight_no'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="font-weight: bold;">FLIGHT DATE</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="date" id="flight_date" name="flight_date" value="<?= empty($data) ? "" : $data['flight_date'] ?>" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="font-weight: bold;">ETA</label>
                        <div class="col-sm-4">
                          <input type="time" class="form-control" id="eta" name="eta" value="<?= empty($data) ? "" : $data['eta'] ?>">
                        </div>
                        <label class="col-sm-2 col-form-label" style="font-weight: bold;">ETD</label>
                        <div class="col-sm-4">
                          <input type="time" class="form-control" id="etd" name="etd" value="<?= empty($data) ? "" : $data['etd'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">LINK/URL REF</label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-button m-b-0" >

                          <input type="text" class="form-control" id="link" name="link" value="<?= empty($data) ? "" : $data['link'] ?>">
                          <span class="input-group-addon btn btn-grd-inverse" id="btnShowLink" style="border-width: 0;background-color: #01a9ac;">
                            <span class="">Show</span>
                          </span>
                        </div>

                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">AGENT/VENDOR 1</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="agent" name="agent" value="<?= empty($data) ? "" : $data['agent'] ?>">
                      </div>
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">HP AGENT/VENDOR 1</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="agent_hp" name="agent_hp" value="<?= empty($data) ? "" : $data['agent_hp'] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">AGENT/VENDOR 2</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="agent2" name="agent2" value="<?= empty($data) ? "" : $data['agent2'] ?>">
                      </div>
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">HP AGENT/VENDOR 2</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="agent_hp2" name="agent_hp2" value="<?= empty($data) ? "" : $data['agent_hp2'] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">AGENT/VENDOR 3</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="agent3" name="agent3" value="<?= empty($data) ? "" : $data['agent3'] ?>">
                      </div>
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">HP AGENT/VENDOR 3</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="agent_hp3" name="agent_hp3" value="<?= empty($data) ? "" : $data['agent_hp3'] ?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">ARMADA</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="armada" name="armada" value="<?= empty($data) ? "" : $data['armada'] ?>">
                      </div>
                    </div>
                    <div class="form-group row hidden">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">NO. CONTAINER / SHIPPING NAME</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_container" name="no_container" value="<?= empty($data) ? "" : $data['no_container'] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">RECEIVED BY</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="received_by" name="received_by" value="<?= empty($data) ? "" : $data['received_by'] ?>" :disabled="last_status != 'DITERIMA' && last_status != 'DALAM PERJALANAN'">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">RECEIVED DATE</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" id="received_date" name="received_date" value="<?= empty($data) ? "" : $data['received_date'] ?>" v-if="last_status != 'DITERIMA'" :disabled="last_status != 'DITERIMA' && last_status != 'DALAM PERJALANAN'">
                        <input type="text" class="form-control" id="received_date" name="received_date" value="<?= empty($data) ? "" : $data['received_date'] ?>" v-if="last_status == 'DITERIMA'" disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="sub-title" style="color: #2c3e50;">Dokumen Terkait (Foto, Berita Acara, DO/BO,dll)</div>
                      <div class="dropzone" id="dropzone">

                        <div class="dz-message">
                         <h3> Klik atau Drop gambar disini</h3>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div> 
              
            </div>

            <div class="card z-depth-0">
              <div class="card-block panels-wells">
                <div class="row">
                  <h4 class="info-text" style="padding-left: 10px;">Multi Drop
                      <button class="btn btn-inverse btn-outline-inverse" id="btnAddModa"  v-if="last_status != 'CLOSED'"><i class="icofont icofont-ui-add"></i> Tambah</button>
                  </h4>
                  <input type="hidden" id="total-row-multi" name="total-row-multi" value="<?= $totalrowmulti ?>">
                  <table id="ViewTableMulti" class="table table-bordered">
                    <thead class="text-primary thead-color">
                        <tr>
                            <th width="50">
                              No
                            </th>
                            <th width="100">
                              Aksi
                            </th>
                            <th>
                              Rute
                            </th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbody-table-multi">
                      <?php 
                        $urut=1;
                        foreach($data_multi as $row): ?>
                          <tr>
                            <td style="width:1%"><?= $urut ?></td>
                            <td style="width:8%">
                              <input type="hidden" id="id_detail_multi_<?= $urut ?>" name="id_detail_multi_<?= $urut ?>" class="form-control " value="<?= $row['id'] ?>">
                              <input type="hidden" id="deleted_<?= $urut ?>" name="deleted_<?= $urut ?>" value="0">
                              <a href="javascript:void(0)" class="btn hor-grd btn-grd-danger" onclick="cancelMulti(this)" v-if="last_status != 'CLOSED'">
                                <i class="icofont icofont-trash"></i> Del</a>
                            </td>
                            
                            <td>
                              <input type="text" name="aktifitas_<?= $urut ?>" id="aktifitas_<?= $urut ?>" class="form-control" value="<?= $row['rute'] ?>" >
                            </td>

                          </tr>
                          <?php $urut++?>
                        <?php endforeach; ?>
                        
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div id="cost">
              <h4 class="info-text" style="margin-top: 30px;padding-left: 10px;">Biaya Tambahan (Customer)
                <button class="btn btn-inverse btn-outline-inverse" id="btnAddBiaya" v-if="last_status != 'CLOSED'"><i class="icofont icofont-ui-add"></i> Tambah baru</button>
              </h4>
              <div class="card z-depth-0">
                <div class="card-block panels-wells">
                  <div class="row">
                    <div class="col">
                      <div class="well well-lg">
                        <input type="hidden" id="total-row-biaya" name="total-row-biaya" value="<?= $totalrowbiaya ?>">
                        <table id="ViewTableBiaya" class="table table-bordered">
                          <thead class="text-primary thead-color">
                              <tr>
                                  <th width="50">
                                    No
                                  </th>
                                  <th width="100">
                                    Aksi
                                  </th>
                                  <th>
                                    Aktifitas
                                  </th>
                                  <th width="100">
                                    Qty
                                  </th>
                                  <th width="100">
                                    Satuan
                                  </th>
                                  <th width="150">
                                    Harga
                                  </th>
                                  <th>
                                    Total
                                  </th>
                              </tr>
                          </thead>
                          <tbody id="tbody-table-biaya">
                            <?php 
                            $urut=1;
                            foreach($data_biaya as $row): ?>
                              <tr>
                                <td style="width:1%"><?= $urut ?></td>
                                <td style="width:8%">
                                  <input type="hidden" id="id_detail_biaya_<?= $urut ?>" name="id_detail_biaya_<?= $urut ?>" class="form-control " value="<?= $row['id'] ?>">
                                  <input type="hidden" id="deleted_biaya_<?= $urut ?>" name="deleted_biaya_<?= $urut ?>" value="0">
                                  <a href="javascript:void(0)" class="btn btn-inverse btn-outline-inverse" onclick="cancelBiaya(this)" v-if="last_status != 'CLOSED'">
                                    <i class="icofont icofont-trash"></i> Del</a>
                                </td>
                                
                                <td>
                                  <input type="text" name="aktifitas_biaya_<?= $urut ?>" id="aktifitas_biaya_<?= $urut ?>" class="form-control" value="<?= $row['aktifitas'] ?>" >
                                </td>
                                <td>
                                  <input type="number" name="qty_biaya_<?= $urut ?>" id="qty_biaya_<?= $urut ?>" class="form-control" value="<?= $row['qty'] ?>" >
                                </td>
                                <td>
                                  <input type="text" name="satuan_biaya_<?= $urut ?>" id="satuan_biaya_<?= $urut ?>" class="form-control" value="<?= $row['satuan'] ?>" >
                                </td>
                                <td>
                                  <input type="number" name="harga_biaya_<?= $urut ?>" id="harga_biaya_<?= $urut ?>" class="form-control" value="<?= $row['harga'] ?>" >
                                </td>
                                <td>
                                  <input type="number" id="biaya_<?= $urut ?>" name="biaya_<?= $urut ?>" value="<?= $row['biaya'] ?>" class="form-control" readonly>
                                </td> 
                              </tr>
                              <?php $urut++?>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="" id="doc">
              <h4 class="info-text" style="margin-top: 30px;padding-left: 10px;">Dokumen Kembali
              </h4>
              <div class="card z-depth-0">
                <div class="card-block panels-wells">
                  <div class="row">
                    <div class="col">
                      <div class="well well-lg">
                        <div class="card ">
                          <div class="card-block">
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label" style="font-weight: bold;">TGL TERIMA</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="date" id="tgl_terima_doc" name="tgl_terima_doc" :disabled="last_status != 'DITERIMA'" value="<?= empty($data) ? "" : $data['received_doc'] ?>" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label" style="font-weight: bold;">DISERAHKAN ACC</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="date" id="tgl_serah_acc" name="tgl_serah_acc" :disabled="last_status != 'DITERIMA'" value="<?= empty($data) ? "" : $data['sent_acc'] ?>" />
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

            <div class="">
              <h4 class="info-text" style="margin-top: 30px;padding-left: 10px;">Riwayat Status
              </h4>
              <div class="card z-depth-0">
                <div class="card-block panels-wells">
                  <div class="row">
                    <div class="col">
                      <div class="well well-lg">
                        <div class="card">
                          <div class="card-block">
                            <h4 class="info-text" style="padding-left: 0px;font-size: 25px;">Riwayat ini terisi otomatis jika ada perubahan status</h4>
                            <hr>
                            <div class="form-group row" v-if="mode == 'edit' && (last_status == 'PICKUP' || last_status == 'DALAM PERJALANAN')">
                              <label class="col-sm-1 col-form-label" style="font-weight: bold;">Remark</label>
                              <div class="col-sm-5" >
                                <input type="text" class="form-control" id="remark" name="remark" value="" >
                              </div>
                              <label class="col-sm-1 col-form-label" style="font-weight: bold;">Status</label>
                              <div class="col-sm-3" >
                                <input type="text" readonly class="form-control" id="status_history" name="status_history" value="DALAM PERJALANAN" >
                              </div>
                              <div class="col-sm-2">
                                <button type="button" id="btnAddHistory" v-on:click="updateHistory()" class="btn hor-grd btn-grd-inverse btn-block" style="float: right;">Tambah</button>
                              </div>
                            </div>
                            <div class="row">
                              <input type="hidden" id="total-row-history" name="total-row-history" value="0">
                              <table id="ViewTableHist" class="table table-bordered">
                                <thead class="text-primary thead-color">
                                    <tr>
                                        <th width="50">
                                          No
                                        </th>
                                        <th>
                                          Catatan
                                        </th>
                                        <th>
                                          Status
                                        </th>
                                        <th>
                                          Created Time
                                        </th>
                                        <th>
                                          Input By
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-table-hist">
                                  <template v-for="(log, index) in history">
                                    <tr>
                                        <td style="width:1%">{{ (index+1) }}</td>
                                        <td>{{ log.remark }}</td>
                                        <td>{{ log.status }}</td>
                                        <td>{{ log.created_date }}</td>
                                        <td>{{ log.created_by }}</td>
                                    </tr>
                                  </template>
                                  
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-sm-10 col-sm-offset-1" style="margin-top: 10px;">
                <input type="hidden" name="id_rs" id="id_rs" value="<?= empty($data) ? "" : $data['id'] ?>">
                <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >

                <button class="btn btn-block btn-grd-success" id="btn-finish" v-if="last_status != 'CLOSED'"><i class="icofont icofont-save"></i> &nbsp;Simpan</button>
              </div>
            </div>
            <button class="btn btn-block btn-grd-success float" id="btn-finish-float" v-if="last_status != 'CLOSED'">
              <i class="icofont icofont-save"></i></button>
            <!-- <div v-if="mode == 'edit'">
              <h4 class="info-text" style="margin-top: 30px;padding-left: 10px;">Riwayat Pengiriman
                <button type="button" id="btnModa" class="btn hor-grd btn-grd-inverse" style="float: right;">Update Status</button>
              </h4>
              <div class="card z-depth-0">
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
            </div> -->
          </form>

        </div>
      </div>

    </div>
  </div>
</div>

<?php
  $this->load->view($modal); 
?>

