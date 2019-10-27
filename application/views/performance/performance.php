<style type="text/css">
  .multi {
    .carousel-inner .active.left {
      left: -25%;
    }
    .carousel-inner .next {
      left:  25%;
    }
    .carousel-inner .prev {
      left: -25%;
    }
    .carousel-control {
      width:  4%;
    }
    .carousel-control.left, .carousel-control.right {
      margin-left:15px;
      background-image:none;
    }
  }

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
    <li><a href="<?= base_url(); ?>EmployeePerformance">Training Development</a></li>
    <li class="active">Detail</li>
  </ul><!-- /.breadcrumb -->

</div>
<div class="page-content">
	<div class="page-header">
		<h1>
			<?php echo $title ?>
		</h1>
     <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
	</div>
  <div class="row">
    <div class="well">
      <div class="col-md-6 no-padding">
        <div class="col-md-4">
          <div class="image">
            <img src="<?php echo $detail[0]->url ?>" style="height: 219px"  alt="User Image">
          </div>
        </div>
        <div class="col-md-8" >
          <table class="table">
            <tr>
              <td>Emp ID</td><td>:</td><td><?php echo $detail[0]->EmployeeId ?></td>
            </tr>
            <tr>
              <td>Section</td><td>:</td><td><?php echo $detail[0]->EmployeeName ?></td>
            </tr>
            <tr>
              <td>Function</td><td>:</td><td><?php echo $detail[0]->PositionFunctional ?></td>
            </tr>
            <tr>
              <td>Position</td><td>:</td><td><?php echo $detail[0]->PositionStructural ?></td>
            </tr>
            <tr>
              <td>Class</td><td>:</td><td><?php echo $detail[0]->Class ?></td>
            </tr>
            <tr>
              <td>Working Status</td><td>:</td><td><?php echo $detail[0]->WorkingStatus ?></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-6">
        <div class="col-md-3">
          <h3>Head</h3>
          <img src="<?php echo $detail[0]->url_head ?>" class="" style="height: 130px;width: 100%">
        </div>
        <div class="col-md-9">
          <h3>Sub Ordinate</h3>
          <div class="multi">
            <div class="row">
              <div class="carousel slide" id="myCarousel">
                <div class="carousel-inner">
                  <?php 
                  foreach($subordinat as $row)
                  { ?>
                    <div class="item">
                      <div class="col-xs-3"><a href="#"><img src="<?php echo $row->url ?>" style="height: 130px;width: 100%"></a>
                      </div>
                    </div>
                  <?php }?>  
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
	<div class="row">
		<div class="tabbable">
      <ul class="nav nav-tabs" id="myTab">
        <li class="active">
          <a data-toggle="tab" href="#home">
            Key Performance
          </a>
        </li>

        <li>
          <a data-toggle="tab" href="#messages">
            Competency
          </a>
        </li>
        <li class="dropdown">
          <a data-toggle="tab" href="#education">
            Summary
          </a>
        </li>
    	</ul>
    	<div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <div class="table-responsive">
            <table id="ViewTable" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>Key Performance Measurment</th>
                  <th>Bobot</th>
                  <th>Calculation Method</th>
                  <th>Target</th> 
                  <th>Actual</th>
                  <th>Score</th>
                  <th>Total Score</th>                
                  <th>Remark</th>
                </tr>
              </thead>
              <tbody>                                    
              </tbody>
            </table>
          </div>
        </div>
        <div id="messages" class="tab-pane fade">
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
        <div id="education" class="tab-pane fade">
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
	</div>
</div>

<?php
  $this->load->view($modal); 
?>