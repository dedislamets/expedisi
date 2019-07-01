
<script type="text/javascript">
	$('.number').priceFormat({
        prefix: '',
        centsSeparator: '',
        centsLimit: 0,
        thousandsSeparator: ''
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
		$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
			if(event_name != 'sidebar_collapsed') return;
			$('.chosen-select').each(function() {
				 var $this = $(this);
				 $this.next().css({'width': $this.parent().width()});
			})
		});
	}
	chosen();
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	});

    $('#in').timepicker({
        minuteStep: 1,
        showSeconds: true,
        showMeridian: false,
        disableFocus: true,
        icons: {
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down'
        }
    }).on('focus', function() {
        $('#in').timepicker('showWidget');
    }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    $('#out').timepicker({
        minuteStep: 1,
        showSeconds: true,
        showMeridian: false,
        disableFocus: true,
        icons: {
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down'
        }
    }).on('focus', function() {
        $('#out').timepicker('showWidget');
    }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

	
    // $(document).ready(function(){ 
    //     var d = new Date();

    //     $("#periode_start").datepicker("setDate", d);
    //     $("#periode_end").datepicker("setDate", d);

    //     showloader('body');
    //     myTable = $('#ViewTable').DataTable({
    //                 ajax: {                 
    //                     "url": "DailyAttendance/datatabel",
    //                     "type": "GET",
    //                 },          
    //                 "bPaginate": true,  
    //                 dataSrc: "original.data",
    //                 columnDefs:[
    //                         {
    //                             targets:3, render:function(data){
    //                                 return moment(data).format('DD MMM YYYY'); 
    //                             }
    //                         },
    //                         {
    //                             targets:[5,6,7,8,15,16,17,18], render:function(data){
    //                                 return moment(data).format('HH:mm'); 
    //                             }
    //                         },
    //                         { "width": "130px", "targets": [3] }
    //                 ],
    //                 "destroy": true,
    //                 "initComplete": function(settings, json) {
    //                     hideloader();
    //                 }   
    //             });

    //     $('#btnGo').on('click', function (event) {
    //         showloader('body');
    //         var start = $("#periode_start").val();
    //         var end = $("#periode_end").val();
    //         var ot = $("#overtime").prop('checked');
    //         var late = $("#late").prop('checked');
    //         var early = $("#early").prop('checked');
    //         var absen = $("#absen").prop('checked');
    //         var resign = $("#resign").prop('checked');

    //         myTable.ajax.url("DailyAttendance/datatabel?start=" + start + "&end=" + end + "&ot=" + ot+ "&late=" + late + "&early=" + early + "&absen=" + absen + "&resign=" + resign).load();
    //         hideloader();
    //     });
    // });

    function showattendance(val){
        $('#ModalAttendance').modal({backdrop: 'static', keyboard: false}) ;
    }
</script>