<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Dashboard - Ace Admin</title>

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
    <!-- text fonts -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <script src="<?= base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- ace settings handler -->
    <script src="<?= base_url(); ?>assets/js/ace-extra.min.js"></script>
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

    <script src="<?= base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/buttons.flash.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/buttons.colVis.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/dataTables.select.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap-timepicker.min.js"></script>
    
    <!-- ace scripts -->
    <script src="<?= base_url(); ?>assets/js/ace-elements.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/ace.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.price_format.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/fullcalendar.min.js"></script>
    <style type="text/css">
        .clearfix{
            clear: both;
            display: block;
          }
          .form-group{
            margin-bottom: 0;
          }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-sm-12">
            
                <div class="table-header" style="padding: 10px">
                    <div class="alert alert-block alert-info clearfix" style="margin-bottom: 0">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group" >
                                    <label class="col-md-3 control-label no-padding-right">Emp ID</label>
                                    <div class="col-md-8 ui-front">
                                        <input type="text" class="form-control" name="empid" value="" id="empid">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label class="col-md-3 control-label no-padding-right">Emp Name</label>
                                    <div class="col-md-8 ui-front">
                                        <input type="text" class="form-control" name="emp_name" value="" id="emp_name">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label class="col-md-3 control-label no-padding-right">Emp Name</label>
                                    <div class="col-md-8 ui-front">
                                        <input type="text" class="form-control" name="emp_name" value="" id="emp_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label no-padding-right">Join Date</label>
                                    <div class="col-md-8 ui-front">
                                      <div class="input-group">
                                        <input class="form-control date-picker" id="jd_start" name="jd_start" type="text" data-date-format="dd-mm-yyyy" />
                                        <span class="input-group-addon">
                                          <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 ui-front">
                                      <div class="input-group">
                                        <input class="form-control date-picker" id="jd_end" name="jd_end" type="text" data-date-format="dd-mm-yyyy" />
                                        <span class="input-group-addon">
                                          <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label no-padding-right">Age</label>
                                    <div class="col-md-8 ui-front">
                                      <div id="slider-range"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label no-padding-right">Date Alert</label>
                                    <div class="col-md-8 ui-front">
                                      <div class="input-group">
                                        <input class="form-control date-picker" id="alert_start" name="alert_start" type="text" data-date-format="dd-mm-yyyy" />
                                        <span class="input-group-addon">
                                          <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 ui-front">
                                      <div class="input-group">
                                        <input class="form-control date-picker" id="alert_end" name="alert_end" type="text" data-date-format="dd-mm-yyyy" />
                                        <span class="input-group-addon">
                                          <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label no-padding-right">Resign Date</label>
                                    <div class="col-md-8 ui-front">
                                      <div class="input-group">
                                        <input class="form-control date-picker" id="resign_start" name="resign_start" type="text" data-date-format="dd-mm-yyyy" />
                                        <span class="input-group-addon">
                                          <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 ui-front">
                                      <div class="input-group">
                                        <input class="form-control date-picker" id="resign_end" name="resign_end" type="text" data-date-format="dd-mm-yyyy" />
                                        <span class="input-group-addon">
                                          <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Organization</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="organization" name="organization" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($location as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Organization Secondary</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="organization_secondary" name="organization_secondary" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($location as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Position Structural</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="position_structural" name="position_structural" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($location as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Position Structural Sec</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="position_structural_secondary" name="position_structural_secondary" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($location as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Position Functional</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="position_functional" name="position_functional" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($location as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Position Functional Sec</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="position_functional_secondary" name="position_functional_secondary" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($location as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Head 1</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="head1" name="head1" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($location as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>

                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Head 2</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="head2" name="head2" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($location as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Mentor</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="mentor" name="mentor" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($location as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Admin HR</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="admin_hr" name="admin_hr" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($location as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Secretary</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="secretary" name="secretary" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($location as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Location</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="location" name="location" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($location as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">COA</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="coa" name="coa" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($coa as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Class</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="class" name="class" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($class as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Golongan</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="golongan" name="golongan" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($golongan as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Grade</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="grade" name="grade" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($grade as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Rank</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="rank" name="rank" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($rank as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Working Status</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="ws" name="ws" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($working_status as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Blood</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="blood" name="blood" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($blood as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Gender</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="gender" name="gender" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($gender as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Religion</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="religion" name="religion" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($religion as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label no-padding-right">Resign Type</label>
                                  <div class="col-md-8 ui-front">
                                    <select class="chosen-select form-control" id="resign" name="resign" multiple="">
                                      <option value="0"> - </option>
                                      <?php 
                                      foreach($resign_type as $row)
                                      { 
                                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
        <!-- <div class="col-sm-12">
            <table id="myTable" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Emp ID</th>
                        <th>Emp Name</th>
                        <th>Join Date</th>
                        <th>Age </th>
                        <th>Gender</th>
                        <th>Organization</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div> -->
    </div>
    

    <script type="text/javascript">
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
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
        $( "#slider-range" ).slider({
            orientation: "horizontal",
            range: true,
            min: 0,
            max: 100,
            values: [ 17, 67 ],
            slide: function( event, ui ) {
                var val = ui.values[$(ui.handle).index()-1] + "";
    
                if( !ui.handle.firstChild ) {
                    $("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
                    .prependTo(ui.handle);
                }
                $(ui.handle.firstChild).show().children().eq(1).text(val);
            }
        }).find('span.ui-slider-handle').on('blur', function(){
            $(this.firstChild).hide();
        });
        // $(document).ready( function () {
        //     $('#myTable').DataTable({
        //         ajax: {                 
        //             "url": "find",
        //             "type": "GET"
        //         },  
        //         columnDefs:[
        //                     {
        //                         targets:2, render:function(data){
        //                             return moment(data).format('DD MMM YYYY'); 
        //                         }
        //                     },
        //                     { "width": "130px", "targets": [1] }
        //             ],
        //     });
        // });
    </script>
</body>
</html>

