<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Dashboard - Ace Admin</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ui.jqgrid.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/chosen.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/fullcalendar.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/fonts.googleapis.com.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <script src="<?= base_url(); ?>assets/js/ace-extra.min.js"></script>
    <style type="text/css">
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
    </style>
  </head>

  <body class="no-skin">
    <?php 
        if ($this->router->fetch_class() != 'iframe'){            
            $this->load->view($main); 
        }
    ?>  
    <script src="<?= base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
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
    <script src="<?= base_url(); ?>assets/js/buttons.flash.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/buttons.colVis.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/dataTables.select.min.js"></script>
    
    <!-- ace scripts -->
    <script src="<?= base_url(); ?>assets/js/ace-elements.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/ace.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.price_format.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/fullcalendar.min.js"></script>

    <script type="text/javascript">
      $.ajaxSetup({
        data: {
            csrf_token: <?php echo "'". $this->security->get_csrf_hash()."'" ?>
        }
    });
    </script>
  
</body>

</html>
