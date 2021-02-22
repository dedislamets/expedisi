<div class="modal fade" id="large-Modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #404E67;color:#fff">
        <h4 class="modal-title jdl" v-if="last_status == 'INPUT'">ATUR PICKUP</h4>
        <h4 class="modal-title jdl" v-if="last_status != 'INPUT'">UPDATE STATUS LOKASI</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formPickup">
          <div class="card">
            <div class="card-block">

              <div id="your-location" class="col-sm-12 <?= ($this->session->userdata('role_id') ==  1 ? "" : "hidden") ?>" style="height: 300px;margin-bottom: 10px;"></div>
              <input type="hidden" name="lat" id="lat">
              <input type="hidden" name="long" id="long">
              <input type="hidden" name="id_rs" id="id_rs" :value="id">

              <div >
                <div class="form-group row" v-if="last_status != 'INPUT'">
                    <label class="col-sm-2 col-form-label" style="font-weight: bold;">STATUS</label>
                    <div class="col-sm-10">
                      <select name="status_update" id="status_update" class="form-control">
                        <option value="DALAM PERJALANAN">DALAM PERJALANAN</option>
                        <option value="DITERIMA" v-if="last_status == 'DALAM PERJALANAN'">DITERIMA</option>
                      </select>
                    </div>
                </div>
                <div class="form-group row" v-if="last_status != 'INPUT'">
                  <label class="col-sm-2 col-form-label" style="font-weight: bold;">REMARK</label>
                  <div class="col-sm-10">
                    <textarea rows="5" cols="5" class="form-control" id="REMARK" name="remark" placeholder="Masukkan catatan anda disini " style="height: auto;" ></textarea>
                  </div>
                </div>
                <div class="form-group row" v-if="status_update == 'DITERIMA'">
                  <label class="col-sm-2 col-form-label" style="font-weight: bold;">DITERIMA OLEH</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="received_by" name="received_by" value="">
                  </div>
                </div>
                <div class="form-group row" v-if="last_status == 'INPUT'">
                  <label class="col-sm-2 col-form-label" style="font-weight: bold;">PICKUP DATE</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="date" id="pickup_date" name="pickup_date" value="<?php echo date('Y-m-d'); ?>" disabled />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" style="font-weight: bold;">PICKUP ADDRESS</label>
                  <div class="col-sm-10">
                    <textarea rows="5" cols="5" class="form-control" id="pickup_address" name="pickup_address" placeholder="Masukkan alamat pickup" style="height: auto;"></textarea>
                  </div>
                </div>
                <div class="form-group row" v-if="last_status == 'INPUT'">
                  <label class="col-sm-2 col-form-label" style="font-weight: bold;">NOMOR KENDARAAN</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nomor_plat" name="nomor_plat" value="">
                  </div>
                </div>
                <div class="form-group row" >
                  <label class="col-sm-2 col-form-label" style="font-weight: bold;">DRIVER / SUPIR / UPDATED BY</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="driver" name="driver" value="">
                  </div>
                </div>

                <div class="form-group" v-if="status_update == 'DITERIMA'">
                  <div class="sub-title">Upload Dokumen Terkait (Foto, Berita Acara, DO/BO,dll)</div>
                  <div class="dropzone" id="dropzone">

                    <div class="dz-message">
                     <h3> Klik atau Drop gambar disini</h3>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
        <button type="button" id="btnSPickup" class="btn btn-primary waves-effect waves-light ">SELESAI</button>
      </div>
    </div>
  </div>
</div>