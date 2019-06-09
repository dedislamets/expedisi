<style type="text/css">
	.take-all-space-you-can{
	    width:50%;
	}
	.well{
		margin-bottom: 0;
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
		<div class="col-sm-12">
			<div class="tabbable">
				<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
					<li class="take-all-space-you-can active">
						<a data-toggle="tab" href="#home4" aria-expanded="true">Timeline</a>
					</li>

					<li class="take-all-space-you-can">
						<a data-toggle="tab" href="#profile4" aria-expanded="false">Pattern Schedule</a>
					</li>
				</ul>

				<div class="tab-content" style="padding-bottom: 0">
					<div id="home4" class="tab-pane active">
						<div class="row">
							<div class="well clearfix">
								<div class="alert alert-block alert-success clearfix">
									<div class="col-sm-6">
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
							            <br>
							            <div class="form-group">
						                  	<label class="col-sm-2 control-label no-padding-right" for="blood">Group</label>
						                  	<div class="col-sm-10">
						                    	<select class="chosen-select form-control" id="group" name="group">
						                    		<option value="0"></option>
							                      <?php 
							                      foreach($pattern as $row)
							                      { 
							                        echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
							                      }?>
						                    	</select>
						                  </div>
						              	</div>
			
									</div>
									<div class="col-sm-6">
										<div class="col-sm-3">
											<div class="control-group"  id="rAction">
												<div class="radio">
													<label>
														<input name="form-field-radio" type="radio" class="ace" value="0" checked>
														<span class="lbl"> View </span>
													</label>
												</div>

												<div class="radio">
													<label>
														<input name="form-field-radio" type="radio" class="ace" value="1">
														<span class="lbl"> Create</span>
													</label>
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="control-group">
												
												<div class="checkbox" >
													<label>
														<input id="replace" name="form-field-checkbox" type="checkbox" class="ace">
														<span class="lbl"> Replace</span>
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<button class="btn btn-primary btn-block" id="btnGo">Go</button>
										</div>
									</div>
								</div>
								<div class="col-sm-12" style="width: 100%" id="box-iframe">
									<iframe id="iframe" src="" style="width: 100%" scrolling="yes"></iframe>
								</div>
							</div>
						</div>
					</div>

					<div id="profile4" class="tab-pane">	
						<div class="row">
							<div class="well">
								<div class="col-sm-12" style="width: 100%">
				                    <div class="widget-box">
				                        <div class="widget-header">
				                          <h4 class="widget-title">Pattern Schedule</h4>
				                          <div class="widget-toolbar">
				                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAdd"><i class="ace-icon fa fa-plus red2"></i></button>
				                          </div>
				                        </div>
				                        <div class="widget-body">
				                          <div class="table-responsive">
				                            <table id="tabel-schedule" class="table table-striped table-bordered table-hover" style="margin-bottom: 0" style="width: 100%">
				                              <thead>
				                                <tr>
				                                  <th>No</th>
				                                  <th>Sub ID</th>
				                                  <th>Sub Name</th>
				                                  <th>Shift 1</th> 
				                                  <th>:</th>
				                                  <th>Shift 2</th>   
				                                  <th>:</th>
				                                  <th>Shift 3</th>   
				                                  <th>:</th>  
				                                  <th>Shift 4</th>   
				                                  <th>:</th> 
				                                  <th>Shift 5</th>   
				                                  <th>:</th> 
				                                  <th>Shift 6</th>   
				                                  <th>:</th>  
				                                  <th>Shift 7</th>   
				                                  <th>:</th>  
				                                  <th>Shift 8</th>   
				                                  <th>:</th>      
				                                        
				                                </tr>
				                              </thead>
				                              <tbody>    
				                                                              
				                              </tbody>
				                            </table>
				                          </div>
				                        </div>
			                    	</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<?php
  $this->load->view($modal); 
?>