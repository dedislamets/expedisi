<script src="<?= base_url(); ?>assets/js/chart/Chart.min.js"></script>
<script src="<?= base_url(); ?>assets/js/flot/jquery.flot.js"></script>
<script src="<?= base_url(); ?>assets/js/flot-old/jquery.flot.resize.min.js"></script>
<script src="<?= base_url(); ?>assets/js/flot-old/jquery.flot.pie.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/google/loader.js"></script>

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<script type="text/javascript">
  $(document).ready(function(){ 
    
    //Combo chart
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Vendor', 'Customer'],
            ['2004/05', 165, 938],
            ['2005/06', 135, 1120],
            ['2006/07', 157, 1167],
            ['2007/08', 139, 1110],
            ['2008/09', 136, 691]
        ]);

        var options = {
            vAxis: { title: 'Payment' },
            hAxis: { title: 'Month' },
            seriesType: 'bars',
            // series: { 2: { type: 'line' } },
            colors: ['#93BE52', '#69CEC6', '#FE8A7D']
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_Combo'));
        chart.draw(data, options);
    }


    var chartData = <?php echo $chart_rs; ?>;
    AmCharts.makeChart(
    "proj-earning",
    {
      type:"serial",
      hideCredits:!0,
      theme:"light",
      dataProvider: chartData,
      valueAxes:[
        {
          gridAlpha:.3,
          gridColor:"#fff",
          axisColor:"transparent",
          color:"#fff",dashLength:0
        }]
      ,gridAboveGraphs:!0,
      startDuration:1,
      graphs:[
        {
          balloonText:"Total Routing: <b>[[value]]</b>",
          fillAlphas:1,
          lineAlpha:1,
          lineColor:"#fff",
          type:"column",
          valueField:"visits",
          columnWidth:.5
        }],
      chartCursor:{
        categoryBalloonEnabled:!1,
        cursorAlpha:0,
        zoomable:!1
      },
      categoryField:"type",
      categoryAxis:{
        gridPosition:"start",
        gridAlpha:0,
        axesAlpha:0,
        lineAlpha:0,
        fontSize:12,
        color:"#fff",
        tickLength:0
      },
      export:true
    });

    var chartDataFinance = <?php echo $chart_finance; ?>;

    // AmCharts.makeChart(
    // "proj-finance",
    // {
    //   type:"serial",
    //   hideCredits:!0,
    //   theme:"light",
    //   dataProvider: chartDataFinance,
    //   valueAxes:[
    //     {
    //       gridAlpha:.3,
    //       gridColor:"#fff",
    //       axisColor:"transparent",
    //       color:"#fff",dashLength:0
    //     }]
    //   ,gridAboveGraphs:!0,
    //   startDuration:1,
    //   graphs:[
    //     {
    //       balloonText:"Total Invoice: <b>[[value]]</b>",
    //       fillAlphas:1,
    //       lineAlpha:1,
    //       lineColor:"#fff",
    //       type:"column",
    //       valueField:"visits",
    //       columnWidth:.5
    //     }],
    //   chartCursor:{
    //     categoryBalloonEnabled:!1,
    //     cursorAlpha:0,
    //     zoomable:!1
    //   },
    //   categoryField:"type",
    //   categoryAxis:{
    //     gridPosition:"start",
    //     gridAlpha:0,
    //     axesAlpha:0,
    //     lineAlpha:0,
    //     fontSize:12,
    //     color:"#fff",
    //     tickLength:0
    //   },
    //   export:true
    // });
  });
  
  var app = new Vue({
      el: "#app",
      mounted: function () {
        this.loadHistory();
        
      },
      updated: function () {
        var that = this;
        // that.initialize();
      },
      data: {
        history: [],
        maps: [],
        overlay: false,
        status_update:'',
        id: '',
        last_status:''
      },
      methods: {
        loadHistory: function () {
            var that = this;

            jQuery.ajax({
              type: "GET",
              cache:false,
              url: '<?= base_url() ?>home/getMap',
              success: function(response) {          
                    that.history = response;
                    for (var i=0; i<response.length; i++){
                      if(response[i]['latitude'] != null){                        
                        that.maps.push({
                          lat: response[i]['latitude'],
                          lng: response[i]['longitude'],
                          status: response[i]['status'],
                          routing: response[i]['no_routing'],
                          updated: response[i]['created_date'],
                        });
                      }
                    }
                    // that.initialize();      
              },
            });
        },
        // initialize: function(){
        //   var that = this;
        //   var infoWindow = new google.maps.InfoWindow, marker,i;
        //   var bounds = new google.maps.LatLngBounds();
        //   var mapCanvas = document.getElementById('maps');
        //   var mapOptions = {
        //     mapTypeId: google.maps.MapTypeId.ROADMAP
        //   }     
        //   var map = new google.maps.Map(mapCanvas, {zoom: 6, center: new google.maps.LatLng(-6.228107, 106.80605039999999), gestureHandling: "greedy"});
         
          
        //   for(var i = 0; i < that.maps.length; i++)
        //   {
        //       var uluru = {
        //         lat: parseFloat(that.maps[i].lat), 
        //         lng: parseFloat(that.maps[i].lng)
        //       };
        //       pos = new google.maps.LatLng(that.maps[i].lat, that.maps[i].lng);
        //       bounds.extend(pos); // di dalam looping
        //       marker = new google.maps.Marker({
        //           position: pos,
        //           map: map,
        //           content: '<h2>' + that.maps[i].routing + '</h2><div id="bodyContent"><p style="    margin-bottom: 0;">'+ that.maps[i].status   + '</p><p>Waktu : ' + that.maps[i].updated +'</p></div>',
        //           // icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
        //           label: { color: '#00aaff', fontWeight: 'bold', fontSize: '14px', text: that.maps[i].routing }
        //       });

        //       google.maps.event.addListener(marker, 'click', (function(marker, i) {
        //           return function() {
        //               infoWindow.setContent(marker['content']);
        //               infoWindow.open(map, marker);
        //           }
        //       })(marker, i));

        //   }
        // },
        
      }
  })

  function initialize(){

  }
  
