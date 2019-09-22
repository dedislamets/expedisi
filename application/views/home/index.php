<style type="text/css">
  .users-list {
    padding-left: 0;
    list-style: none;
  }
  .users-list>li {
    float: left;
    padding: 10px;
    text-align: center;
    width: 100%;
  }
  .users-list>li img {
    border-radius: 50%;
    height: auto;
    max-width: 100%;
  }
  .users-list-name {
    color: #495057;
    font-size: 2.4rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .users-list-date, .users-list-name {
      display: block;
  }
  .users-list-date {
    color: #748290;
    font-size: 12px;
  }
  .card {
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    margin-bottom: 1rem!important;
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

  .card-header {
    background-color: transparent;
    border-bottom: 1px solid rgba(0,0,0,.125);
    position: relative;
    padding: .75rem 1.25rem;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    margin-bottom: 0;
  }
  .border-0 {
    border: 0!important;
  }
  .card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
  }
  .justify-content-between {
    -ms-flex-pack: justify!important;
    justify-content: space-between!important;
  }
  .d-flex {
      display: -ms-flexbox!important;
      display: flex!important;
  }
  .card-body::after, .card-footer::after, .card-header::after {
    display: block;
    clear: both;
    content: "";
  }
  .card-title {
    float: left;
    font-size: 2.1rem;
    font-weight: 400;
    margin: 0;
  }
  .position-relative {
    position: relative!important;
  }
  .justify-content-end {
    -ms-flex-pack: end!important;
    justify-content: flex-end!important;
  }
  .justify-content-between {
    -ms-flex-pack: justify!important;
    justify-content: space-between!important;
  }

  .flex-row {
      -ms-flex-direction: row!important;
      flex-direction: row!important;
  }

 /* .user-panel {
    border-bottom: 1px solid #4f5962;
  }*/
  .user-panel, .user-panel .info {
      overflow: hidden;
      white-space: nowrap;
  }
  .user-panel {
      position: relative;
  }
  .pb-3, .py-3 {
      padding-bottom: 1rem!important;
  }
  .callout, .card, .info-box, .mb-3, .my-3, .small-box {
      margin-bottom: 1rem!important;
  }
  .mt-3, .my-3 {
      margin-top: 1.5rem!important;
  }
  .user-panel .image {
    display: inline-block;
    padding-left: .8rem;
  }

  .user-panel img {
    height: auto;
    width: 4.5rem;
  }
  .elevation-2 {
      box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23)!important;
  }
  .img-circle {
      border-radius: 50%;
  }
  .user-panel .info {
    transition: margin-left .3s linear,opacity .3s ease,visibility .3s ease;
  }
  .user-panel .info {
      display: inline-block;
      padding: 5px 5px 5px 10px;
  }
  .user-panel, .user-panel .info {
      overflow: hidden;
      white-space: nowrap;
  }
  .d-block {
    display: block!important;
    font-size: 17px;
    white-space: normal;
    line-height: 17px;
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
  <div class="page-header">
    <h1>
      Dashboard
      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        overview &amp; stats
      </small>
    </h1>
  </div><!-- /.page-header -->

  <div class="row">
    <div class="col-xs-9">
      <div class="row">
        <div class="search-area well col-xs-12">
          <div class="pull-left">
            <b class="text-primary">Display</b>

            &nbsp;
            <div id="toggle-result-format" class="btn-group btn-overlap" data-toggle="buttons">
              <label title="" class="btn btn-lg btn-white btn-success active" data-class="btn-success" aria-pressed="true" data-original-title="Thumbnail view">
                <input type="radio" value="2" autocomplete="off">
                <i class="icon-only ace-icon fa fa-th"></i>
              </label>

              <label title="" class="btn btn-lg btn-white btn-grey" data-class="btn-primary" data-original-title="List view">
                <input type="radio" value="1" checked="" autocomplete="off">
                <i class="icon-only ace-icon fa fa-list"></i>
              </label>

              <label title="" class="btn btn-lg btn-white btn-grey" data-class="btn-warning" data-original-title="Map view">
                <input type="radio" value="3" autocomplete="off">
                <i class="icon-only ace-icon fa fa-crosshairs"></i>
              </label>
            </div>
          </div>

          <div class="pull-right">
            <b class="text-primary">Order</b>

            &nbsp;
            <select>
              <option>Relevance</option>
              <option>Newest First</option>
              <option>Rating</option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Online Store Visitors</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">820</span>
                    <span>Visitors Over Time</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 12.5%
                    </span>
                    <span class="text-muted">Since last week</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This Week
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last Week
                  </span>
                </div>
              </div>
            </div>            
          </div>          
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Sales</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">$18,230.00</span>
                    <span>Sales Over Time</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div> 
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Online Store Visitors</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">820</span>
                    <span>Visitors Over Time</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 12.5%
                    </span>
                    <span class="text-muted">Since last week</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This Week
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last Week
                  </span>
                </div>
              </div>
            </div>            
          </div>          
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Sales</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">$18,230.00</span>
                    <span>Sales Over Time</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>          
      </div>
    </div> 
    <div class="col-xs-3">
      <div id="sidebar" class="sidebar responsive ace-save-state" style="width: 100%">
        <ul class="nav nav-list">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recently Added Products</h3>                
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="users-list clearfix">
                      <li>
                        <img src="<?= base_url(); ?>assets/images/user1-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">Alexander Pierce</a>
                        <span class="users-list-date">Today</span>
                      </li>
                      <!-- <li>
                        <img src="<?= base_url(); ?>assets/images/user8-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">Norman</a>
                        <span class="users-list-date">Yesterday</span>
                      </li>
                      <li>
                        <img src="<?= base_url(); ?>assets/images/user7-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">Jane</a>
                        <span class="users-list-date">12 Jan</span>
                      </li>
                      <li>
                        <img src="<?= base_url(); ?>assets/images/user6-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">John</a>
                        <span class="users-list-date">12 Jan</span>
                      </li>
                      <li>
                        <img src="<?= base_url(); ?>assets/images/user2-160x160.jpg" alt="User Image">
                        <a class="users-list-name" href="#">Alexander</a>
                        <span class="users-list-date">13 Jan</span>
                      </li>
                      <li>
                        <img src="<?= base_url(); ?>assets/images/user5-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">Sarah</a>
                        <span class="users-list-date">14 Jan</span>
                      </li>
                      <li>
                        <img src="<?= base_url(); ?>assets/images/user4-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">Nora</a>
                        <span class="users-list-date">15 Jan</span>
                      </li>
                      <li>
                        <img src="<?= base_url(); ?>assets/images/user3-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">Nadia</a>
                        <span class="users-list-date">15 Jan</span>
                      </li> -->
                    </ul>
              </div>                                
          </div>
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recently Added Products</h3>                
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="users-list clearfix">                      
                  <li>
                    <img src="<?= base_url(); ?>assets/images/user8-128x128.jpg" alt="User Image">
                    <a class="users-list-name" href="#">Norman</a>
                    <span class="users-list-date">Yesterday</span>
                  </li>
                  
                </ul>
              </div>                                
          </div>
        </ul>
        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
          <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-right ace-save-state" data-icon1="ace-icon fa fa-angle-double-right" data-icon2="ace-icon fa fa-angle-double-left"></i>
        </div>
      </div>
    </div> 
  </div>
</div>
