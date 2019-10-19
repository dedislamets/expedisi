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
	</div>
  <div class="row">
    <div class="well">
      <div class="col-md-5">
        <div class="col-md-4">
          <div class="image">
            <img src="<?= base_url(); ?>assets/images/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
        </div>
        <div class="col-md-8" >
          <table class="table ">
            <tr>
              <td>Emp ID</td><td>:</td><td>Dedi Slamet S</td>
            </tr>
            <tr>
              <td>Section</td><td>:</td><td>Dedi Slamet S</td>
            </tr>
            <tr>
              <td>Function</td><td>:</td><td>Dedi Slamet S</td>
            </tr>
            <tr>
              <td>Position</td><td>:</td><td>Dedi Slamet S</td>
            </tr>
            <tr>
              <td>Grade</td><td>:</td><td>Dedi Slamet S</td>
            </tr>
            <tr>
              <td>Working Status</td><td>:</td><td>Dedi Slamet S</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-7">
        <div class="multi">
         
          <div class="row">
            <div class="carousel slide" id="myCarousel">
              <div class="carousel-inner">
                <div class="item active">
                  <div class="col-xs-3"><a href="#"><img src="http://placehold.it/500/e499e4/fff&amp;text=1" class="img-responsive"></a></div>
                </div>
                <div class="item">
                  <div class="col-xs-3"><a href="#"><img src="http://placehold.it/500/e477e4/fff&amp;text=2" class="img-responsive"></a></div>
                </div>
                <div class="item">
                  <div class="col-xs-3"><a href="#"><img src="http://placehold.it/500/eeeeee&amp;text=3" class="img-responsive"></a></div>
                </div>
                <div class="item">
                  <div class="col-xs-3"><a href="#"><img src="http://placehold.it/500/f4f4f4&amp;text=4" class="img-responsive"></a></div>
                </div>
                <div class="item">
                  <div class="col-xs-3"><a href="#"><img src="http://placehold.it/500/f566f5/333&amp;text=5" class="img-responsive"></a></div>
                </div>
                <div class="item">
                  <div class="col-xs-3"><a href="#"><img src="http://placehold.it/500/f477f4/fff&amp;text=6" class="img-responsive"></a></div>
                </div>
                <div class="item">
                  <div class="col-xs-3"><a href="#"><img src="http://placehold.it/500/eeeeee&amp;text=7" class="img-responsive"></a></div>
                </div>
                <div class="item">
                  <div class="col-xs-3"><a href="#"><img src="http://placehold.it/500/fcfcfc/333&amp;text=8" class="img-responsive"></a></div>
                </div>
              </div>
              <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
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