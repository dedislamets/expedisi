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
      </h1>
    </div><!-- /.page-header -->

    <div class="row">

      <div class="table-header" style="padding: 10px">
        <div class="alert alert-block alert-info clearfix" style="margin-bottom: 0">
          <div class="col-sm-5 no-padding">
            <div class="form-group">
              <label class="col-md-2">Periode</label>
              <div class="col-md-10 " style="padding-left: 16px">

                <select class="chosen-select form-control" id="working_status" name="working_status">
                  <option value="0"> - </option>
                  <?php 
                  foreach($working_status as $row)
                  { 
                    echo '<option value="'.$row->Recnum.'">'.$row->IsName.'</option>';
                  }?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-sm-7 no-padding">
            <div class="col-sm-12">
              <div class="control-group">
                <div class="checkbox-inline">
                  <label>
                    <input id="overtime" name="form-field-checkbox" type="checkbox" class="ace">
                    <span class="lbl"> Process</span>
                  </label>
                </div>
                <div class="checkbox-inline">
                  <label>
                    <input id="late" name="form-field-checkbox" type="checkbox" class="ace">
                    <span class="lbl"> View</span>
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
                <td  style="vertical-align: middle;">#</td>
                <td style="vertical-align: middle;">Emp. ID</td>
                <td style="vertical-align: middle;">Employee Name</td>
                <td style="text-align: center;">Component Salary</td>
                <td style="text-align: center;">Amount</td> 
                <td style="text-align: center;">Total</td>
                <td style="text-align: center;">SPL</td>
                <td style="vertical-align: middle;">Daily Allowance</td>
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


