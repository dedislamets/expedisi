<style type="text/css">
	.modal { overflow: auto !important; }
</style>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Home</a>
		</li>
		<li class="active">Calendar</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
	<div class="page-header">
		<h1>
			Working Calendar
			<small>
				<i class="ace-icon fa fa-angle-double-right"></i>
				Manage your calendar easy.
			</small>
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12" id="app_calendar">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-sm-9">
					<div class="space"></div>

					<div id="calendar"></div>
				</div>

				<div class="col-sm-3">
					<div class="widget-box transparent">
						<div class="widget-header">
							<h4>Day Type</h4>
						</div>

						<div class="widget-body">
							<div class="widget-main no-padding">
								<div id="external-events">
									<?php 
                                  	foreach($day_tipe as $row_day)
                                  	{ ?>
                                  		<div class="external-event label-<?php echo $row_day->Colour  ?>" data-class="label-<?php echo $row_day->Colour  ?>" data-id=<?php echo $row_day->Recnum  ?> >
											<i class="ace-icon fa fa-arrows"></i>
											<?php echo $row_day->IsDesc ?>
										</div>
                                  	<?php }?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->
<?php
  $this->load->view($modal); 
?>
