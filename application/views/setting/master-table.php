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
			<small>
				<i class="ace-icon fa fa-angle-double-right"></i>
				Setting
			</small>
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-sm-4">
			<div class="well">
				<!-- <h3 class="header smaller lighter red">Bootstrap Wells</h3> -->
				<div class="col-sm-12">
					<div class="widget-box widget-color-blue2">
						<div class="widget-header">
							<h4 class="widget-title lighter smaller">Table Tree 
							</h4>
						</div>

						<div class="widget-body">
							<div class="widget-main padding-8">
					
								<div class="clearfix"></div>
								<hr style="border-bottom: 2px double gray;">
								<div class="col-sm-12" style="overflow-y: scroll;height: 100%;">						
									Search : <input type="text" name="search_field" id="search_field" value="" />  
									<div id="area-tree" >
										<div id='jstree'></div>
									</div>  
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
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