<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Event</h4>
      </div>

      <form id="form1" class="form-horizontal" role="form">
        <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" > 
        <div class="modal-body">
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading">Day Tipe</label>
              <div class="col-md-8 ui-front">
                  <select class="chosen-select form-control" id="day_tipe" name="day_tipe">
                    <?php 
                    foreach($day_tipe as $row_day)
                    { 
                      echo '<option value="'.$row_day->Recnum.'">'.$row_day->IsDesc.'</option>';
                    }?>
                  </select>
              </div>
            </div>
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading">Event Name</label>
              <div class="col-md-8 ui-front">
                  <input type="text" class="form-control" name="name" value="" id="name">
              </div>
            </div>
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading">Start</label>
              <div class="col-md-8">
                  <div class="input-group">
                    <input id="start_date" name="start_date" type="text" class="form-control" />
                    <span class="input-group-addon">
                      <i class="fa fa-clock-o bigger-110"></i>
                    </span>
                  </div>
              </div>
            </div> 
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading">End</label>
              <div class="col-md-8">
                  <div class="input-group">
                    <input id="end_date" name="end_date" type="text" class="form-control" />
                    <span class="input-group-addon">
                      <i class="fa fa-clock-o bigger-110"></i>
                    </span>
                  </div>
              </div>
            </div> 
            <div class="form-group">
              <label class="col-md-4 label-heading" for="Official"></label>
              <label class="col-md-1" for="Official">Public</label>
              <div class="col-sm-5" >
                <label>
                  <input id="IsPublic" name="IsPublic" class="ace ace-switch" type="checkbox" checked />
                  <span class="lbl"></span>
                </label>
              </div>
            </div>
            <div class="table-responsive" id="tblPartisipant">
                <div class="table-header">
                Participant &nbsp;&nbsp;
                <button class="btn btn-white btn-yellow btn-sm pull-right" id="btnAddParticipant" style="margin-top: 5px;    margin-right: 10px;">
                      <i class="ace-icon fa fa-plus align-top bigger-125"></i>&nbsp;Add
                </button>
              </div>
              <table id="ViewTable" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Emp. ID</th>
                    <th>Employee Name</th>
                    <th>Department</th>
                    <th>Location Name</th>
                    <th>Action</th> 
                  </tr>
                </thead>
                <tbody>                                    
                </tbody>
              </table>
            </div>
            <input type="hidden" name="eventid" id="event_id" value="" />
        </div>
        <div class="modal-footer">        
          <input type="button" class="btn btn-primary" id="btnSchedule" value="Submit">
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalParticipant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Participant</h4>
      </div>
      <div class="modal-body">
        <table id="myTable" class="table table-striped table-bordered table-hover" style="width:100%">
          <thead>
              <tr>
                <th>Pilih</th>
                <th>Emp. ID</th>
                <th>Employee Name</th>
                <th>Department</th>
              </tr>
          </thead>
          <tbody>
          </tbody>   
        </table>
        <div style="display: none">
            <input type="text" id="txtSelected" name="txtSelected" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="submit_button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>