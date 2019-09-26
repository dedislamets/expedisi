<script src="<?= base_url(); ?>assets/js/chart/Chart.min.js"></script>
<script src="<?= base_url(); ?>assets/js/flot/jquery.flot.js"></script>
<script src="<?= base_url(); ?>assets/js/flot-old/jquery.flot.resize.min.js"></script>
<script src="<?= base_url(); ?>assets/js/flot-old/jquery.flot.pie.min.js"></script>
<script type="text/javascript">
  $('#carouselHacked').carousel();
  $('#onleave').carousel();

  $("#dashboard_category").val(1).trigger('chosen:updated');
  $("#category_period").val(1).trigger('chosen:updated');
  $("#periode_start").prop("disabled", true);
  $("#periode_end").prop("disabled", true);

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index';
  var intersect = true;

  donat_chart(1);
  chart_one(8);
  chart_two(11);
  chart_three(10);

  function donat_chart(recnum){
    $.get("<?php echo base_url(); ?>Home/generateDashboard",{recnum: recnum }, function(data){  
      var donutData =[];
      $("#judul-donat").text(data['judul']);
      for (var i = 0; i < data['data'].length; i++) {
        donutData.push({
          label : data['data'][i]['IsDesc'],
          data : (data['data'][i]['TotalData']== undefined ? data['data'][i]['Total']:data['data'][i]['TotalData'])
        })
      }
      $.plot('#donut-chart', donutData, {
        series: {
          pie: {
            show       : true,
            radius     : 1,
            innerRadius: 0.5,
            label      : {
              show     : true,
              radius   : 2 / 3,
              formatter: labelFormatter,
              background: { 
                  opacity: 0.5,
                  color: '#000'
              }
            }

          }
        },
        legend: {
          show: false
        }
      })
    });
  }

  function chart_one(recnum){
    $.get("<?php echo base_url(); ?>Home/generateDashboard",{recnum: recnum }, function(arr_data){  
      var $chartone = $('#chart-one');
      var labels =[];
      var datas =[];
      $("#judul-chart-one").text(arr_data['judul']);
      for (var i = 0; i < arr_data['data'].length; i++) {
        labels.push(arr_data['data'][i]['IsDesc']);
        datas.push((arr_data['data'][i]['TotalData']== undefined ? arr_data['data'][i]['Total']:arr_data['data'][i]['TotalData']));
      }
      var visitorsChart  = new Chart($chartone, {
        data   : {
          labels  : labels,
          datasets: [{
            type                : 'line',
            data                : datas,
            backgroundColor     : 'transparent',
            borderColor         : '#007bff',
            pointBorderColor    : '#007bff',
            pointBackgroundColor: '#007bff',
            fill                : false,
            pointHoverBackgroundColor: '#007bff',
            pointHoverBorderColor    : '#007bff'
          }]
        },
        options: {
          maintainAspectRatio: false,
          tooltips           : {
            mode     : mode,
            intersect: intersect
          },
          hover              : {
            mode     : mode,
            intersect: intersect
          },
          legend             : {
            display: false
          },
          scales             : {
            yAxes: [{
              // display: false,
              gridLines: {
                display      : true,
                lineWidth    : '4px',
                color        : 'rgba(0, 0, 0, .2)',
                zeroLineColor: 'transparent'
              },
              ticks    : $.extend({
                beginAtZero : true,
                suggestedMax: 200
              }, ticksStyle)
            }],
            xAxes: [{
              display  : true,
              gridLines: {
                display: false
              },
              ticks    : ticksStyle
            }]
          }
        }
      })
    });
  }

  function chart_two(recnum){
    $.get("<?php echo base_url(); ?>Home/generateDashboard",{recnum: recnum }, function(arr_data){  
        var labels =[];
        var datas =[];
        $("#judul-chart-two").text(arr_data['judul']);
        for (var i = 0; i < arr_data['data'].length; i++) {
          labels.push(arr_data['data'][i]['IsDesc']);
          datas.push((arr_data['data'][i]['TotalData']== undefined ? arr_data['data'][i]['Total']:arr_data['data'][i]['TotalData']));
        }
        var $salesChart = $('#chart-two');
        var salesChart  = new Chart($salesChart, {
          type   : 'bar',
          data   : {
            labels  : labels,
            datasets: [
              {
                backgroundColor: '#007bff',
                borderColor    : '#007bff',
                data           : datas
              }
            ]
          },
          options: {
            maintainAspectRatio: false,
            tooltips           : {
              mode     : mode,
              intersect: intersect
            },
            hover              : {
              mode     : mode,
              intersect: intersect
            },
            legend             : {
              display: false
            },
            scales             : {
              yAxes: [{
                // display: false,
                gridLines: {
                  display      : true,
                  lineWidth    : '4px',
                  color        : 'rgba(0, 0, 0, .2)',
                  zeroLineColor: 'transparent'
                },
                ticks    : $.extend({
                  beginAtZero: true,

                  // Include a dollar sign in the ticks
                  callback: function (value, index, values) {
                    if (value >= 1000) {
                      value /= 1000
                      value += 'k'
                    }
                    return  value
                  }
                }, ticksStyle)
              }],
              xAxes: [{
                display  : true,
                gridLines: {
                  display: false
                },
                ticks    : ticksStyle
              }]
            }
          }
        })

    })
  }
  function chart_three(recnum){
    $.get("<?php echo base_url(); ?>Home/generateDashboard",{recnum: recnum }, function(arr_data){  
        var labels =[];
        var datas =[];
        $("#judul-chart-three").text(arr_data['judul']);
        for (var i = 0; i < arr_data['data'].length; i++) {
          labels.push(arr_data['data'][i]['IsDesc']);
          datas.push((arr_data['data'][i]['TotalData']== undefined ? arr_data['data'][i]['Total']:arr_data['data'][i]['TotalData']));
        }
        
        var areaChartCanvas = $('#chart-three').get(0).getContext('2d')

        var areaChartData = {
          labels  : labels,
          datasets: [
            {
              label               : 'Digital Goods',
              backgroundColor     : 'rgba(60,141,188,0.9)',
              borderColor         : 'rgba(60,141,188,0.8)',
              pointRadius          : false,
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : datas
            }
          ]
        }

        var areaChartOptions = {
          maintainAspectRatio : false,
          responsive : true,
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              gridLines : {
                display : true,
              }
            }],
            yAxes: [{
              gridLines : {
                display : false,
              }
            }]
          }
        }

        // This will get the first returned node in the jQuery collection.
        var areaChart       = new Chart(areaChartCanvas, { 
          type: 'line',
          data: areaChartData, 
          options: areaChartOptions
        })

        //-------------
        //- LINE CHART -
        //--------------
        var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
        var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
        var lineChartData = jQuery.extend(true, {}, areaChartData)
        lineChartData.datasets[0].fill = false;
        lineChartData.datasets[1].fill = false;
        lineChartOptions.datasetFill = false

        var lineChart = new Chart(lineChartCanvas, { 
          type: 'line',
          data: lineChartData, 
          options: lineChartOptions
        })
    })
  }

  function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }

  var d = new Date();
  $('.date-picker').datepicker({
      autoclose: true,
      todayHighlight: true
    });
    $("#periode_start").datepicker("setDate", d);
    $("#periode_end").datepicker("setDate", d);

  
  
