<style type="text/css">
	.FormGrid .EditTable tr:first-child {
	    display: table-row;;
	}
	.modal.in .modal-dialog {
		width: 700px;
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
		<div class="col-sm-4">
			<div class="well">
				<!-- <h3 class="header smaller lighter red">Bootstrap Wells</h3> -->
				<div class="col-sm-12">
					<div class="widget-box widget-color-blue2">
						<div class="widget-header">
							<h4 class="widget-title lighter smaller">Leave 
							</h4>
						</div>

						<div class="widget-body">
							<div class="widget-main padding-8">
								<div class="form-group" >
									<label class="col-sm-3 control-label no-padding-right" style="padding-top: 6px" for="code">Employee</label>
									<div class="col-sm-9" >
										<select id="gol" name="gol" class="chosen-select form-control" style="background-color: darkslategrey;color: #fff;">
											<option value="0" selected>--</option>
											 <?php 
						                    foreach($empadmin as $row_gol)
						                    { 
						                      echo '<option value="'.$row_gol->Recnum.'">'.$row_gol->EmployeeName.'</option>';
						                    }
						                    ?>
						                </select>
									</div>
								</div>
								<div class="clearfix"></div>
								<hr style="border-bottom: 2px double gray;">
								<div class="col-sm-12">						
									<table id="grid-table-left"></table>
									<div id="grid-pager-left"></div>							
								</div>
								<div class="clearfix"></div>
							</div>

						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="row">
				<div class="well">
					<div class="col-sm-12" style="width: 100%">
						<table id="grid-table"></table>
						<div id="grid-pager"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div><!-- /.col -->
	</div>
</div>

<?php
  $this->load->view($modal); 
?>