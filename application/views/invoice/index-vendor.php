<style type="text/css">
  #ViewTableBrg td, #ViewTableBrg th {
    padding: .55rem;
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
  .thead-color {
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
        <div class="card-header" style="background-color: #404E67;color:#fff">
          <div class="row">
              <div class="col-xl-10">
                  <h4><?= $title ?></h4>
                  <span>Halaman ini menampilkan data connote yang tersimpan</span>
              </div>
              
              <div class="col-xl-2">
                <div class="status-trans"><?= empty($data) ? "INPUT" : $data['status'] ?></div>
                  <!-- <a href="<?= base_url() ?>connote" class="btn btn-grd-success" ><i class="icofont icofont-ui-add"></i> Tambah baru</a> -->
              </div>
          </div>
        </div>
        <div class="card-block">
          <form id="form-invoice" name="form-wizard" action="" method="" style="padding-top: 20px;">
            <input type="hidden" name="mode" id="mode" value="<?= $mode ?>">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" style="font-weight: bold;">INVOICE NO</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_invoice" name="no_invoice" placeholder="Ketikan No Invoice" value="<?= empty($data) ? "" : $data['no_invoice']?>" :disabled="last_status == 'LUNAS'" >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" style="font-weight: bold;">TANGGAL </label>
                  <div class="col-sm-9">
                    <input class="form-control" type="date" id="tgl_invoice" name="tgl_invoice" value="<?= empty($data) ? "" : $data['tgl_invoice']?>" :disabled="last_status == 'LUNAS'" />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" style="font-weight: bold;">TANGGAL SUBMIT </label>
                  <div class="col-sm-9">
                    <input class="form-control" type="date" id="tgl_submit" name="tgl_submit" value="<?= empty($data) ? "" : $data['tgl_submit_invoice']?>" :disabled="last_status == 'LUNAS'" />
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" style="font-weight: bold;">NO ROUTING</label>
                  <div class="col-sm-9">

                    <div class="input-group input-group-button m-b-0" >

                      <input type="text" class="form-control" id="no_routing" name="no_routing" readonly>
                      <span class="input-group-addon btn btn-grd-inverse" id="btnBrowse" v-if="last_status != 'LUNAS'" style="border-width: 0;background-color: #01a9ac;">
                        <span class="">Browse..</span>
                      </span>
                    </div>
                    <input type="hidden" class="form-control" id="id_routing" name="id_routing" >
                  </div>
                </div>  
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" style="font-weight: bold;">TERM</label>
                  <div class="col-sm-9">
                    <select name="id_term" id="id_term" class="form-control" :disabled="last_status == 'LUNAS'">
                      <?php 
                      foreach($term as $row)
                      { 
                        if( empty($data) ? "" : $data['id_term'] === $row->id){
                          echo '<option value="'.$row->id.'" selected >'.$row->term.'</option>';
                        }else{
                          echo '<option value="'.$row->id.'">'.$row->term.'</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row due" >
                  <label class="col-sm-3 col-form-label" style="font-weight: bold;">DUE DATE </label>
                  <div class="col-sm-9">
                    <input class="form-control" type="date" id="due_date" name="due_date" readonly style="background-color: #4f0c0c;color: #fff;" value="<?= empty($data) ? "" : $data['due_date']?>" />
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row m-l-0 m-r-0">
                <div class="col-sm-6 bg-c-lite-green">
                  <div class="card-block text-white">
                    <div class="row b-b-default m-b-10 p-b-5">
                      <div class="col-sm-4 f-w-600">Pengirim</div>         
                      <div class="col-sm-8">
                        <h3 id="nama_pengirim"></h3>
                      </div>            
                    </div>
                    <div class="row b-b-default m-b-10 p-b-5">
                      <div class="col-sm-4 f-w-600">Origin</div>
                      <div class="col-sm-8">
                        <input type="hidden" name="id_pengirim" id="id_pengirim">
                        <span id="origin"></span>
                      </div>
                    </div>
                    <div class="row b-b-default m-b-10 p-b-5">
                      <div class="col-sm-4 f-w-600">Agent/Vendor</div>        
                      <div class="col-sm-8">
                        <h3 id="vendor" style="font-size: 12pt;"></h3>
                      </div>             
                    </div>
                    <div class="row">
                      <div class="col-sm-4">Pickup</div>
                      <div class="col-sm-8">
                        <h3 id="pickup" style="font-size: 9pt;"></h3>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6" style="background: linear-gradient(to right, #546D77, #3F5159);color: #fff;">
                  <div class="card-block">
                      <div class="row b-b-default m-b-10 p-b-5">
                        <div class="col-sm-6  f-w-600">Penerima</div>
                        <div class="col-sm-6">
                          <!-- <h3 id="attn_penerima"></h3> -->
                          <h3 id="nama_penerima"></h3>
                          <!-- <h5 id="alamat_penerima"></h5> -->
                        </div>
                      </div>
                      <div class="row">
                         <div class="col-sm-6  f-w-600">Project</div>
                        <div class="col-sm-6" id="project"></div>
                      </div>
                      <div class="row">
                         <div class="col-sm-6  f-w-600">Moda</div>
                        <div class="col-sm-6" id="moda"></div>
                      </div>
                      <div class="row">
                         <div class="col-sm-6  f-w-600">Destination</div>
                        <div class="col-sm-6" id="destination"></div>
                      </div>
                      <div class="row">
                         <div class="col-sm-6  f-w-600">SPK</div>
                        <div class="col-sm-6" id="spk"></div>
                      </div>
                  </div>
                </div>
            </div>

            <div class="row" id="barang">
              <h4 class="info-text" style="padding-left: 10px;">
                  <button class="btn btn-grd-invers hidden" id="btnAdd" ><i class="icofont icofont-ui-add"></i> Tambah baru</button>
              </h4>
              <div class="col-sm-12">
                <div class="dt-responsive table-responsive table-brg">
                  <input type="hidden" id="total-row" name="total-row" value="<?= $totalrow ?>">
                  <table id="ViewTableBrg" class="table table-bordered" style="margin-top: 0 !important;width: 100% !important;">
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
                                Qty
                              </th>
                              <th>
                                Satuan
                              </th>
                              <th>
                                Berat Kg
                              </th>
                              <th>
                                Price
                              </th>
                              <th>
                                Subtotal
                              </th>
                          </tr>
                      </thead>
                      <tbody id="tbody-table">
                        
                      </tbody>
                  </table>
                  <h4 class="info-text" style="padding-left: 10px;">Tambahan Biaya
                      <button class="btn btn-grd-invers" id="btnAddBiaya" v-if="last_status != 'LUNAS'" ><i class="icofont icofont-ui-add"></i> Tambah baru</button>
                  </h4>
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
                            <th width="16%">
                              Biaya
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody id="tbody-table-biaya">
                        <tr>
                          <td style="width:1%">1</td>
                          <td style="width:8%">
                            <input type="hidden" id="id_detail_biaya_1" name="id_detail_biaya_1" class="form-control " value="">
                            <a href="javascript:void(0)" class="btn hor-grd btn-grd-danger" onclick="cancelBiaya(this)">
                              <i class="icofont icofont-trash"></i> Del</a>
                          </td>
                          
                          <td>
                            <input type="text" name="aktifitas_1" id="aktifitas_1" class="form-control" value="" >
                          </td>
                          <td>
                            <input type="number" id="biaya_1" name="biaya_1" value="0" class="form-control">
                          </td>
                          
                        </tr>
                    </tbody>
                  </table>
                  <table class="table table-bordered">
                      <!-- <tr class="hidden">
                       
                        <td width="50"></td>
                        <td width="100"></td>
                        <td></td>
                        <td width="16%"></td>
                      </tr> -->
                      
                      <tr>
                        <td style="text-align:right;">Biaya Tambahan</td>
                        <td style="text-align:right;width: 185px;">
                          <input type="text" id="other_cost" name="other_cost" class="form-control " readonly style="text-align:right;" value="<?= empty($data) ? "0" : rupiah($data['cost'])?>">
                        </td>
                      </tr>
                   
                      <tr>
                        <td style="text-align:right;">Total</td>
                        <td style="text-align:right;width: 185px;">
                          <input type="text" id="total" name="total" class="form-control " readonly style="text-align:right;" value="<?= empty($data) ? "0" : rupiah($data['total'])?>">
                        </td>
                      </tr>
                  </table>
                </div>
              </div>
            </div>
            

            <div class="row">
              <div class="col-sm-10 col-sm-offset-1" style="margin-top: 10px;">
                <input type="hidden" name="id_invoice" id="id_invoice" value="<?= empty($data) ? "" : $data['id'] ?>">
                <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >

                <button class="btn btn-block btn-grd-success" id="btn-finish" v-if="last_status != 'LUNAS'">Simpan</button>
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

