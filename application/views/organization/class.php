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
				General Affair
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
							<h4 class="widget-title lighter smaller">Class Tree 
							</h4>
							
							<div style="float: right;padding-top: 10px;">
								<div style="float: left;padding-right: 6px;">Include Sub</div>
								<label>
									<input id="include-sub" name="include-sub" class="ace ace-switch" type="checkbox" />
									<span class="lbl"></span>
								</label>
							</div>
						</div>

						<div class="widget-body">
							<div class="widget-main padding-8">
								<div class="form-group" >
									<label class="col-sm-3 control-label no-padding-right" style="padding-top: 6px" for="code">Golongan </label>
									<div class="col-sm-9" >
										<select id="gol" name="gol" class="chosen-select form-control" style="background-color: darkslategrey;color: #fff;">
											<option value="0" selected>--Choose a Golongan--</option>
											 <?php 
						                    foreach($gol as $row_gol)
						                    { 
						                      echo '<option value="'.$row_gol->Recnum.'">Golongan '.$row_gol->IsName.'</option>';
						                    }
						                    ?>
						                </select>
									</div>
								</div>
								<div class="form-group" >
									<label class="col-sm-3 control-label no-padding-right" style="padding-top: 6px" for="code">Grade</label>
									<div class="col-sm-9" >
										<select id="grade" name="grade" class="chosen-select form-control" style="background-color: darkslategrey;color: #fff;">
											<option value="0" selected>--Choose a Grade--</option>
											 <?php 
						                    foreach($grade as $row_grade)
						                    { 
						                      echo '<option value="'.$row_grade->Recnum.'">Grade '.$row_grade->IsName.'</option>';
						                    }
						                    ?>
						                </select>
									</div>
								</div>
								<div class="form-group" >
									<label class="col-sm-3 control-label no-padding-right" style="padding-top: 6px" for="code">Rank</label>
									<div class="col-sm-9" >
										<select id="rank" name="rank" class="chosen-select form-control" style="background-color: darkslategrey;color: #fff;">
											<option value="0" selected>--Choose a Rank--</option>
											 <?php 
						                    foreach($rank as $row_rank)
						                    { 
						                      echo '<option value="'.$row_rank->Recnum.'">Rank '.$row_rank->IsName.'</option>';
						                    }
						                    ?>
						                </select>
									</div>
								</div>
								<div class="form-group" >
									<label class="col-sm-3 control-label no-padding-right" style="padding-top: 6px" for="code">Search</label>
									<div class="col-sm-9" >
										<input type="text" class="form-control" placeholder="Your Keyword" name="search_field" id="search_field" value="" />  
									</div>
								</div>
								<div class="clearfix"></div>
								<hr style="border-bottom: 2px double gray;">
								<div class="col-sm-12" >						
									<div id="area-tree" style="overflow-y: scroll;height: 288px;">
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