<style type="text/css">
  .products-list {
    list-style: none;
      margin: 0;
      padding: 0;
  }
  .pl-2, .px-2 {
      padding-left: .5rem!important;
  }
  .pr-2, .px-2 {
      padding-right: .5rem!important;
  }

  .carousel-fade .carousel-inner .item {
    opacity: 0;
    transition-property: opacity;
  }

  .carousel-fade .carousel-inner .active {
    opacity: 1;
  }

  .carousel-fade .carousel-inner .active.left,
  .carousel-fade .carousel-inner .active.right {
    left: 0;
    opacity: 0;
    z-index: 1;
  }

  .carousel-fade .carousel-inner .next.left,
  .carousel-fade .carousel-inner .prev.right {
    opacity: 1;
  }

  .carousel-fade .carousel-control {
    z-index: 2;
  }

  /*
  WHAT IS NEW IN 3.3: "Added transforms to improve carousel performance in modern browsers."
  now override the 3.3 new styles for modern browsers & apply opacity
  */
  @media all and (transform-3d), (-webkit-transform-3d) {
      .carousel-fade .carousel-inner > .item.next,
      .carousel-fade .carousel-inner > .item.active.right {
        opacity: 0;
        -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
      }
      .carousel-fade .carousel-inner > .item.prev,
      .carousel-fade .carousel-inner > .item.active.left {
        opacity: 0;
        -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
      }
      .carousel-fade .carousel-inner > .item.next.left,
      .carousel-fade .carousel-inner > .item.prev.right,
      .carousel-fade .carousel-inner > .item.active {
        opacity: 1;
        -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
      }
  }

  .slide-list {
    float: left;
    padding: 10px;
    text-align: center;
    width: 100%;
  }
  .slide-list img {
    border-radius: 50%;
    height: auto;
    max-width: 100%;
  }

  .widget-toolbar {
    float: left;
  }
  .text-primary {
    color: #007bff!important;
  }
  .text-gray {
    color: #6c757d;
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
</div>
<div class="page-content">
  <!-- <div class="page-header">
    <h1>
      Dashboard
      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        overview &amp; stats
      </small>
    </h1>
  </div> -->
  <div class="row">
      <div class="col-sm-12">
        <div class="widget-box transparent" id="recent-box">
          <div class="widget-header">
            <div class="widget-toolbar no-border">
              <ul class="nav nav-tabs" id="recent-tab">
                <li class="active">
                  <a data-toggle="tab" href="#task-tab">Dashboard</a>
                </li>

                <li>
                  <a data-toggle="tab" href="#member-tab"><i class="fa fa-plus 2x"></i></a>
                </li>
              </ul>
            </div>
          </div>

          <div class="widget-body">
            <div class="widget-main padding-4">
              <div class="tab-content padding-8">
                <div id="task-tab" class="tab-pane active">
                  <div class="row">
                    <div class="col-xs-9">
                      <div class="row">
                        <div class="search-area well col-xs-12">
                          
                          <div class="col-sm-3 no-padding">
                            <div class="col-md-12" style="padding-left: 16px">
                              <select class="chosen-select form-control" id="dashboard_category" name="dashboard_category">
                                <option value="0"> - </option>
                                <?php 
                                foreach($dashboard_category as $row)
                                { 
                                  echo '<option value="'.$row->Id.'">'.$row->Name.'</option>';
                                }?>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-2 no-padding">
                            <div class="col-md-12 no-padding">
                              <select class="chosen-select form-control" id="category_period" name="category_period">
                                <option value="0"> - </option>
                                <?php 
                                foreach($category_period as $row)
                                { 
                                  echo '<option value="'.$row->Id.'">'.$row->Name.'</option>';
                                }?>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-5 no-padding">
                            <div class="form-group">
                              <label class="col-sm-2 control-label no-padding-right" for="Sort">From</label>
                              <div class="col-sm-5 no-padding-right">
                                <div class="input-group">
                                  <input class="form-control date-picker" id="periode_start" name="periode_start" type="text" data-date-format="dd-mm-yyyy" />
                                  <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                  </span>
                                </div>
                              </div>
                              <div class="col-sm-5">
                                <div class="input-group">
                                  <input class="form-control date-picker" id="periode_end" name="periode_end" type="text" data-date-format="dd-mm-yyyy" />
                                  <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-2 no-padding">
                            <button type="button" id="btnFind" class="btn btn-primary btn-block"><i class="fa fa-search"></i>&nbsp;&nbsp;Refresh</button>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-6">
                            <div class="card">
                              <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                  <h3 class="card-title" id="judul-chart-one"></h3>
                                  <div class="btn-group" style="position: absolute;right: 40px;">
                                    <button data-toggle="dropdown" class="btn btn-inverse btn-xs dropdown-toggle pull-right">
                                      <span class="ace-icon fa fa-bar-chart-o icon-on-right"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-inverse">
                                      <?php 
                                      foreach($jenis as $row)
                                      { 
                                        echo '<li><a href="#" data-id="'.$row->Recnum.'">'.$row->IsDesc.'</a></li>';
                                      }?>
                                    
                                    </ul>
                                  </div>
                                  <button data-toggle="dropdown" class="btn btn-inverse btn-xs dropdown-toggle pull-right"><span class="ace-icon fa fa-external-link icon-on-right"></span>
                                  </button>
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="d-flex">
                                  
                                </div>
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                  <canvas id="chart-one" height="200"></canvas>
                                </div>

                               
                              </div>
                            </div>            
                          </div>          
                          <div class="col-lg-6">
                            <div class="card">
                              <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                  <h3 class="card-title" id="judul-chart-two"></h3>
                                  <div class="btn-group" style="position: absolute;right: 40px;">
                                    <button data-toggle="dropdown" class="btn btn-inverse btn-xs dropdown-toggle pull-right">
                                      <span class="ace-icon fa fa-bar-chart-o icon-on-right"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-inverse">
                                      <?php 
                                      foreach($jenis as $row)
                                      { 
                                        echo '<li><a href="#" data-id="'.$row->Recnum.'">'.$row->IsDesc.'</a></li>';
                                      }?>
                                    
                                    </ul>
                                  </div>
                                  <button data-toggle="dropdown" class="btn btn-inverse btn-xs dropdown-toggle pull-right"><span class="ace-icon fa fa-external-link icon-on-right"></span>
                                  </button>
                                </div>
                              </div>
                              <div class="card-body">
                              
                                <div class="position-relative mb-4">
                                  <canvas id="chart-two" height="200"></canvas>
                                </div>

                                
                              </div>
                            </div>
                            <!-- /.card -->
                          </div> 
                          <div class="col-lg-6">
                            <div class="card">
                              <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                  <h3 class="card-title" id="judul-donat"></h3>
                                  <div class="btn-group" style="position: absolute;right: 40px;">
                                    <button data-toggle="dropdown" class="btn btn-inverse btn-xs dropdown-toggle pull-right">
                                      <span class="ace-icon fa fa-bar-chart-o icon-on-right"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-inverse">
                                      <?php 
                                      foreach($jenis as $row)
                                      { 
                                        echo '<li><a href="#" data-id="'.$row->Recnum.'">'.$row->IsDesc.'</a></li>';
                                      }?>
                                    
                                    </ul>
                                  </div>
                                  <button data-toggle="dropdown" class="btn btn-inverse btn-xs dropdown-toggle pull-right"><span class="ace-icon fa fa-external-link icon-on-right"></span>
                                  </button>
                                </div>
                              </div>
                              <div class="card-body">
                                <div id="donut-chart" style="height: 300px;"></div>
                              </div>
                            </div>            
                          </div>          
                          <div class="col-lg-6">
                            <div class="card">
                              <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                  <h3 class="card-title" id="judul-chart-three"></h3>
                                  <div class="btn-group" style="position: absolute;right: 40px;">
                                    <button data-toggle="dropdown" class="btn btn-inverse btn-xs dropdown-toggle pull-right">
                                      <span class="ace-icon fa fa-bar-chart-o icon-on-right"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-inverse">
                                      <?php 
                                      foreach($jenis as $row)
                                      { 
                                        echo '<li><a href="#" data-id="'.$row->Recnum.'">'.$row->IsDesc.'</a></li>';
                                      }?>
                                    
                                    </ul>
                                  </div>
                                  <button data-toggle="dropdown" class="btn btn-inverse btn-xs dropdown-toggle pull-right"><span class="ace-icon fa fa-external-link icon-on-right"></span>
                                  </button>
                                
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="chart">
                                  <canvas id="chart-three" style="height:250px; min-height:250px"></canvas>
                                </div>
                              </div>
                            </div>
                            <!-- /.card -->
                          </div>  
                      </div>
                    </div> 
                    <div class="col-xs-3">
                      <div id="sidebar" class="sidebar responsive ace-save-state" style="width: 100%">
                        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                          <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-right ace-save-state" data-icon1="ace-icon fa fa-angle-double-right" data-icon2="ace-icon fa fa-angle-double-left"></i>
                        </div>
                        <ul class="nav nav-list">

                          <div class="card">
                              <div class="card-header">
                                <h3 class="card-title">New Employee</h3>                
                              </div>
                              
                              <div class="card-body p-0">
                                <div id="carouselHacked" class="carousel slide carousel-fade" data-ride="carousel">
                                  <div class="carousel-inner" role="listbox">
                                      <div class="item active">
                                        <div class="slide-list">
                                          <img src="<?= base_url(); ?>assets/images/user8-128x128.jpg" alt="User Image">
                                          <a class="users-list-name" href="#">Norman 1</a>
                                          <span class="users-list-date">Yesterday</span>
                                        </div>
                                      </div>
                                      <div class="item">
                                        <div class="slide-list">
                                          <img src="<?= base_url(); ?>assets/images/user8-128x128.jpg" alt="User Image">
                                          <a class="users-list-name" href="#">Norman 2</a>
                                          <span class="users-list-date">Yesterday</span>
                                        </div>
                                      </div>
                                      <div class="item">
                                        <div class="slide-list">
                                          <img src="<?= base_url(); ?>assets/images/user8-128x128.jpg" alt="User Image">
                                          <a class="users-list-name" href="#">Norman 3</a>
                                          <span class="users-list-date">Yesterday</span>
                                        </div>
                                      </div>
                                  </div>

                                  <!-- Controls -->
                                  <a class="left carousel-control" href="#carouselHacked" role="button" data-slide="prev">
                                      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                      <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="right carousel-control" href="#carouselHacked" role="button" data-slide="next">
                                      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                      <span class="sr-only">Next</span>
                                  </a>
                                </div>
                              </div>                                
                          </div>
                          <div class="card">
                              <div class="card-header">
                                <h3 class="card-title">On Leave</h3>                
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body p-0">
                                <div id="onleave" class="carousel slide carousel-fade" data-ride="carousel">
                                  <div class="carousel-inner" role="listbox">
                                      <div class="item active">
                                        <div class="slide-list">
                                          <img src="<?= base_url(); ?>assets/images/user8-128x128.jpg" alt="User Image">
                                          <a class="users-list-name" href="#">Norman 1</a>
                                          <span class="users-list-date">Yesterday</span>
                                        </div>
                                      </div>
                                      <div class="item">
                                        <div class="slide-list">
                                          <img src="<?= base_url(); ?>assets/images/user8-128x128.jpg" alt="User Image">
                                          <a class="users-list-name" href="#">Norman 2</a>
                                          <span class="users-list-date">Yesterday</span>
                                        </div>
                                      </div>
                                      <div class="item">
                                        <div class="slide-list">
                                          <img src="<?= base_url(); ?>assets/images/user8-128x128.jpg" alt="User Image">
                                          <a class="users-list-name" href="#">Norman 3</a>
                                          <span class="users-list-date">Yesterday</span>
                                        </div>
                                      </div>
                                  </div>

                                  <!-- Controls -->
                                  <a class="left carousel-control" href="#carouselHacked" role="button" data-slide="prev">
                                      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                      <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="right carousel-control" href="#carouselHacked" role="button" data-slide="next">
                                      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                      <span class="sr-only">Next</span>
                                  </a>
                                </div>
                              </div>                                
                          </div>
                          <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">HR Policies</h3>                
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                              <ul class="products-list product-list-in-card pl-2 pr-2">
                                  <li class="item">
                                    <div class="product-info">
                                      <a href="javascript:void(0)" class="product-title">
                                        <i class="ace-icon fa fa-folder fa-1x blue"></i>&nbsp;&nbsp;Samsung TV</a>
                                    </div>
                                  </li>
                                  <!-- /.item -->
                                  <li class="item">
                                    
                                    <div class="product-info">
                                      <a href="javascript:void(0)" class="product-title">
                                      <i class="ace-icon fa fa-folder fa-1x blue"></i>&nbsp;&nbsp;Bicycle</a>
                                    </div>
                                  </li>
                                  <!-- /.item -->
                                  <li class="item">
                                    
                                    <div class="product-info">
                                      <a href="javascript:void(0)" class="product-title">
                                        <i class="ace-icon fa fa-folder fa-1x blue"></i>&nbsp;&nbsp;Xbox One
                                      </a>
                                    </div>
                                  </li>
                                  <!-- /.item -->
                                  <li class="item">
                                   
                                    <div class="product-info">
                                      <a href="javascript:void(0)" class="product-title">
                                        <i class="ace-icon fa fa-folder fa-1x blue"></i>&nbsp;&nbsp;PlayStation 4
                                        </a>
                                    </div>
                                  </li>
                                  <!-- /.item -->
                                </ul>
                            </div>                                
                          </div>
                        </ul>
                        
                      </div>
                    </div> 
                  </div>
                </div>
                <div id="member-tab" class="tab-pane">
                    tab 2
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
</div>