</script>
<script type="text/javascript">
      $.ajaxSetup({
                data: {
                    csrf_token: <?php echo "'". $this->security->get_csrf_hash()."'" ?>
                }
            });     
      jQuery(function($) {
        
        /////////////////////////////////////
        $(document).one('ajaxloadstart.page', function(e) {
          $tooltip.remove();
        });
      
      
      
      
        var d1 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
          d1.push([i, Math.sin(i)]);
        }
      
        var d2 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
          d2.push([i, Math.cos(i)]);
        }
      
        var d3 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.2) {
          d3.push([i, Math.tan(i)]);
        }
        
      
        
      
        $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
          var $source = $(source);
          var $parent = $source.closest('.tab-content')
          var off1 = $parent.offset();
          var w1 = $parent.width();
      
          var off2 = $source.offset();
          //var w2 = $source.width();
      
          if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
          return 'left';
        }
      
      
        $('.dialogs,.comments').ace_scroll({
          size: 300
          });
        
        
        //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
        //so disable dragging when clicking on label
        var agent = navigator.userAgent.toLowerCase();
        if(ace.vars['touch'] && ace.vars['android']) {
          $('#tasks').on('touchstart', function(e){
          var li = $(e.target).closest('#tasks li');
          if(li.length == 0)return;
          var label = li.find('label.inline').get(0);
          if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
          });
        }
      
        $('#tasks').sortable({
          opacity:0.8,
          revert:true,
          forceHelperSize:true,
          placeholder: 'draggable-placeholder',
          forcePlaceholderSize:true,
          tolerance:'pointer',
          stop: function( event, ui ) {
            //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
            $(ui.item).css('z-index', 'auto');
          }
          }
        );
        $('#tasks').disableSelection();
        $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
          if(this.checked) $(this).closest('li').addClass('selected');
          else $(this).closest('li').removeClass('selected');
        });
      
      
        //show the dropdowns on top or bottom depending on window height and menu position
        $('#task-tab .dropdown-hover').on('mouseenter', function(e) {
          var offset = $(this).offset();
      
          var $w = $(window)
          if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
            $(this).addClass('dropup');
          else $(this).removeClass('dropup');
        });
      
      })
    </script>