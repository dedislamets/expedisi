
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

    $('#from_permit').timepicker({
        minuteStep: 1,
        showSeconds: true,
        showMeridian: false,
        disableFocus: true,
        icons: {
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down'
        }
    }).on('focus', function() {
        $('#from_permit').timepicker('showWidget');
    }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    $('#to_permit').timepicker({
        minuteStep: 1,
        showSeconds: true,
        showMeridian: false,
        disableFocus: true,
        icons: {
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down'
        }
    }).on('focus', function() {
        $('#to_permit').timepicker('showWidget');
    }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    
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
        var start = $("#periode_start").val();
        var end = $("#periode_end").val();
        myTable = $('#ViewTable').DataTable({
                    ajax: {                 
                        "url": "DailyAttendance/datatabel",
                        "type": "GET",
                        "data" : {'start': start , 'end' : end }
                    },          
                    "bPaginate": true,  
                    dataSrc: "original.data",
                    columnDefs:[
                            {
                                targets:4, render:function(data){
                                    return moment(data).format('DD MMM YYYY'); 
                                }
                            },
                            {
                                targets:[6,7,8,9,16,17,18,19,20,21], render:function(data){
                                    return moment(data).format('HH:mm'); 
                                }
                            },
                            { "width": "300px", "targets": [1] },
                            { "width": "130px", "targets": [4] },
                        
                    ],
                    "destroy": true,
                    "initComplete": function(settings, json) {
                        hideloader();
                    },
                    error: function (xhr, status, errorThrown) {
                        hideloader();
                        alert(xhr.responseText);
                    }
                });

        $('#btnGo').on('click', function (event) {
            loadData();
        });

        $('#btnProcess').on('click', function (event) {
            showloader('body');
            $('#ModalProcess').modal({backdrop: 'static', keyboard: false}) ;
            hideloader();
        });

        $('#btnFind').on('click', function (event) {
            var checked_courses = $('#iframe').contents().find('input[name="selected_courses[]"]:checked').length;
            if (checked_courses != 0) {
                CheckedTrue();
            } else {
                alert("Silahkan pilih terlebih dahulu");
            }
        });

        $('#btnAdvance').on('click', function (event) {
            showloader('body');
            $("#iframe").attr('src','Iframe/dailyattendance');
            $("#iframe").attr('frameBorder','0');
            $("#iframe").attr('marginHeight','0px');
            $("#iframe").attr('marginWidth','0px');
            $("#iframe").attr('width','100%');
            $("#iframe").attr('style','width:100%; height: 400px; display:block !important');
            $('#ModalFind').modal({backdrop: 'static', keyboard: false}) ;
            hideloader();
        });
        $("#absen_type").change(function(e, params){
             loadData();
        });
        $("#shift_type").change(function(e, params){
             loadData();
        });
    });
    
    function loadData(){
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
    }

    function showattendance(val){
        var data = myTable.row($(val).closest('tr')).data();
        $("#date_attendance_1").val(moment(data[4]).format('DD MMM YYYY'));
        $("#date_attendance").val(data[4]);
        $("#in_s").val(moment(data[6]).format('HH:mm'));
        $("#out_s").val(moment(data[7]).format('HH:mm'));
        $("#in").val(moment(data[8]).format('HH:mm:ss'));
        $("#out").val(moment(data[9]).format('HH:mm:ss'));
        $('#ModalAttendance').modal({backdrop: 'static', keyboard: false}) ;
    }

    function CheckedTrue() {
        var b = $("#txtSelected");
        b.val('');
        var str = "";
        var oTable = document.getElementById("iframe").contentWindow.oTable;
        var rowcollection = oTable.$(':checkbox', { "page": "all" });
        rowcollection.each(function () {
            if (this.checked) {
                str += this.value + ";";
            }
        });
        b.val(str);                        
        $('#ModalFind').modal('hide') ;
        myTable.ajax.url("DailyAttendance/datatabel?advance=" + str).load();
    }
    
</script>