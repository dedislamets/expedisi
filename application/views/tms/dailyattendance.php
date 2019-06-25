<style type="text/css">


  .popover {
    max-width: 355px;
  }

  
</style>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
  <ul class="breadcrumb">
    <li>
      <i class="ace-icon fa fa-home home-icon"></i>
      <a href="#">Home</a>
    </li>
    <li class="active">Dashboard</li>
  </ul><!-- /.breadcrumb -->
  <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
  <div class="nav-search" id="nav-search">
    <form class="form-search">
      <span class="input-icon">
        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
        <i class="ace-icon fa fa-search nav-search-icon"></i>
      </span>
    </form>
  </div><!-- /.nav-search -->
</div>
<div class="page-content">
    <div class="page-header">
      <h1>
        <?php echo $title ?>
        <small>
          <i class="ace-icon fa fa-angle-double-right"></i>
          TMS
        </small>
      </h1>
    </div><!-- /.page-header -->

    <div class="row">

      <div class="table-header" style="padding: 10px">
        <div class="alert alert-block alert-info clearfix" style="margin-bottom: 0">
          <div class="col-sm-5 no-padding">
            <div class="form-group">
              <label class="col-sm-2 control-label no-padding-right" for="Sort">Periode</label>
              <div class="col-sm-4 no-padding-right">
                <div class="input-group">
                  <input class="form-control date-picker" id="periode_start" name="dateRangeStart_stat" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
              <label class="col-sm-1 control-label ">To</label>
              <div class="col-sm-5">
                <div class="input-group">
                  <input class="form-control date-picker" id="periode_end" name="dateRangeEnd_stat" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-7 no-padding">
            <div class="col-sm-12">
              <div class="control-group">
                <div class="checkbox-inline">
                  <label>
                    <input id="overtime" name="form-field-checkbox" type="checkbox" class="ace">
                    <span class="lbl"> Overtime</span>
                  </label>
                </div>
                <div class="checkbox-inline">
                  <label>
                    <input id="late" name="form-field-checkbox" type="checkbox" class="ace">
                    <span class="lbl"> Late</span>
                  </label>
                </div>
                <div class="checkbox-inline">
                  <label>
                    <input id="early" name="form-field-checkbox" type="checkbox" class="ace">
                    <span class="lbl"> Early Out</span>
                  </label>
                </div>
                <div class="checkbox-inline">
                  <label>
                    <input id="absen" name="form-field-checkbox" type="checkbox" class="ace">
                    <span class="lbl"> Absent</span>
                  </label>
                </div>
                <div class="checkbox-inline">
                  <label>
                    <input id="resign" name="form-field-checkbox" type="checkbox" class="ace">
                    <span class="lbl"> Resign</span>
                  </label>
                </div>
                <div class="checkbox-inline">
                  <label>
                    <input id="all" name="form-field-checkbox" type="checkbox" class="ace">
                    <span class="lbl"> All</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-1"></div>
          <div class="col-sm-2 no-padding">
              <button class="btn btn-info btn-block" id="btnAdvance">Advance Filter</button>
          </div>
          <div class="col-sm-2">
              <button class="btn btn-primary btn-block" id="btnGo">Go</button>
          </div>
          
        </div>
      </div>
      <div>
        <div class="table-responsive">
          <table id="ViewTable" class="table table-striped table-bordered table-hover">
            <thead>
              <tr style="background: repeat-x #F2F2F2;font-weight: bold;">
                <td rowspan="2" style="vertical-align: middle;">#</td>
                <td rowspan="2" style="vertical-align: middle;">Emp. ID</td>
                <td rowspan="2" style="vertical-align: middle;">Employee Name</td>
                <td colspan="4" style="text-align: center;">Schedule</td>
                <td colspan="3" style="text-align: center;">Actual</td> 
                <td colspan="5" style="text-align: center;">Late/Early Out/Out Office</td>
                <td colspan="6" style="text-align: center;">SPL</td>
                <td rowspan="2" style="vertical-align: middle;">Daily Allowance</td>
              </tr>
              <tr style="font-weight: bold;">
                <!-- Schedule -->
                <td>Date</td>
                <td>Shift</td>
                <td>In</td>
                <td>Out</td>
                <!-- Actual -->
                <td>In</td>
                <td>Out</td>
                <td>Absent Type</td>
                <!-- Late/Early -->
                <td>Late</td>
                <td>Early</td>
                <td>Out</td>
                <td>Real OT</td>
                <td>Point OT</td>
                <!-- SPL -->
                <td>Early In</td>
                <td>Early Out</td>
                <td>Return In</td>
                <td>Return Out</td>
                <td>Holiday In</td>
                <td>Holiday Out</td>
              
              </tr>
            </thead>
            <tbody>                                    
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
<?php
  $this->load->view($modal); 
?>


