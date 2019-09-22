<script src="<?= base_url(); ?>assets/js/chart/Chart.min.js"></script>
<script type="text/javascript">
  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')
  var salesChart  = new Chart($salesChart, {
    type   : 'bar',
    data   : {
      labels  : ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
          data           : [1000, 2000, 3000, 2500, 2700, 2500, 3000]
        },
        {
          backgroundColor: '#ced4da',
          borderColor    : '#ced4da',
          data           : [700, 1700, 2700, 2000, 1800, 1500, 2000]
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
              return '$' + value
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

  var $visitorsChart = $('#visitors-chart')
  var visitorsChart  = new Chart($visitorsChart, {
    data   : {
      labels  : ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
      datasets: [{
        type                : 'line',
        data                : [100, 120, 170, 167, 180, 177, 160],
        backgroundColor     : 'transparent',
        borderColor         : '#007bff',
        pointBorderColor    : '#007bff',
        pointBackgroundColor: '#007bff',
        fill                : false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
        {
          type                : 'line',
          data                : [60, 80, 70, 67, 80, 77, 100],
          backgroundColor     : 'tansparent',
          borderColor         : '#ced4da',
          pointBorderColor    : '#ced4da',
          pointBackgroundColor: '#ced4da',
          fill                : false
          // pointHoverBackgroundColor: '#ced4da',
          // pointHoverBorderColor    : '#ced4da'
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