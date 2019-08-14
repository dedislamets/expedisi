<div class="modal fade" id="ModalAttendance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header table-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><label id="lbl-title-attend"></label> <label> Attendance</label></h4>
      </div>
      <?php echo form_open(site_url("MasterShiftTime/add_shift"), array("class" => "form-horizontal", "id" => "form1", "method" => "POST")) ?>
        <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
      <div class="modal-body">
          <div class="form-group" >
            <label class="col-md-3 control-label no-padding-right">Date</label>
            <div class="col-md-8 ui-front">
                <input type="text" class="form-control" name="date_attendance_1" value="" id="date_attendance_1" readonly style="text-align: center;">
                <input type="hidden" class="form-control" name="date_attendance" value="" id="date_attendance">
            </div>
          </div>
          <div class="widget-box">
            <div class="widget-header"><h4 class="widget-title">Data Attendance</h4></div>
            <div class="widget-body">
                <div class="form-group" style="margin-top: 10px">
                    <label class="col-sm-3 control-label no-padding-right" for="blood">Shift</label>
                    <div class="col-sm-8">
                      <select class="chosen-select form-control" id="shift" name="shift">
                        <?php 
                        foreach($master_shift as $row)
                        { 
                          echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                        }?>
                      </select>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <label class="col-sm-3 control-label no-padding-right">Type</label>
                    <div class="col-sm-8">
                      <select class="chosen-select form-control" id="type" name="type">
                        <?php 
                        foreach($absen_type as $row)
                        { 
                          echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                        }?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" >IN</label>
                  <div class="col-sm-3">
                    <div class="input-group bootstrap-timepicker">
                      <input id="in_s" name="in_s" type="text" class="form-control timepicker1" readonly />
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o bigger-110"></i>
                      </span>
                    </div>
                  </div>
                  <label class="col-sm-1 control-label no-padding-right" >Actual</label>
                  <div class="col-sm-3">
                    <div class="input-group bootstrap-timepicker">
                      <input id="in" name="in" type="text" class="form-control timepicker1" />
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o bigger-110"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" >Out</label>
                  <div class="col-sm-3">
                    <div class="input-group bootstrap-timepicker">
                      <input id="out_s" name="out_s" type="text" class="form-control timepicker1" readonly />
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o bigger-110"></i>
                      </span>
                    </div>
                  </div>
                  <label class="col-sm-1 control-label no-padding-right" >Actual</label>
                  <div class="col-sm-3">
                    <div class="input-group bootstrap-timepicker">
                      <input id="out" name="out" type="text" class="form-control timepicker1" />
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o bigger-110"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right">Desc</label>
                  <div class="col-sm-8">
                    <textarea class="form-control limited" id="form-field-9" maxlength="250"></textarea>
                  </div>
                </div>
            </div>
          </div>
          <div class="widget-box">
            <div class="widget-header"><h4 class="widget-title">Permission</h4></div>
            <div class="widget-body">
                <div class="form-group" style="margin-top: 10px">
                    <label class="col-sm-3 control-label no-padding-right" for="blood">Permit Type</label>
                    <div class="col-sm-8">
                      <select class="chosen-select form-control" id="permit_type" name="permit_type">
                        <?php 
                        foreach($permit_type as $row)
                        { 
                          echo '<option value="'.$row->Recnum.'">'.$row->Reason.'</option>';
                        }?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" >From</label>
                  <div class="col-sm-3">
                    <div class="input-group bootstrap-timepicker">
                      <input id="from_permit" name="from_permit" type="text" class="form-control timepicker1" />
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o bigger-110"></i>
                      </span>
                    </div>
                  </div>
                  <label class="col-sm-1 control-label no-padding-right" >To</label>
                  <div class="col-sm-3">
                    <div class="input-group bootstrap-timepicker">
                      <input id="to_permit" name="to_permit" type="text" class="form-control timepicker1" />
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o bigger-110"></i>
                      </span>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right">Desc</label>
                  <div class="col-sm-8">
                    <textarea class="form-control limited" id="form-field-9" maxlength="250"></textarea>
                  </div>
                </div>
            </div>
          </div>
          <div class="widget-box">
            <div class="widget-header"><h4 class="widget-title">Overtime</h4></div>
            <div class="widget-body">

                <div class="form-group" style="margin-top: 10px">
                  <label class="col-sm-3 control-label no-padding-right" >Early From</label>
                  <div class="col-sm-3">
                    <div class="input-group bootstrap-timepicker">
                      <input id="from_permit" name="early_from" type="text" class="form-control timepicker1" />
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o bigger-110"></i>
                      </span>
                    </div>
                  </div>
                  <label class="col-sm-1 control-label no-padding-right" >To</label>
                  <div class="col-sm-3">
                    <div class="input-group bootstrap-timepicker">
                      <input id="to_permit" name="early_to" type="text" class="form-control timepicker1" />
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o bigger-110"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" >Return From</label>
                  <div class="col-sm-3">
                    <div class="input-group bootstrap-timepicker">
                      <input id="from_permit" name="return_from" type="text" class="form-control timepicker1" />
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o bigger-110"></i>
                      </span>
                    </div>
                  </div>
                  <label class="col-sm-1 control-label no-padding-right" >To</label>
                  <div class="col-sm-3">
                    <div class="input-group bootstrap-timepicker">
                      <input id="to_permit" name="return_to" type="text" class="form-control timepicker1" />
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o bigger-110"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" >Holiday From</label>
                  <div class="col-sm-3">
                    <div class="input-group bootstrap-timepicker">
                      <input id="from_permit" name="holiday_from" type="text" class="form-control timepicker1" />
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o bigger-110"></i>
                      </span>
                    </div>
                  </div>
                  <label class="col-sm-1 control-label no-padding-right" >To</label>
                  <div class="col-sm-3">
                    <div class="input-group bootstrap-timepicker">
                      <input id="to_permit" name="holiday_to" type="text" class="form-control timepicker1" />
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o bigger-110"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right">Desc</label>
                  <div class="col-sm-8">
                    <textarea class="form-control limited" id="form-field-9" maxlength="250"></textarea>
                  </div>
                </div>
            </div>
          </div>
          <div class="widget-box">
            <div class="widget-header"><h4 class="widget-title">Adjustment</h4></div>
            <div class="widget-body">
              <div class="form-group" style="margin-top: 10px">
                <label class="col-sm-3 control-label no-padding-right">Real OT</label>
                <div class="col-sm-8">
                  <input type="number" id="real_ot" name="real_ot" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">Point OT</label>
                <div class="col-sm-8">
                  <input type="number" id="point_ot" name="point_ot" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">Adjust(+)</label>
                <div class="col-sm-8">
                  <input type="number" id="adjust_plus" name="adjust_plus" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">Adjust(-)</label>
                <div class="col-sm-8">
                  <input type="number" id="adjust_min" name="adjust_min" class="form-control" />
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_shift" name="id_shift" >
        <input type="button" id="btnDelete" class="btn btn-danger" value="Delete">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalProcess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><label id="lbl-title-process"></label> <label> Daily Process</label></h4>
      </div>
      <form id="ProcessForm" name="Form" class="grab form-horizontal" role="form" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="Sort">Periode</label>
                    <div class="col-sm-4 ">
                      <div class="input-group">
                        <input class="form-control date-picker" id="periode_start" name="periode_start" type="text" data-date-format="dd-mm-yyyy" />
                        <span class="input-group-addon">
                          <i class="fa fa-calendar bigger-110"></i>
                        </span>
                      </div>
                    </div>
                    <label class="col-sm-1 control-label ">To</label>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <input class="form-control date-picker" id="periode_end" name="periode_end" type="text" data-date-format="dd-mm-yyyy" />
                        <span class="input-group-addon">
                          <i class="fa fa-calendar bigger-110"></i>
                        </span>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label no-padding-right" for="Sort">Shift</label>
                  <div class="col-sm-8 ">
                    <select class="chosen-select form-control" id="shift_type" name="shift_type">
                      <option value="0"> - </option>
                      <?php 
                      foreach($master_shift as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label no-padding-right" for="Sort">Location</label>
                  <div class="col-sm-8 ">
                    <select class="chosen-select form-control" id="location" name="location">
                      <option value="0"> - </option>
                      <?php 
                      foreach($location as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                      }?>
                    </select>
                  </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
          <div class="col-sm-10">
            <!-- <div class="progress pos-rel" id="progressbar" role="progressbar" data-percent="66%" style="display: none;">
              <div class="progress-bar" style="width:66%;"></div>
            </div> -->
            <div class="progress">
              <div id="bulk-action-progbar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width:1%">                 
              </div>
            </div>
            <!-- <div class="progress">
                <div class="progress-bar active" id="progressbar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span class="sr-only">0% Complete</span>
                </div>
            </div> -->
            
          </div>
          <div class="col-sm-2 no-padding">
            <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
            <button type="submit" class="btn btn-primary btn-block">Process</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

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