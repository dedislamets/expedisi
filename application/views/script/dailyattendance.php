
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

    
    
	
    $(document).ready(function(){ 

        var $progressbar = $("#progressbar");
        $progressbar.show();
        var updateProgressBar = function(evt) {

            if(evt.lengthComputable) {
                var percent = (evt.loaded*100)/evt.total;
                $(function(){
                    $progressbar.css('width', percent.toFixed(1) + '%');
                }); 
            }
        }

        $('#ProcessForm').on('submit', function(e){
            e.preventDefault();

            getProgress();
            console.log('startProgress');
            $.ajax({
                url: "DailyAttendance/process",
                type: "POST",
                data: new FormData(this),
                async: true, 
                contentType: false,
                processData: false,
                success: function(data){
                    if(data!==''){
                        alert(data);
                    }
                    return false;
                }
            });
            return false;
            // $.ajax({
            //     xhr: function() {
            //         var req = new XMLHttpRequest();
            //         req.upload.addEventListener("progress", updateProgressBar, false);
            //         req.addEventListener("progress", updateProgressBar, false);
            //         return req;
            //     },
            //     url: "DailyAttendance/process",
            //     type: "POST",
            //     data: new FormData(this),
            //     contentType: false,
            //     processData: false,
            //     success: function(data){
            //         console.log(data);
            //         if (data == 'T'){
            //             $('#txtname').val("");
            //             $('#txtsex').val("");
            //             $('#txtage').val("");
            //             $('#txterr').val('Record Inserted');
            //             $progressbar.css('width', '100%');
            //         }
            //     },
            //     error: function(data){
            //         alert("Something went wrong !");
            //     }
            // });
        });

        var d = new Date();

        $("#periode_start").datepicker("setDate", d);
        $("#periode_end").datepicker("setDate", d);

        showloader('body');
        myTable = $('#ViewTable').DataTable({
                    ajax: {                 
                        "url": "DailyAttendance/datatabel",
                        "type": "GET",
                        //"data" : {'start': strtdate , 'end' : enddate }
                    },          
                    "bPaginate": true,  
                    dataSrc: "original.data",
                    columnDefs:[
                            {
                                targets:3, render:function(data){
                                    return moment(data).format('DD MMM YYYY'); 
                                }
                            },
                            {
                                targets:[5,6,7,8,15,16,17,18,19,20], render:function(data){
                                    return moment(data).format('HH:mm'); 
                                }
                            },
                            { "width": "130px", "targets": [3] }
                    ],
                    "destroy": true,
                    "initComplete": function(settings, json) {
                        hideloader();
                    }   
                });

        $('#btnGo').on('click', function (event) {
            showloader('body');
            var start = $("#periode_start").val();
            var end = $("#periode_end").val();
            var ot = $("#overtime").prop('checked');
            var late = $("#late").prop('checked');
            var early = $("#early").prop('checked');
            var absen = $("#absen").prop('checked');
            var resign = $("#resign").prop('checked');

            myTable.ajax.url("DailyAttendance/datatabel?start=" + start + "&end=" + end + "&ot=" + ot+ "&late=" + late + "&early=" + early + "&absen=" + absen + "&resign=" + resign + "&absen_type=" + $("#absen_type").val() + "&shift_type=" + $("#shift_type").val()).load();
            hideloader();
        });

        $('#btnProcess').on('click', function (event) {
            showloader('body');
            $('#ModalProcess').modal({backdrop: 'static', keyboard: false}) ;
            hideloader();
        });
    });

    function showattendance(val){
        $('#ModalAttendance').modal({backdrop: 'static', keyboard: false}) ;
    }
    function getProgress() {
        console.log('getProgress');
        $.ajax({
            url: "DailyAttendance/progress",
            type: "GET",
            contentType: false,
            processData: false,
            async: false,
            success: function (data) {
                console.log(data);
                $('#progressbar').css('width', data+'%').children('.sr-only').html(data+"% Complete");
                if(data!=='100'){
                    setTimeout('getProgress()', 2000);
                }
            }
        });
    }
</script>