</script>

<!-- Chart code -->
<script>
    am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartdiv", am4charts.XYChart);

    // Add data
    chart.data = [ {
      "year": "2003",
      "europe": 2.5,
      "namerica": 2.5,
      "asia": 2.1,
      "lamerica": 1.2,
      "meast": 0.2,
      "africa": 0.1
    }, {
      "year": "2004",
      "europe": 2.6,
      "namerica": 2.7,
      "asia": 2.2,
      "lamerica": 1.3,
      "meast": 0.3,
      "africa": 0.1
    }, {
      "year": "2005",
      "europe": 2.8,
      "namerica": 2.9,
      "asia": 2.4,
      "lamerica": 1.4,
      "meast": 0.3,
      "africa": 0.1
    } ];

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "year";
    categoryAxis.title.text = "Local country offices";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 20;
    categoryAxis.renderer.cellStartLocation = 0.1;
    categoryAxis.renderer.cellEndLocation = 0.9;

    var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.min = 0;
    valueAxis.title.text = "Expenditure (M)";

    // Create series
    function createSeries(field, name, stacked) {
      var series = chart.series.push(new am4charts.ColumnSeries());
      series.dataFields.valueY = field;
      series.dataFields.categoryX = "year";
      series.name = name;
      series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
      series.stacked = stacked;
      series.columns.template.width = am4core.percent(95);
    }

    createSeries("europe", "Europe", false);
    createSeries("namerica", "North America", true);
    createSeries("asia", "Asia", false);
    createSeries("lamerica", "Latin America", true);
    createSeries("meast", "Middle East", true);
    createSeries("africa", "Africa", true);

    // Add legend
    chart.legend = new am4charts.Legend();

    }); // end am4core.ready()
</script>
