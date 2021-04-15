<style type="text/css">
  .card-content{
    padding: 15px;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Setup</h4>
      </div>
      <div class="card-content" >
        <?php echo $this->session->flashdata('message'); ?>
        <form method="post" action="<?php echo base_url() ?>setup/simpan" class="form-horizontal">
          <fieldset>
            <div class="form-group">
              <label class="col-sm-2 control-label">Prefix Invoice</label>
              <div class="col-sm-10">
                <input type="text" id="prefix_invoice" name="prefix_invoice" class="form-control" value="<?php echo $setup[0]->prefix_invoice ?>">
                <!-- <span class="help-block">Untuk menentukan jangka waktu berapa hari password akan expired</span> -->
              </div>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group">
              <label class="col-sm-2 control-label">Start Invoice</label>
              <div class="col-sm-10">
                <input type="text" id="start_invoice" name="start_invoice" class="form-control" value="<?php echo $setup[0]->start_invoice ?>">
                <!-- <span class="help-block">Untuk menentukan jangka waktu berapa hari pengguna akan dikirimkan email notifikasi</span> -->
              </div>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tentukan Invoice</label>
              <div class="col-sm-10">
                <input type="text" id="tentukan_invoice" name="tentukan_invoice" class="form-control" value="<?php echo $setup[0]->tentukan_invoice ?>">
                <!-- <span class="help-block">Untuk menentukan jangka waktu berapa hari pengguna akan dikirimkan email notifikasi</span> -->
              </div>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group">
              <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
              <button type="submit" class="btn btn-fill btn-info" style="margin-left: 10px">Submit</button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>  <!-- end card -->
  </div> <!-- end col-md-12 -->
</div>