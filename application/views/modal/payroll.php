<div class="modal fade" id="ModalFind" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width: 1000px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><label id="lbl-title-process"></label> <label> Find Employee</label></h4>
      </div>
      <form id="ProcessForm" name ="Form" class="grab form-horizontal" role="form">
        <div class="modal-body">
            <div class="col-sm-12" style="width: 100%" id="box-iframe">
              <iframe id="iframe" src="" style="width: 100%" scrolling="yes"></iframe>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
          <div class="col-sm-10">
            
          </div>
          <div class="col-sm-2 no-padding">
            <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
            <input type="hidden" id="txtSelected" name="txtSelected" />
            <button type="button" id="btnFind" class="btn btn-primary btn-block"><i class="fa fa-search"></i>&nbsp;&nbsp;Find</button>
          </div>
        </div>
    </div>
  </div>
</div>