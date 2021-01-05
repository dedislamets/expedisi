<!DOCTYPE html>
<html lang="en">
  
<head>
    <title>E-Tracking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url(); ?>assets\images\favicon.png" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\icon\icofont\css\icofont.css">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\bower_components\bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\bower_components\jquery-ui\css\jquery-ui.min.css">

    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\icon\feather\css\feather.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\pages\data-table\extensions\buttons\css\buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets\bower_components\select2\css\select2.min.css">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\css\jquery.mCustomScrollbar.css">
    <link href="assets/css/gsdk-bootstrap-wizard.css" rel="stylesheet" />


    <style type="text/css">
        .mb-0{
            margin-bottom: 0;
        }
        .hidden {
            display: none;
        }
      .ui-autocomplete { z-index:2147483647; }
      .pcoded .pcoded-header[header-theme="theme1"] {
          /*background: #d62b2b;*/
          background:#243452;
          color: #fff;
      }
      .pcoded .pcoded-navbar[navbar-theme="theme1"] .main-menu {
          opacity: 0.8;
          height: 100% !important;
      }
      .pcoded .pcoded-header .navbar-logo[logo-theme="theme1"] {
          /*background-color: #d10a0a;*/
      }
      .bg-c-lite-green {
        background: linear-gradient(to right, #E40405, #FA3B3B);
      }
      .bg-simple-c-pink {
          background: #eb3422 !important;
      }

      .sidebar-background {
        position: absolute;
        z-index: 1;
        height: 100%;
        width: 100%;
        display: block;
        top: 0;
        left: 0;
        background-size: cover;
        background-position: 50%;
      }
      .sidebar-background:after {
          background: #f44336;
          opacity: .8;
      }
      .nav>li>a {
          position: relative;
          display: block;
          padding: 10px 15px;
      }
      .wizard-card .info-text {
          text-align: center;
          font-weight: 300;
          margin: 10px 0 30px;
          width: 100%;
      }
      .pull-right {
          float: right;
      }
      .pull-left {
          float: left;
      }
      @media (min-width: 768px){
        .col-sm-offset-1 {
            margin-left: 8.33333333%;
        }
      }
      .col-sm-offset-2 {
        margin-left: 16.66666667%;
      }
      .nav-pills > li > a {
        background-color: #404E67;
      }
    </style>
  </head>
<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="index-1.htm">
                            <img class="img-fluid" src="<?= base_url(); ?>assets\images\logo.png" alt="Theme-Logo">
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <!-- <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                    </div>
                                </div>
                            </li> -->
                            <!-- <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li> -->
                            <li><h3 style="padding-top: 10px;padding-left: 10px;">E-Tracking Sistem Management - Pusat</h3></li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-bell"></i>
                                        <span class="badge bg-c-pink">5</span>
                                    </div>
                                    <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <h6>Notifications</h6>
                                            <label class="label label-danger">New</label>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center img-radius" src="<?= base_url(); ?>assets\images\avatar-4.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">John Doe</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center img-radius" src="<?= base_url(); ?>assets\images\avatar-3.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">Joseph William</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center img-radius" src="<?= base_url(); ?>assets\images\avatar-4.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">Sara Soudein</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-message-square"></i>
                                        <span class="badge bg-c-green">3</span>
                                    </div>
                                </div>
                            </li>
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?= base_url(); ?>assets\images\avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                        <span>John Doe</span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="#!">
                                                <i class="feather icon-settings"></i> Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="user-profile.htm">
                                                <i class="feather icon-user"></i> Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="email-inbox.htm">
                                                <i class="feather icon-mail"></i> My Messages
                                            </a>
                                        </li>
                                        <li>
                                            <a href="auth-lock-screen.htm">
                                                <i class="feather icon-lock"></i> Lock Screen
                                            </a>
                                        </li>
                                        <li>
                                            <a href="auth-normal-sign-in.htm">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Sidebar inner chat start-->
            <div class="showChat_inner">
                <div class="media chat-inner-header">
                    <a class="back_chatBox">
                        <i class="feather icon-chevron-left"></i> Josephin Doe
                    </a>
                </div>
                <div class="media chat-messages">
                    <a class="media-left photo-table" href="#!">
                        <img class="media-object img-radius img-radius m-t-5" src="<?= base_url(); ?>assets\images\avatar-3.jpg" alt="Generic placeholder image">
                    </a>
                    <div class="media-body chat-menu-content">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                </div>
                <div class="media chat-messages">
                    <div class="media-body chat-menu-reply">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                    <div class="media-right photo-table">
                        <a href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="<?= base_url(); ?>assets\images\avatar-4.jpg" alt="Generic placeholder image">
                        </a>
                    </div>
                </div>
                <div class="chat-reply-box p-b-20">
                    <div class="right-icon-control">
                        <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
                        <div class="form-icon">
                            <i class="feather icon-navigation"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <? $this->load->view('nav'); ?>
                    
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-body breadcrumb-page">
                                        
                                            <?php 
                                            if ($this->router->fetch_class() != 'home'){            
                                                $this->load->view($main); 
                                            }
                                            else {                  
                                                $this->load->view('home/index'); 
                                            } 
                                            ?> 
                                      
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="<?= base_url(); ?>assets\bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets\bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets\bower_components\bootstrap\js\bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?= base_url(); ?>assets\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?= base_url(); ?>assets\bower_components\modernizr\js\modernizr.js"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="<?= base_url(); ?>assets\bower_components\chart.js\js\Chart.js"></script>
    <!-- amchart js -->
    <script src="<?= base_url(); ?>assets\pages\widget\amchart\amcharts.js"></script>
    <script src="<?= base_url(); ?>assets\pages\widget\amchart\serial.js"></script>
    <script src="<?= base_url(); ?>assets\pages\widget\amchart\light.js"></script>
    <script src="<?= base_url(); ?>assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets\js\SmoothScroll.js"></script>
    <script src="<?= base_url(); ?>assets\js\pcoded.min.js"></script>
    <!-- custom js -->
    <script src="<?= base_url(); ?>assets\js\vartical-layout.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets\pages\dashboard\custom-dashboard.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets\js\script.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>

    <!--  Plugin for the Wizard -->
    <script src="<?= base_url(); ?>assets/js/gsdk-bootstrap-wizard.js"></script>

    <!-- data-table js -->
    <script src="<?= base_url(); ?>assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>assets\pages\data-table\extensions\buttons\js\buttons.flash.min.js"></script>
    <script src="<?= base_url(); ?>assets\pages\data-table\js\jszip.min.js"></script>
    <script src="<?= base_url(); ?>assets\pages\data-table\js\pdfmake.min.js"></script>
    <script src="<?= base_url(); ?>assets\pages\data-table\js\vfs_fonts.js"></script>
    <script src="<?= base_url(); ?>assets\bower_components\datatables.net-buttons\js\buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>assets\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets\pages\data-table\extensions\buttons\js\extension-btns-custom.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets\bower_components\select2\js\select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <!-- <script type="text/javascript" src="<?= base_url(); ?>assets\pages\advance-elements\select2-custom.js"></script> -->

    <script type="text/javascript">
        function alertOK(href="") {
           Swal.fire({ title: "Berhasil disimpan..!",
               text: "",
               timer: 2000,
               icon: 'success',
               showConfirmButton: false,
               willClose: () => {
                 if(href != "")
                    href;
              }
            });
        }

        function alertError(textError = "'Silahkan cek kembali data anda!'") {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: textError,
              showConfirmButton: false,
              timer: 2000,
            })
        }
    </script>
    <? $this->load->view($js); ?> 
</body>

</html>
