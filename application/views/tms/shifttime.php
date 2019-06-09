<style type="text/css">
	.take-all-space-you-can{
	    width:33%;
	}
	.well{
		margin-bottom: 0;
		padding: 8px;
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
		<div class="col-sm-3">
			<div class="well">
				<!-- <h3 class="header smaller lighter red">Bootstrap Wells</h3> -->
				<div class="col-sm-12">
					<div class="widget-box widget-color-blue2">
						<div class="widget-header">
							<h4 class="widget-title lighter smaller">Group Shift 
							</h4>
							
							<div style="float: right;padding-top: 5px;padding-right: 5px">
								<button class='btn btn-sm btn-white btn-success' id="btnAddGroup"><i class='ace-icon fa fa-plus'></i></button>
							</div>
						</div>

						<div class="widget-body">
							<div class="widget-main padding-8">
								<div class="col-sm-12" style="padding: 0" >	
								<?php 
                              	foreach($group_shift as $row)
                              	{ ?>
                              		<p><button class="btn btn-light btn-shift" data-id="<?php echo $row->Recnum ?>" style="width: 50%"><?php echo $row->IsDesc ?></button><button class='btn btn-warning btn-shift-edit' ><i class='ace-icon fa fa-pencil'></i></button><button class='btn btn-danger btn-shift-delete'><i class='ace-icon fa fa-trash-o'></i></button></p>
                              	<?php }?>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="widget-box widget-color-blue2">
						<div class="widget-body">
							<div class="widget-main padding-8">
								<button class='btn btn-grey btn-block' id="btnAllowance" >Allowance</button>
								<button class='btn btn-grey btn-block' >OT Formula</button>
								<button class='btn btn-grey btn-block' >Round</button>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="col-sm-9">
			<div class="row">
				<div class="well clearfix">
					<div class="col-sm-12" style="width: 100%">
						<div class="widget-box">
	                        <div class="widget-header">
	                          <h4 class="widget-title">Shift Name</h4>
	                          <div class="widget-toolbar">
	                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddShift"><i class="ace-icon fa fa-plus red2"></i></button>
	                          </div>
	                        </div>
	                        <div class="widget-body">
	                          <div class="table-responsive">
	                            <table id="tabel-shift-name" class="table table-striped table-bordered table-hover" style="margin-bottom: 0">
	                              <thead>
	                                <tr>
	                                  <th>#</th>
	                                  <th>ID</th>
	                                  <th>Name</th>
	                                  <th>Validation</th>
	                                  <th>Day Type</th> 
	                                  <th>Shift Type</th>   
	                                </tr>
	                              </thead>
	                              <tbody>    
	                                                              
	                              </tbody>
	                            </table>
	                          </div>
	                        </div>
                    	</div>
	                    <div class="widget-box hidden" id="panel-working">
	                        <div class="widget-header">
	                          <h4 class="widget-title">Standard Working Hour</h4>
	                          <div class="widget-toolbar">
	                            <button class="btn btn-sm btn-white btn-success btn-round" ><i class="ace-icon fa fa-plus red2"></i></button>
	                          </div>
	                        </div>
	                        <div class="widget-body">
	                          <div class="table-responsive">
	                            <table id="tabel-standart-working" class="table table-striped table-bordered table-hover" style="margin-bottom: 0">
	                              <thead>
	                                <tr>
	                                  <th rowspan="2">Day</th>
	                                  <th rowspan="2">#</th>
	                                  <th colspan="2">Working Time</th>
	                                  <th colspan="2">Tolerance</th>
	                                  <th rowspan="2">Working Hour</th>    
	                                  <th rowspan="2">Day Type</th>
	                                  <th rowspan="2">sorting</th>              
	                                </tr>
	                                <tr>
	                                  <th>In</th>
	                                  <th>Out</th>
	                                  <th>Start</th> 
	                                  <th>End</th>     
	                                </tr>
	                              </thead>
	                              <tbody>    
	                                                                
	                              </tbody>
	                            </table>
	                          </div>
	                        </div>
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