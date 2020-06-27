<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Dashboard - HRPro System</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ui.jqgrid.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/chosen.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/fullcalendar.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/jquery.gritter.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="<?= base_url(); ?>assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>

    <![endif]-->
    <style type="text/css">
      .text-profile{
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
         font-size: 15px;
        white-space: normal;
        line-height: 12px;
      }
      .page-header h1 {
        font-size: 21px;
      }
      .navbar {
        background: #173242;
      }
      .breadcrumbs{
        background: #101067;
      }
      .breadcrumb>li, .breadcrumb>li.active {
          color: #fff;
      }
      .breadcrumb>li>a {
          color: #fff;
      }

      .clearfix{
        clear: both;
        display: block;
      }
      .nav-list>li>a {
        height: 50px;
      }
      .error {
        color: red;
      }
      .popover {
        z-index: 500;
      }

      .modal.fade {
        background: rgba(0,0,0,0.5);
      }

      .loader {
        font-size: 10px;
        margin: 17% auto;
        text-indent: -9999em;
        width: 11em;
        height: 11em;
        border-radius: 50%;
        background: #400000;
        background: -moz-linear-gradient(left, #400000 10%, rgba(64,0,0, 0) 42%);
        background: -webkit-linear-gradient(left, #400000 10%, rgba(64,0,0, 0) 42%);
        background: -o-linear-gradient(left, #400000 10%, rgba(64,0,0, 0) 42%);
        background: -ms-linear-gradient(left, #400000 10%, rgba(64,0,0, 0) 42%);
        background: linear-gradient(to right, #400000 10%, rgba(64,0,0, 0) 42%);
        position: relative;
        -webkit-animation: load3 1.4s infinite linear;
        animation: load3 1.4s infinite linear;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
      }
      .loader:before {
        width: 50%;
        height: 50%;
        background: #400000;
        border-radius: 100% 0 0 0;
        position: absolute;
        top: 0;
        left: 0;
        content: '';
      }
      .loader:after {
        background: #f8f8f8;
        width: 75%;
        height: 75%;
        border-radius: 50%;
        content: '';
        margin: auto;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
      }
      #loadingDiv {
              position:absolute;;
              top:0;
              left:0;
              width:100%;
              height:100%;
              background-color:#f8f8f8;
              opacity: 0.8;
          }
      @-webkit-keyframes load3 {
        0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
        }
        100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
        }
      }
      @keyframes load3 {
        0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
        }
        100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
        }
      }

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
        font-size: 16px;
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
        font-size: 15px;
        white-space: normal;
        line-height: 12px;
      }
    </style>
  </head>

  <body class="no-skin">
    <div id="navbar" class="navbar navbar-default ace-save-state">
      <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
          <span class="sr-only">Toggle sidebar</span>

          <span class="icon-bar"></span>

          <span class="icon-bar"></span>

          <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left`">
          <a href="index.html" class="navbar-brand">
            <small>
              <img src="<?= base_url(); ?>assets/images/<?php echo $this->session->userdata('logo') ?>" class="" alt="logo" width="30" />
              <?php echo $this->session->userdata('app_name') ?>
            </small>
          </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
          <ul class="nav ace-nav">
            <!-- <li class="grey dropdown-modal">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="ace-icon fa fa-tasks"></i>
                <span class="badge badge-grey">4</span>
              </a>

              <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                <li class="dropdown-header">
                  <i class="ace-icon fa fa-check"></i>
                  4 Tasks to complete
                </li>

                <li class="dropdown-content">
                  <ul class="dropdown-menu dropdown-navbar">
                    <li>
                      <a href="#">
                        <div class="clearfix">
                          <span class="pull-left">Software Update</span>
                          <span class="pull-right">65%</span>
                        </div>

                        <div class="progress progress-mini">
                          <div style="width:65%" class="progress-bar"></div>
                        </div>
                      </a>
                    </li>

                    <li>
                      <a href="#">
                        <div class="clearfix">
                          <span class="pull-left">Hardware Upgrade</span>
                          <span class="pull-right">35%</span>
                        </div>

                        <div class="progress progress-mini">
                          <div style="width:35%" class="progress-bar progress-bar-danger"></div>
                        </div>
                      </a>
                    </li>

                    <li>
                      <a href="#">
                        <div class="clearfix">
                          <span class="pull-left">Unit Testing</span>
                          <span class="pull-right">15%</span>
                        </div>

                        <div class="progress progress-mini">
                          <div style="width:15%" class="progress-bar progress-bar-warning"></div>
                        </div>
                      </a>
                    </li>

                    <li>
                      <a href="#">
                        <div class="clearfix">
                          <span class="pull-left">Bug Fixes</span>
                          <span class="pull-right">90%</span>
                        </div>

                        <div class="progress progress-mini progress-striped active">
                          <div style="width:90%" class="progress-bar progress-bar-success"></div>
                        </div>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="dropdown-footer">
                  <a href="#">
                    See tasks with details
                    <i class="ace-icon fa fa-arrow-right"></i>
                  </a>
                </li>
              </ul>
            </li>
 -->
            <!-- <li class="purple dropdown-modal">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                <span class="badge badge-important">8</span>
              </a>

              <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                <li class="dropdown-header">
                  <i class="ace-icon fa fa-exclamation-triangle"></i>
                  8 Notifications
                </li>

                <li class="dropdown-content">
                  <ul class="dropdown-menu dropdown-navbar navbar-pink">
                    <li>
                      <a href="#">
                        <div class="clearfix">
                          <span class="pull-left">
                            <i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
                            New Comments
                          </span>
                          <span class="pull-right badge badge-info">+12</span>
                        </div>
                      </a>
                    </li>

                    <li>
                      <a href="#">
                        <i class="btn btn-xs btn-primary fa fa-user"></i>
                        Bob just signed up as an editor ...
                      </a>
                    </li>

                    <li>
                      <a href="#">
                        <div class="clearfix">
                          <span class="pull-left">
                            <i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
                            New Orders
                          </span>
                          <span class="pull-right badge badge-success">+8</span>
                        </div>
                      </a>
                    </li>

                    <li>
                      <a href="#">
                        <div class="clearfix">
                          <span class="pull-left">
                            <i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
                            Followers
                          </span>
                          <span class="pull-right badge badge-info">+11</span>
                        </div>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="dropdown-footer">
                  <a href="#">
                    See all notifications
                    <i class="ace-icon fa fa-arrow-right"></i>
                  </a>
                </li>
              </ul>
            </li> -->

            <!-- <li class="green dropdown-modal">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                <span class="badge badge-success">5</span>
              </a>

              <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                <li class="dropdown-header">
                  <i class="ace-icon fa fa-envelope-o"></i>
                  5 Messages
                </li>

                <li class="dropdown-content">
                  <ul class="dropdown-menu dropdown-navbar">
                    <li>
                      <a href="#" class="clearfix">
                        <img src="assets/images/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
                        <span class="msg-body">
                          <span class="msg-title">
                            <span class="blue">Alex:</span>
                            Ciao sociis natoque penatibus et auctor ...
                          </span>

                          <span class="msg-time">
                            <i class="ace-icon fa fa-clock-o"></i>
                            <span>a moment ago</span>
                          </span>
                        </span>
                      </a>
                    </li>

                    <li>
                      <a href="#" class="clearfix">
                        <img src="assets/images/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                        <span class="msg-body">
                          <span class="msg-title">
                            <span class="blue">Susan:</span>
                            Vestibulum id ligula porta felis euismod ...
                          </span>

                          <span class="msg-time">
                            <i class="ace-icon fa fa-clock-o"></i>
                            <span>20 minutes ago</span>
                          </span>
                        </span>
                      </a>
                    </li>

                    <li>
                      <a href="#" class="clearfix">
                        <img src="assets/images/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
                        <span class="msg-body">
                          <span class="msg-title">
                            <span class="blue">Bob:</span>
                            Nullam quis risus eget urna mollis ornare ...
                          </span>

                          <span class="msg-time">
                            <i class="ace-icon fa fa-clock-o"></i>
                            <span>3:15 pm</span>
                          </span>
                        </span>
                      </a>
                    </li>

                    <li>
                      <a href="#" class="clearfix">
                        <img src="assets/images/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
                        <span class="msg-body">
                          <span class="msg-title">
                            <span class="blue">Kate:</span>
                            Ciao sociis natoque eget urna mollis ornare ...
                          </span>

                          <span class="msg-time">
                            <i class="ace-icon fa fa-clock-o"></i>
                            <span>1:33 pm</span>
                          </span>
                        </span>
                      </a>
                    </li>

                    <li>
                      <a href="#" class="clearfix">
                        <img src="assets/images/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
                        <span class="msg-body">
                          <span class="msg-title">
                            <span class="blue">Fred:</span>
                            Vestibulum id penatibus et auctor  ...
                          </span>

                          <span class="msg-time">
                            <i class="ace-icon fa fa-clock-o"></i>
                            <span>10:09 am</span>
                          </span>
                        </span>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="dropdown-footer">
                  <a href="inbox.html">
                    See all messages
                    <i class="ace-icon fa fa-arrow-right"></i>
                  </a>
                </li>
              </ul>
            </li>     -->      
            <li><a href="<?php echo base_url() ?>login/keluar" style="color: #fff;background-color: transparent;">Logout</a></li>
          </ul>
        </div>
      </div><!-- /.navbar-container -->
    </div>

    <div class="main-container ace-save-state" id="main-container">
      <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
      </script>

      <div id="sidebar" class="sidebar responsive ace-save-state">
        <script type="text/javascript">
          try{ace.settings.loadState('sidebar')}catch(e){}
        </script>

        <div class="user-panel pb-3 mb-3 d-flex" style="background-color: #101067;padding-top: 10px">
          <div class="image">
            <?php
              $image_profile= base_url(). "assets/profile/". $this->session->userdata('user_nik') .".jpg";
              // if(!is_file($image_profile)){
              //     $image_profile= "http://hrsmartpro.com/assets/profile/no-profile-copy.png";
              // }
            ?>
            
            <img src="<?= $image_profile ?>" class="img-circle elevation-2" alt="User Image" style="margin-top: 15px">
          </div>
          <div class="info">
            <a href="profile" class="d-block" style="color: #fff"><?php echo $this->session->userdata('user_name'); ?></a>
            <span style="color: #fff"><?php echo $this->session->userdata('user_nik'); ?></span><br>
            <span class="text-profile" style="color: #fff;font-size: 9px;"><?php echo $this->session->userdata('posisi'); ?></span>
          </div>
        </div>

        <ul class="nav nav-list">
          <!-- <li class="active">
            <a href="index.html">
              <i class="menu-icon fa fa-tachometer"></i>
              <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-desktop"></i>
              <span class="menu-text">
                Organization
              </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
              <li class="">
                <a href="typography.html">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Organization
                </a>

                <b class="arrow"></b>
              </li>
            </ul>
          </li> -->
          <?php
              print_r($menu);
          ?>
        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
          <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
      </div>

      <div class="main-content">
        <div class="main-content-inner">
          
            <?php 
            if ($this->router->fetch_class() != 'home'){            
                $this->load->view($main); 
            }
            else {                  
                $this->load->view('home/index'); 
            } 
            ?>  
        </div>
      </div><!-- /.main-content -->

      <div class="footer">
        <div class="footer-inner">
          <div class="footer-content">
            <span class="bigger-120">
              <span class="blue bolder">HRSmartpro</span>
              Application &copy; 2013-2014
            </span>

            &nbsp; &nbsp;
            <span class="action-buttons">
              <a href="#">
                <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
              </a>

              <a href="#">
                <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
              </a>

              <a href="#">
                <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
              </a>
            </span>
          </div>
        </div>
      </div>

      <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
      </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="<?= base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>

    <!-- <![endif]-->

    <!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
      <script src="assets/js/excanvas.min.js"></script>
    <![endif]-->
    <script src="<?= base_url(); ?>assets/js/jquery-ui.custom.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.easypiechart.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.sparkline.index.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.flot.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.flot.pie.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.flot.resize.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.jqGrid.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootbox.js"></script>
    <script src="<?= base_url(); ?>assets/js/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap-timepicker.min.js"></script>
    
    <script src="<?= base_url(); ?>assets/js/daterangepicker.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/chosen.jquery.min.js"></script>
    
    <script src="<?= base_url(); ?>assets/js/grid.locale-en.js"></script>
    <!-- <script src="<?= base_url(); ?>assets/js/tree.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

    <script src="<?= base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/dataTables.buttons.min.js"></script>

    <!-- <script src="<?= base_url(); ?>assets/js/buttons.flash.min.js"></script> -->
    <!-- <script src="<?= base_url(); ?>assets/js/buttons.html5.min.js"></script> -->


    
    <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
     <script src="<?= base_url(); ?>assets/js/buttons.print.min.js"></script>

    <script src="<?= base_url(); ?>assets/js/dataTables.select.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap-timepicker.min.js"></script>


    <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script> -->
    
    <!-- ace scripts -->
    <script src="<?= base_url(); ?>assets/js/ace-elements.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/ace.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.price_format.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/fullcalendar.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.gritter.min.js"></script>
    <!-- inline scripts related to this page -->


    <?php if($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1' || $_SERVER['SERVER_NAME'] == '::1') : ?>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/vue.js"></script>
    <?php else : ?>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/vue.min.js"></script>
    <?php endif; ?>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/vuedraggable.min.js"></script>

    <script type="text/javascript">
      $.ajaxSetup({
        data: {
            csrf_token: <?php echo "'". $this->security->get_csrf_hash()."'" ?>
        }
    });
      function showloader(val){
        $(val).append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
      }
      function hideloader(){
        $( "#loadingDiv" ).fadeOut(500, function() {
            $( "#loadingDiv" ).remove(); 
          }); 
      }

      function bootboxmodal(title, html){
        var dialog = bootbox.dialog({
          title: title,
          message: html,
          buttons: {}
        });
      }

      function alertok(judul){
          $.gritter.add({
            title: judul,
            text: '',
            class_name: 'gritter-info gritter-center',
            time : 3000,
          });
      
          return false;
      }
      function alerterror(judul){
          $.gritter.add({
            title: 'Error',
            text: judul,
            class_name: 'gritter-error gritter-center'
          });
      
          return false;
      }

      function chosen(){
        $('.chosen-select').chosen({allow_single_deselect:true}); 
        //resize the chosen on window resize

        $(window).off('resize.chosen')
        .on('resize.chosen', function() {
          $('.chosen-select').each(function() {
             var $this = $(this);
             $this.next().css({'width': '100%'});
          })
        }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
          if(event_name != 'sidebar_collapsed') return;
          $('.chosen-select').each(function() {
             var $this = $(this);
             $this.next().css({'width': $this.parent().width()});
          })
        });
      }
      chosen();
    </script>
    <?php
      $this->load->view($js); 
    ?>
</body>

</html>
