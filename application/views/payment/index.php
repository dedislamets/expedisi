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
              <div class="col-xl-9">
                  <h4><?= $title ?> <a href="<?= base_url() ?>listpayment"> Back </a></h4>
                  <span>Halaman ini menampilkan data connote yang tersimpan</span>
              </div>
              <div class="col-xl-3" >
                <a v-if="mode == 'edit'" href="<?= base_url() ?>cetak/payment?id=<?= empty($data) ? "" : $data['id'] ?>" target="_blank" id="btnTracking" class="btn btn-block hor-grd btn-grd-success">  <i class="icofont icofont-print" ></i>Cetak Kwitansi</a>

              </div>
          </div>
        </div>
        <div class="card-block">
          <form id="form-invoice" name="form-wizard" action="" method="" style="padding-top: 20px;">
            <input type="hidden" name="mode" id="mode" value="<?= $mode ?>">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" style="font-weight: bold;">NO</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_payment" name="no_payment" placeholder="Ketikan No Invoice" value="<?= empty($data) ? $no_payment : $data['no_payment'] ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" style="font-weight: bold;">TANGGAL </label>
                  <div class="col-sm-9">
                    <input class="form-control" type="date" id="tgl_payment" name="tgl_payment" value="<?= empty($data) ? "" : $data['tgl_payment'] ?>" />
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" style="font-weight: bold;">TIPE</label>
                  <div class="col-sm-9">
                    <select name="type_payment" id="type_payment" class="form-control" :disabled="mode == 'edit'">
                     <option value="Customer" <?= empty($data) ? "" : ($data['type_payment'] == "Customer" ? "selected" : "") ?>>Invoice Customer</option>
                     <option value="Vendor" <?= empty($data) ? "" : ($data['type_payment'] == "Vendor" ? "selected" : "") ?>>Invoice Vendor/Agent</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" style="font-weight: bold;">NO INVOICE</label>
                  <div class="col-sm-9">

                    <div class="input-group input-group-button m-b-0" >

                      <input type="text" class="form-control" id="no_invoice" name="no_invoice" value="<?= empty($data) ? "" : $data['no_invoice'] ?>" readonly>
                      <span class="input-group-addon btn btn-grd-inverse" id="btnBrowse" style="border-width: 0;background-color: #01a9ac;" v-if="mode == 'new'">
                        <span class="">Browse..</span>
                      </span>
                    </div>
                    <input type="hidden" class="form-control" id="id_invoice" name="id_invoice" >
                  </div>
                </div>  
              </div>
            </div>
            
            <!-- <div class="row m-l-0 m-r-0">
                <div class="col-sm-6 bg-c-lite-green">
                  <div class="card-block text-white">
                    <div class="row b-b-default m-b-20 p-b-5">
                      <div class="col-sm-6 f-w-600">Pengirim</div>
                      <div class="col-sm-6">
                          <h3 id="nama_pengirim"></h3>
                        </div>
                    </div>
   
                    <div class="row">
                       <div class="col-sm-6  f-w-600">Origin </div>
                       <div class="col-sm-6" id="origin"></div>
                    </div>
                    <div class="row">
                       <div class="col-sm-6  f-w-600">Vendor/Agent </div>
                       <div class="col-sm-6" id="vendor"></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6" style="background: linear-gradient(to right, #546D77, #3F5159);color: #fff;">
                  <div class="card-block">
                      <div class="row b-b-default m-b-10 p-b-5">
                        <div class="col-sm-6  f-w-600">Penerima</div>
                        <div class="col-sm-6">
                          <h3 id="nama_penerima"></h3>
                        </div>
                      </div> 
                      <div class="row">
                          <div class="col-sm-6  f-w-600">Destination</div>
                          <div class="col-sm-6" id="destination"></div>
                      </div>
                  </div>
                </div>
            </div> -->

            <div class="row" id="barang">
              <div class="col-sm-12">
                <div class="dt-responsive table-responsive table-brg">
                  <table class="table table-bordered">
                      <tr class="hidden">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td width="16%"></td>
                      </tr>
                      <tr>
                        <td rowspan="4" colspan="6">
                          <h4>Catatan Pembayaran :</h4>
                          <textarea rows="8" cols="5" class="form-control" id="note" name="note" placeholder="Masukkan Bank/No rekening jika metode transfer" style="height: auto;"><?= empty($data) ? "" : $data['remark']?></textarea>
                        </td>
                        <td style="text-align:right;" width="16%">Total Tagihan</td>
                        <td width="16%">
                          <input type="text" id="label_subtotal" name="label_subtotal" class="form-control " readonly style="text-align:right;" value="<?= empty($data) ? "0" : rupiah($data['total_payment'])?>">
                          <input type="hidden" id="subtotal" name="subtotal" class="form-control " value="<?= empty($data) ? "0" : $data['total_payment'] ?>">
                        </td>
                      </tr>
                      <tr>
                        <td style="text-align:right;">Metode</td>
                        <td>
                          <select name="metode_payment" id="metode_payment" class="form-control">
                            <option value="Cash" <?= empty($data) ? "" : ($data['metode_payment'] == "Cash" ? "selected" : "") ?>>Cash</option>
                            <option value="Transfer" <?= empty($data) ? "" : ($data['metode_payment'] == "Transfer" ? "selected" : "") ?>>Transfer</option>
                          </select>
                        </td>
                      </tr>

                      <tr>
                        <td style="text-align:right;">Di Bayar</td>
                        <td style="text-align:right;">
                          <input type="text" id="dibayar" name="dibayar" class="form-control " style="text-align:right;" value="<?= empty($data) ? "0" : $data['dibayar'] ?>" >
                        </td>
                      </tr>
                  </table>
                </div>
              </div>
            </div>
            

            <div class="row">
              <div class="col-sm-10 col-sm-offset-1" style="margin-top: 10px;">
                <input type="hidden" name="id_payment" id="id_payment" value="<?= empty($data) ? "" : $data['id'] ?>">
                <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >

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
