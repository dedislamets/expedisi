<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Rest</h4>
      </div>
      <?php echo form_open(site_url("WorkingCalender/add_event"), array("class" => "form-horizontal", "id" => "form1", "method" => "POST")) ?>
        <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" > 
        <div class="modal-body">
            
            <div class="table-responsive" id="tblPartisipant">
                <div class="table-header">
                Rest &nbsp;&nbsp;
                <button class="btn btn-white btn-yellow btn-sm pull-right" id="btnAddParticipant" style="margin-top: 5px;    margin-right: 10px;">
                      <i class="ace-icon fa fa-plus align-top bigger-125"></i>&nbsp;Add
                </button>
              </div>
              <table id="ViewTable" class="table table-striped table-bordered table-hover" style="width: 100%">
                <thead>
                  <tr>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Total Rest</th>
                    <th>Ded. WOrking Hour</th>
                    <th>Rest For</th> 
                    <th>Action</th> 
                  </tr>
                </thead>
                <tbody>                                    
                </tbody>
              </table>
            </div>
           
        </div>
        <div class="modal-footer">        
          
        </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalGroupShift" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><label id="lbl-title-group"></label> <label>Group Shift</label></h4>
      </div>
      <?php echo form_open(site_url("MasterShiftTime/add_group_shift"), array("class" => "form-horizontal", "id" => "form1", "method" => "POST")) ?>
        <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
      <div class="modal-body">
          <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading">Group Shift Name</label>
            <div class="col-md-8 ui-front">
                <input type="text" class="form-control" name="name" value="" id="name" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_group" name="id_group" >
        <button type="submit" id="submit_button" class="btn btn-primary">Submit</button>
      </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalShift" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><label id="lbl-title-shift"></label> <label> Shift</label></h4>
      </div>
      <?php echo form_open(site_url("MasterShiftTime/add_shift"), array("class" => "form-horizontal", "id" => "form1", "method" => "POST")) ?>
        <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
      <div class="modal-body">
          <div class="form-group">
            <label class="col-md-3 control-label no-padding-right">Code Shift</label>
            <div class="col-md-8 ui-front">
                <input type="text" class="form-control" name="shift_code" value="" id="shift_code" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label no-padding-right">Shift Name</label>
            <div class="col-md-8 ui-front">
                <input type="text" class="form-control" name="shift_name" value="" id="shift_name" required>
            </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="blood">Shift</label>
              <div class="col-sm-8">
                <select class="chosen-select form-control" id="shift" name="shift">
                  <?php 
                  foreach($group_shift as $row)
                  { 
                    echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                  }?>
                </select>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="blood">Shift Type</label>
              <div class="col-sm-8">
                <select class="chosen-select form-control" id="shift_type" name="shift_type">
                  <?php 
                  foreach($shift_type as $row)
                  { 
                    echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                  }?>
                </select>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="blood">Day Type</label>
              <div class="col-sm-8">
                <select class="chosen-select form-control" id="day_type" name="day_type">
                  <?php 
                  foreach($day_type as $row)
                  { 
                    echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                  }?>
                </select>
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="Official">Status Holiday</label>
            <div class="col-sm-2">
              <label style="padding-top: 10px;">
                <input id="isHoliday" name="isHoliday" class="ace ace-switch" type="checkbox" />
                <span class="lbl"></span>
              </label>
            </div>
            <label class="col-sm-2 control-label no-padding-right"> OT Auto</label>
            <div class="col-sm-4">
              <input type="number" id="OTAuto" name="OTAuto" placeholder="" value="0" class="form-control" />
            </div>
          </div>
          
          <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="blood">OT Validation</label>
              <div class="col-sm-8">
                <select class="chosen-select form-control" id="otVal" name="otVal">
                  <?php 
                  foreach($ot as $row)
                  { 
                    echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                  }?>
                </select>
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="Official">Late Minus OT</label>
            <div class="col-sm-2">
              <label style="padding-top: 10px;">
                <input id="LMO" name="LMO" class="ace ace-switch" type="checkbox" />
                <span class="lbl"></span>
              </label>
            </div>
            <label class="col-sm-3 control-label no-padding-right" for="Official">Early Out Minus OT</label>
            <div class="col-sm-2">
              <label style="padding-top: 10px;">
                <input id="EOMO" name="EOMO" class="ace ace-switch" type="checkbox" />
                <span class="lbl"></span>
              </label>
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

