<style type="text/css">
	.table>thead>tr {
	    color: #f6ebeb;
	    background: repeat-x #8a3333;
	    background-image: -webkit-linear-gradient(top,#F8F8F8 0,#ECECEC 100%);
	    background-image: -o-linear-gradient(top,#F8F8F8 0,#ECECEC 100%);
	    background-image: linear-gradient(to bottom,#8f8d8d 0,#332828 100%);
	   
	}
  .dataTable>thead>tr>th[class*=sorting_] {
    color: #fff;
  }
</style>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
  <ul class="breadcrumb">
    <li>
      <i class="ace-icon fa fa-home home-icon"></i>
      <a href="#">Home</a>
    </li>
    <li class="active"><?php echo $title ?></li>
  </ul><!-- /.breadcrumb -->
  <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
  <div class="nav-search" id="nav-search">

  </div><!-- /.nav-search -->
</div>
<div class="page-content">
    <div class="page-header">
      <h1 id="judul">
        <?php echo $title ?>
      </h1>
    </div><!-- /.page-header -->

    <div class="row">
      <div class="row" style="background-color: #dee1e5;padding: 10px;margin-left: 0;margin-right: 0;">
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
        
        <div class="col-sm-2 no-padding">
          <button type="button" id="btnFind" class="btn btn-primary btn-block"><i class="fa fa-search"></i>&nbsp;&nbsp;Refresh</button>
        </div>
      </div>
      <div>
          <table id="ViewTable" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <!-- <th>#</th> -->
                <th style="text-align: center;">Action</th>
                <th>Status</th>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Start Date</th> 
                <th>End Date</th>
                <th>Remark</th>
              </tr>
            </thead>
            <tbody>                                    
            </tbody>
          </table>
      </div>
    </div>
</div>
<?php
  $this->load->view($modal); 
?>



