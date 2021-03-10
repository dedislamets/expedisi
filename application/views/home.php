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
    <link rel="icon" href="<?= base_url(); ?>assets\images\cropped-logo-wml-32x32.png" type="image/x-icon">
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
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/pages/social-timeline/timeline.css">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\css\jquery.mCustomScrollbar.css">
    <link href="<?= base_url(); ?>assets/css/gsdk-bootstrap-wizard.css" rel="stylesheet" />
    <!-- <link href="<?= base_url(); ?>assets/pages/jquery.filer/css/jquery.filer.css" type="text/css" rel="stylesheet" /> -->
    <!-- <link href="<?= base_url(); ?>assets/pages/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" /> -->
    <link href="<?= base_url(); ?>assets/css/dropzone.min.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/bower_components/switchery/css/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/bower_components/jstree/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/pages/treeview/treeview.css">


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
      /*.pcoded .pcoded-navbar[navbar-theme="theme1"] .main-menu {
          opacity: 0.8;
          height: 100% !important;
      }*/
      .pcoded .pcoded-header .navbar-logo[logo-theme="theme1"] {
          background-color: #cfd1d3;
      }
        .bg-c-lite-green {
            background: linear-gradient(to right, #E40405, #FA3B3B);
        }
        .bg-simple-c-pink {
          background: #eb3422 !important;
        }
        .bg-simple-c-green {
            background: #0ac282 !important;
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
                            <img class="img-fluid" src="<?= base_url(); ?>assets\images\logo-wml-1.1.png" alt="Theme-Logo">
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
                            <li><h3 style="padding-top: 10px;padding-left: 10px;">E-SYSTEM WML - REGIONAL <?= $this->session->userdata('cabang') ?></h3></li>
                        </ul>
                        <ul class="nav-right">
                            
                            <li class="header-notification" style="margin-top: 10px;">
                                <select name="role" id="role" class="form-control" style="background-color: #243452;color: #fff;border: none;">
                                <?php 
                                  foreach(ChangeRole() as $row)
                                  { 
                                    if( $this->session->userdata('role_id') === $row->id_group_role){
                                        echo '<option value="'.$row->id_group_role.'" selected >'.$row->group.'</option>';
                                    }else{ 
                                        echo '<option value="'.$row->id_group_role.'">'.$row->group.'</option>';
                                    }
                                  }
                                ?>
                                </select>
                            </li>
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <? if($this->session->userdata('gender') == "Pria"): ?>
                                            <img src="<?= base_url(); ?>assets\images\avaco.png" class="img-radius" alt="User-Profile-Image">
                                        <? else: ?>
                                           <img src="<?= base_url(); ?>assets\images\avace.png" class="img-radius" alt="User-Profile-Image">
                                        <? endif; ?>
                                        <span><?= $this->session->userdata('username') ?></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                                        <li>
                                            <a href="user-profile.htm">
                                                <i class="feather icon-user"></i> Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>login/keluar">
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
                                            // print("<pre>".print_r($this->session->userdata('role_id'),true)."</pre>");
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
    <!-- <script type="text/javascript" src="<?= base_url(); ?>assets\pages\dashboard\custom-dashboard.js"></script> -->
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
    <script type="text/javascript" src="<?= base_url(); ?>assets\bower_components\switchery\js\switchery.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/bower_components/jstree/js/jstree.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDG6gW-g3Tv-5WtfghXA8y2MKt9RAaW5E&callback=initialize" async defer></script>
    <!-- <script src="<?= base_url(); ?>assets/pages/jquery.filer/js/jquery.filer.min.js"></script>
    <script src="<?= base_url(); ?>assets/pages/filer/jquery.fileuploads.init.js" type="text/javascript"></script> -->
    <!-- <script type="text/javascript" src="<?= base_url(); ?>assets\pages\advance-elements\select2-custom.js"></script> -->
    <script type="text/javascript" src="<?= base_url(); ?>assets\js\dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>


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

        $('#role').on('change', function (event) {
            window.location.href= "<?= base_url() ?>login/ChangeAccess/" + $(this).val();
            // alert($(this).val())
        });
    </script>
    <? $this->load->view($js); ?> 
</body>

</html>