<div class="modal fade" id="ModalStandart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><label id="lbl-title-standart"></label> <label> Master Time</label></h4>
      </div>
      <?php echo form_open(site_url("MasterShiftTime/add_time"), array("class" => "form-horizontal", "id" => "form1", "method" => "POST")) ?>
        <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
      <div class="modal-body">
          <div class="form-group">
            <label class="col-md-3 control-label no-padding-right">Code Shift</label>
            <div class="col-md-9 ui-front">
                <input type="text" class="form-control" name="shift_code_2" value="" id="shift_code_2" required readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label no-padding-right">Shift Name</label>
            <div class="col-md-9 ui-front">
                <input type="text" class="form-control" name="shift_name_2" value="" id="shift_name_2" required readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label no-padding-right">Day Name</label>
            <div class="col-md-9 ui-front">
                <input type="text" class="form-control" name="day_name" value="" id="day_name" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right">Return OT Auto</label>
            <div class="col-sm-3">
              <input type="number" id="ROTAuto" name="ROTAuto" placeholder="" value="0" class="form-control" />
            </div>
            <label class="col-sm-3 control-label no-padding-right">Total Hour</label>
            <div class="col-sm-3">
              <input type="number" id="TH" name="TH" placeholder="" value="0" class="form-control" />
            </div>
          </div>
      
          
          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="Official">Late OT Mandatory</label>
            <div class="col-sm-3">
              <div class="input-group bootstrap-timepicker">
                <input id="mandat" name="mandat" type="text" class="form-control timepicker1" />
                <span class="input-group-addon">
                  <i class="fa fa-clock-o bigger-110"></i>
                </span>
              </div>
            </div>
            <label class="col-sm-3 control-label no-padding-right" for="Official">Early OT Mandatory</label>
            <div class="col-sm-3">
              <div class="input-group bootstrap-timepicker">
                <input id="mandat1" name="mandat1" type="text" class="form-control timepicker1" />
                <span class="input-group-addon">
                  <i class="fa fa-clock-o bigger-110"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="Official">IN</label>
            <div class="col-sm-3">
              <div class="input-group bootstrap-timepicker">
                <input id="in" name="in" type="text" class="form-control timepicker1" />
                <span class="input-group-addon">
                  <i class="fa fa-clock-o bigger-110"></i>
                </span>
              </div>
            </div>
            <label class="col-sm-3 control-label no-padding-right" for="Official">Out</label>
            <div class="col-sm-3">
              <div class="input-group bootstrap-timepicker">
                <input id="out" name="out" type="text" class="form-control timepicker1" />
                <span class="input-group-addon">
                  <i class="fa fa-clock-o bigger-110"></i>
                </span>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_time" name="id_time" >
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalWorkingHour" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width: 900px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><label id="lbl-title-working"></label> <label> Setting Allowance</label></h4>
      </div>
      <?php echo form_open(site_url("MasterShiftTime/add_group_shift"), array("class" => "form-horizontal", "id" => "form1", "method" => "POST")) ?>
        <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
      <div class="modal-body">
          <div class="tabbable">
            <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
              <li class="take-all-space-you-can active">
                <a data-toggle="tab" href="#home4" aria-expanded="true">Attendence Allowance By Class</a>
              </li>

              <li class="take-all-space-you-can">
                <a data-toggle="tab" href="#profile4" aria-expanded="false">Shift Allowance By Class</a>
              </li>
              <li class="take-all-space-you-can">
                <a data-toggle="tab" href="#overtime" aria-expanded="false">Component Overtime</a>
              </li>
            </ul>
            <div class="tab-content" style="padding-bottom: 0">
              <div id="home4" class="tab-pane active">
                <div style="background-color: darkgray;color: #fff;padding: 10px;" class="clearfix">
                  <label class="col-md-1">Class</label>
                  <div class="col-md-5 ">

                    <select class="chosen-select form-control" id="class_allow" name="class_allow">
                      <option value="0"> - </option>
                      <?php 
                      foreach($class as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
                  <div class="pull-right">
                    <a href="javascript:" class='btn btn-sm btn-white btn-success' id="btnAddAllowanceAttendance"><i class='ace-icon fa fa-plus'></i></a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table id="tabel-attendence-allowance" class="table table-striped table-bordered table-hover" style="margin-bottom: 0" style="width: 100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Total Absence</th>
                        <th>Allowance</th>
                        <th>Start Date</th>
                        <th>End Date</th> 
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>    
                                               
                    </tbody>
                  </table>
                </div>
                <!-- <h3 style="background-color: darkgray;color: #fff;padding: 10px;">Calculation Method</h3>
                <table id="tabel-schedule" class="table table-striped table-bordered table-hover" style="margin-bottom: 0" style="width: 100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Divider</th>
                        <th>Multiplier</th>
                        <th>Start Date</th>
                        <th>End Date</th> 
                        <th>Remark</th>
                      </tr>
                    </thead>
                    <tbody>    
                        <tr>
                          <td colspan="6" style="text-align: center;">No Data</td>
                        </tr>                          
                    </tbody>
                  </table> -->
              </div>
              <div id="profile4" class="tab-pane">
                <div style="background-color: darkgray;color: #fff;padding: 10px;" class="clearfix">
                  <label class="col-md-1">Class</label>
                  <div class="col-md-5 ">

                    <select class="chosen-select form-control" id="class_allow_2" name="class_allow_2">
                      <option value="0"> - </option>
                      <?php 
                      foreach($class as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
                  <div class="pull-right">
                    <button type="button" class='btn btn-sm btn-white btn-success' id="btnAddAllowanceClass"><i class='ace-icon fa fa-plus'></i></button>
                  </div>
                </div>
                <div class="table-responsive">
                  <table id="tabel-class-allowance" class="table table-striped table-bordered table-hover" style="margin-bottom: 0" style="width: 100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Shift Name</th>
                        <th>Allowance</th>
                        <th>Start Date</th>
                        <th>End Date</th> 
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>    
                                               
                    </tbody>
                  </table>
                </div>
              </div>
              <div id="overtime" class="tab-pane">
                <div style="background-color: darkgray;color: #fff;padding: 10px;" class="clearfix">
                  <label class="col-md-2">Working Status</label>
                  <div class="col-md-5 ">

                    <select class="chosen-select form-control" id="working_status" name="working_status">
                      <option value="0"> - </option>
                      <?php 
                      foreach($working_status as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->IsName.'</option>';
                      }?>
                    </select>
                  </div>
                  <div class="pull-right">
                    <button type="button" class='btn btn-sm btn-white btn-success' id="btnAddOvertime"><i class='ace-icon fa fa-plus'></i></button>
                  </div>
                </div>
                <div class="table-responsive">
                  <table id="tbl-working_status" class="table table-striped table-bordered table-hover" style="margin-bottom: 0" style="width: 100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Component Salary</th>
                        <th>Start Date</th>
                        <th>End Date</th> 
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>    
                                               
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>
      
      <?php echo form_close() ?>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalAttendanceAllowance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><label id="lbl-title-allow"></label> Attendance Allowance</h4>
      </div>
      <form id="form-input-allowance-attendance" class="form-horizontal" role="form">
        <div class="modal-body">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">Class Type</label>
                <div class="col-sm-8">
                  <select class="chosen-select form-control" id="kelas" name="kelas">
                    <?php 
                    foreach($class as $row)
                    { 
                      echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                    }?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right">Total Absence</label>
              <div class="col-sm-8">
                <input type="number" id="total_absen" name="total_absen" placeholder="" value="0" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right">Allowance</label>
              <div class="col-sm-8">
                <input type="number" style="text-align: right;" id="allowance_attendance" name="allowance_attendance" placeholder="" value="0" class="form-control" />
              </div>
            </div>
            
            <div class="form-group">
              <label for="p-in" class="col-sm-3 control-label no-padding-right">Start Date</label>
              <div class="col-sm-4">
                  <div class="input-group">
                    <input id="start_date" name="start_date" type="text" class="form-control date-picker" required />
                    <span class="input-group-addon">
                      <i class="fa fa-clock-o bigger-110"></i>
                    </span>
                  </div>
              </div>
              
            </div> 
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right">End Date</label>
              <div class="col-sm-4">
                  <div class="input-group">
                    <input id="end_date" name="end_date" type="text" class="form-control date-picker"  />
                    <span class="input-group-addon">
                      <i class="fa fa-clock-o bigger-110"></i>
                    </span>
                  </div>
              </div>
            </div>        
        </div>
        <div class="modal-footer">
          <input type="hidden" id="id_allow" name="id_allow" >
          <button type="button" class="btn btn-primary" id="btnSaveAllowance">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalAttendanceClass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><label id="lbl-title-allow_class"></label> Attendance Class</h4>
      </div>
      <form id="form-input-allowance-class" class="form-horizontal" role="form">
        <div class="modal-body">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">Class Type</label>
                <div class="col-sm-8">
                  <select class="chosen-select form-control" id="kelas_class" name="kelas_class">
                    <?php 
                    foreach($class as $row)
                    { 
                      echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                    }?>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">Shift</label>
                <div class="col-sm-8">
                  <select class="chosen-select form-control" id="shift_class" name="shift_class">
                    <?php 
                    foreach($master_shift as $row)
                    { 
                      echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                    }?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right">Allowance</label>
              <div class="col-sm-8">
                <input type="number" style="text-align: right;" id="allowance_attendance_class" name="allowance_attendance_class" placeholder="" value="0" class="form-control" />
              </div>
            </div>
            
            <div class="form-group">
              <label for="p-in" class="col-sm-3 control-label no-padding-right">Start Date</label>
              <div class="col-sm-4">
                  <div class="input-group">
                    <input id="start_date_class" name="start_date_class" type="text" class="form-control date-picker" required />
                    <span class="input-group-addon">
                      <i class="fa fa-clock-o bigger-110"></i>
                    </span>
                  </div>
              </div>
              
            </div> 
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right">End Date</label>
              <div class="col-sm-4">
                  <div class="input-group">
                    <input id="end_date_class" name="end_date_class" type="text" class="form-control date-picker"  />
                    <span class="input-group-addon">
                      <i class="fa fa-clock-o bigger-110"></i>
                    </span>
                  </div>
              </div>
            </div>        
        </div>
        <div class="modal-footer">
          <input type="hidden" id="id_att_class" name="id_att_class" >
          <button type="button" class="btn btn-primary" id="btnSaveAttClass">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalOvertime" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><label id="lbl-title-overtime"></label> Overtime</h4>
      </div>
      <form id="form-input-overtime" class="form-horizontal" role="form">
        <div class="modal-body">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">Class Type</label>
                <div class="col-sm-8">
                  <select class="chosen-select form-control" id="select_working" name="select_working">
                    <?php 
                    foreach($working_status as $row)
                    { 
                      echo '<option value="'.$row->Recnum.'">'.$row->IsName.'</option>';
                    }?>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">Allowance</label>
                <div class="col-sm-8">
                  <select class="chosen-select form-control" id="component_salary" name="component_salary">
                    <?php 
                    foreach($component_salary as $row)
                    { 
                      echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                    }?>
                  </select>
                </div>
            </div>
            
            <div class="form-group">
              <label for="p-in" class="col-sm-3 control-label no-padding-right">Start Date</label>
              <div class="col-sm-4">
                  <div class="input-group">
                    <input id="start_date_overtime" name="start_date_overtime" type="text" class="form-control date-picker" required />
                    <span class="input-group-addon">
                      <i class="fa fa-clock-o bigger-110"></i>
                    </span>
                  </div>
              </div>
              
            </div> 
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right">End Date</label>
              <div class="col-sm-4">
                  <div class="input-group">
                    <input id="end_date_overtime" name="end_date_overtime" type="text" class="form-control date-picker"  />
                    <span class="input-group-addon">
                      <i class="fa fa-clock-o bigger-110"></i>
                    </span>
                  </div>
              </div>
            </div>        
        </div>
        <div class="modal-footer">
          <input type="hidden" id="id_overtime" name="id_overtime" >
          <button type="button" class="btn btn-primary" id="btnSaveOvertime">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

