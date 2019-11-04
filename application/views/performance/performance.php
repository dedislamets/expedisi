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
  .sub-ordinat {
    background-color: cadetblue;
    padding-left: 10px;
    margin-left: 0;
    color: #fff;
  }

  .align-items-stretch {
      -ms-flex-align: stretch!important;
      align-items: stretch!important;
  }
  .d-flex, .info-box, .info-box .info-box-icon {
      display: -ms-flexbox!important;
      display: flex!important;
  }
  .bg-light {
    background-color: #f8f9fa!important;
  }
  .text-muted {
    color: #6c757d!important;
}
.pt-0, .py-0 {
    padding-top: 0!important;
}
.lead {
    font-size: 1.25rem;
    font-weight: 300;
    margin-bottom: 0;
}
.ml-4, .mx-4 {
    margin-left: 1.5rem!important;
}
.mb-0, .my-0 {
    margin-bottom: 0!important;
}
.fa-ul {
    list-style-type: none;
    margin-left: 2.5em;
    padding-left: 0;
}
.fa-ul>li {
    position: relative;
}
.fa-li {
    left: -2em;
    position: absolute;
    text-align: center;
    width: 2em;
    line-height: inherit;
}

.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card {
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
}

.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
}
.card-footer {
    padding: .75rem 1.25rem;
    background-color: rgba(0,0,0,.03);
    border-top: 0 solid rgba(0,0,0,.125);
}

.card-header {
    background-color: transparent;
    border-bottom: 1px solid rgba(0,0,0,.125);
    position: relative;
    padding: .75rem 1.25rem;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
}
.rows {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -7.5px;
    margin-left: -7.5px;
}

.img-fluid {
    max-width: 100%;
    height: auto;
}
.text-center {
    text-align: center!important;
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
     <input type="hidden" name="txtID" id="txtID" value="<?php echo $id ?>">
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
          <h3 class="sub-ordinat">Head</h3>
          <img src="<?php echo $detail[0]->url_head ?>" class="" style="height: 130px;width: 100%">
        </div>
        <div class="col-md-9">
          <h3 class="sub-ordinat">Sub Ordinate</h3>
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
          <div class="widget-box widget-color-blue2">
            <div class="widget-header">
              <h4 class="widget-title lighter smaller"> 
              </h4>
              
              <div style="float: right;padding-top: 5px;padding-right: 5px">
                <button class='btn btn-sm btn-white btn-success' id="btnRefresh"><i class='ace-icon fa fa-refresh'></i>
                Refresh</button>
                <button class='btn btn-sm btn-white btn-success' id="btnAdd"><i class='ace-icon fa fa-plus'></i>
                Create</button>
              </div>
            </div>

            <div class="widget-body">
              <div class="widget-main padding-8">
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
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>                                    
                    </tbody>
                  </table>
                  <h3>Scoring For Key Performance</h3>
                  <div class="col-md-6 no-padding">
                    <table class="table table-striped table-bordered table-hover">
                      <?php 
                      foreach($keyperformancescore as $row)
                      { ?>
                      <tr>
                        <td><?php echo $row->IsDesc ?></td>
                        <td><?php echo $row->ScoreFrom . " - " . $row->ScoreTo ?></td>
                        <td><?php echo $row->Remark ?></td>
                      </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="messages" class="tab-pane fade">
          <div class="widget-box widget-color-blue2">
            <div class="widget-header">
              <h4 class="widget-title lighter smaller"> 
              </h4>
              
              <div style="float: right;padding-top: 5px;padding-right: 5px">
                <button class='btn btn-sm btn-white btn-success' id="btnRefresh_2"><i class='ace-icon fa fa-refresh'></i>
                Refresh</button>
              </div>
            </div>

            <div class="widget-body">
              <div class="widget-main padding-8">
                <div class="table-responsive">
                  <table style="width: 100%" id="ViewTable-Competency" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Competency</th>
                        <th>Grup Competency</th>
                        <th>Target</th>
                        <th>Actual</th> 
                        <!-- <th>Gap</th> -->
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>                                    
                    </tbody>
                  </table>
                  <h3>Scoring For Competency</h3>
                  <div class="col-md-6 no-padding">
                    <table class="table table-striped table-bordered table-hover">
                      <?php 
                      foreach($keypercompetency as $row)
                      { ?>
                      <tr>
                        <td><?php echo $row->IsDesc ?></td>
                        <td><?php echo $row->ScoreFrom . " - " . $row->ScoreTo ?></td>
                        <td><?php echo $row->Scale1_5 ?></td>
                        <td><?php echo $row->Remark ?></td>
                      </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>     
              </div>
            </div>
          </div>
        </div>
        <div id="education" class="tab-pane fade">
          <div class="table-responsive">
          
            <div class="widget-box widget-color-blue2">
              <div class="widget-header">
                <h4 class="widget-title lighter smaller"> 
                </h4>
                  Summary Performance
                <div style="float: right;padding-top: 5px;padding-right: 5px">
                  <button class='btn btn-sm btn-white btn-success' id="btnRefresh_2"><i class='ace-icon fa fa-refresh'></i>
                  Refresh</button>
                </div>
              </div>

              <div class="widget-body">
                <div class="widget-main padding-8">      
                  <table  style="width: 100%"  id="ViewTable_summary_1" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Performance</th>
                        <th>Score</th>
                        <th>Bobot</th>
                        <th>Total Score</th>
                      </tr>
                    </thead>
                    <tbody>                                    
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="widget-box widget-color-blue2">
              <div class="widget-header">
                <h4 class="widget-title lighter smaller"> 
                </h4>
                  Summary Competency
                <div style="float: right;padding-top: 5px;padding-right: 5px">
                  <button class='btn btn-sm btn-white btn-success' id="btnRefresh_2"><i class='ace-icon fa fa-refresh'></i>
                  Refresh</button>
                </div>
              </div>

              <div class="widget-body">
                <div class="widget-main padding-8">      
                  <table  style="width: 100%"  id="ViewTable_summary_2" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Competency</th>
                        <th>Score</th>
                        <th>Bobot</th>
                        <th>Total Score</th>
                      </tr>
                    </thead>
                    <tbody>                                    
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="widget-box widget-color-blue2">
              <div class="widget-header">
                <h4 class="widget-title lighter smaller"> 
                </h4>
                  Summary
                <div style="float: right;padding-top: 5px;padding-right: 5px">
                  <button class='btn btn-sm btn-white btn-success' id="btnRefresh_2"><i class='ace-icon fa fa-refresh'></i>
                  Refresh</button>
                </div>
              </div>

              <div class="widget-body">
                <div class="widget-main padding-8">      
                  <table  style="width: 100%"  id="ViewTable_summary_3" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Summary</th>
                        <th>Score</th>
                        <th>Bobot</th>
                        <th>Total Score</th>
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
      </div>
	</div>
</div>

<?php
  $this->load->view($modal); 
?>