<div class="modal fade" id="ModalSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><label id="lbl-title-pattern"></label> Schedule Pattern</h4>
      </div>
      <?php echo form_open(site_url("ScheduleGroup/add_schedule"), array("class" => "form-horizontal", "id" => "form1", "method" => "POST")) ?>
        <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
      <div class="modal-body">
          <div class="form-group">
            <label class="col-md-2 control-label no-padding-right">Code</label>
            <div class="col-md-10 ui-front">
                <input type="text" class="form-control" name="pattern_code" value="" id="pattern_code" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label no-padding-right">Name</label>
            <div class="col-md-10 ui-front">
                <input type="text" class="form-control" name="pattern_name" value="" id="pattern_name" required>
            </div>
          </div>
          <div class="form-group">
            <label for="p-in" class="col-md-2 control-label no-padding-right">Start</label>
            <div class="col-md-4">
                <div class="input-group">
                  <input id="start_date" name="start_date" type="text" class="form-control date-picker" />
                  <span class="input-group-addon">
                    <i class="fa fa-clock-o bigger-110"></i>
                  </span>
                </div>
            </div>
            <label class="col-md-1 label-heading">to</label>
            <div class="col-md-4">
                <div class="input-group">
                  <input id="end_date" name="end_date" type="text" class="form-control date-picker"  />
                  <span class="input-group-addon">
                    <i class="fa fa-clock-o bigger-110"></i>
                  </span>
                </div>
            </div>
          </div> 

          <h3 style="background-color: darkgray;padding: 10px 5px;color: #fff;">Susunan Pola Shift</h3>
          <div class="form-group">
            <label for="p-in" class="col-md-3 control-label no-padding-right">Pattern 1 Shift</label>
            <div class="col-md-5">
                <select class="chosen-select form-control" id="pattern1" name="pattern1">
                  <option value="0"> - </option>
                  <?php 
                  foreach($master_shift as $row)
                  { 
                    echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                  }?>
                </select>
            </div>
            <label class="col-md-1 label-heading">Total</label>
            <div class="col-md-3">
                <input type="number" id="total1" name="total1"  class="form-control" value="0" />
            </div>
          </div> 
          <div class="form-group">
            <label for="p-in" class="col-md-3 control-label no-padding-right">Pattern 2 Shift</label>
            <div class="col-md-5">
                <select class="chosen-select form-control" id="pattern2" name="pattern2">
                  <option value="0"> - </option>
                  <?php 
                  foreach($master_shift as $row)
                  { 
                    echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                  }?>
                </select>
            </div>
            <label class="col-md-1 label-heading">Total</label>
            <div class="col-md-3">
                <input type="number" id="total2" name="total2"  class="form-control" value="0" />
            </div>
          </div>
          <div class="form-group">
            <label for="p-in" class="col-md-3 control-label no-padding-right">Pattern 3 Shift</label>
            <div class="col-md-5">
                <select class="chosen-select form-control" id="pattern3" name="pattern3">
                  <option value="0"> - </option>
                  <?php 
                  foreach($master_shift as $row)
                  { 
                    echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                  }?>
                </select>
            </div>
            <label class="col-md-1 label-heading">Total</label>
            <div class="col-md-3">
                <input type="number" id="total3" name="total3"  class="form-control" value="0" />
            </div>
          </div>
          <div class="form-group">
            <label for="p-in" class="col-md-3 control-label no-padding-right">Pattern 4 Shift</label>
            <div class="col-md-5">
                <select class="chosen-select form-control" id="pattern4" name="pattern4">
                  <option value="0"> - </option>
                  <?php 
                  foreach($master_shift as $row)
                  { 
                    echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                  }?>
                </select>
            </div>
            <label class="col-md-1 label-heading">Total</label>
            <div class="col-md-3">
                <input type="number" id="total4" name="total4"  class="form-control" value="0" />
            </div>
          </div> 
          <div class="form-group">
            <label for="p-in" class="col-md-3 control-label no-padding-right">Pattern 5 Shift</label>
            <div class="col-md-5">
                <select class="chosen-select form-control" id="pattern5" name="pattern5">
                  <option value="0"> - </option>
                  <?php 
                  foreach($master_shift as $row)
                  { 
                    echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                  }?>
                </select>
            </div>
            <label class="col-md-1 label-heading">Total</label>
            <div class="col-md-3">
                <input type="number" id="total5" name="total5"  class="form-control" value="0" />
            </div>
          </div> 
          <div class="form-group">
            <label for="p-in" class="col-md-3 control-label no-padding-right">Pattern 6 Shift</label>
            <div class="col-md-5">
                <select class="chosen-select form-control" id="pattern6" name="pattern6">
                  <option value="0"> - </option>
                  <?php 
                  foreach($master_shift as $row)
                  { 
                    echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                  }?>
                </select>
            </div>
            <label class="col-md-1 label-heading">Total</label>
            <div class="col-md-3">
                <input type="number" id="total6" name="total6"  class="form-control" value="0" />
            </div>
          </div> 
          <div class="form-group">
            <label for="p-in" class="col-md-3 control-label no-padding-right">Pattern 7 Shift</label>
            <div class="col-md-5">
                <select class="chosen-select form-control" id="pattern7" name="pattern7">
                  <option value="0"> - </option>
                  <?php 
                  foreach($master_shift as $row)
                  { 
                    echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                  }?>
                </select>
            </div>
            <label class="col-md-1 label-heading">Total</label>
            <div class="col-md-3">
                <input type="number" id="total7" name="total7"  class="form-control" value="0" />
            </div>
          </div>
          <div class="form-group">
            <label for="p-in" class="col-md-3 control-label no-padding-right">Pattern 8 Shift</label>
            <div class="col-md-5">
                <select class="chosen-select form-control" id="pattern8" name="pattern8">
                  <option value="0"> - </option>
                  <?php 
                  foreach($master_shift as $row)
                  { 
                    echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                  }?>
                </select>
            </div>
            <label class="col-md-1 label-heading">Total</label>
            <div class="col-md-3">
                <input type="number" id="total8" name="total8"  class="form-control" value="0" />
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_schedule" name="id_schedule" >
        <input type="button" id="btnDelete" class="btn btn-danger" value="Delete">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>
