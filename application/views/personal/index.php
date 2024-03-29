<style type="text/css">
  @media (min-width: 768px){
    .modal-dialog {
        width: 1000px;
    }
  }

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
    <li class="active"><?php echo $title ?></li>
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

      <div class="table-header">
        Employee Information &nbsp;&nbsp;
        <button class="btn btn-success" id="btnAdd">
              <i class="ace-icon fa fa-plus align-top bigger-125"></i>&nbsp;Add
        </button>
        <div class="pull-right">
          <div class="pull-right tableTools-container btn" style="padding: 2px 0;border: 2px solid #FFF;"></div>
          <button class="btn btn-filter">
                <i class="ace-icon fa fa-filter align-top bigger-125 "></i>&nbsp;Filter
          </button>
        </div>
      </div>
      <div class="clearfix"></div>
      <div>
        <div class="table-responsive">
          <table id="ViewTable" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Emp. ID</th>
                <th>Employee Name</th>
                <th>Department</th>
                <th>Location Name</th> 
                <th>Working Status</th>
                <th>Class</th>
                <th>Position Structural</th>                
                <th>Join Date</th>
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


