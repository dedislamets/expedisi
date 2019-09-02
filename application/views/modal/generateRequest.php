<div class="modal fade" id="ModalGenerate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label></label></h4>
      </div>
      <?php echo form_open(site_url("MasterShiftTime/add_group_shift"), array("class" => "form-horizontal", "id" => "form1", "method" => "POST")) ?>
        <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
      <div class="modal-body">
          
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_group" name="id_group" >
        <button type="submit" id="submit_button" class="btn btn-primary">Submit</button>
      </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>