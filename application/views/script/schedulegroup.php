<script type="text/javascript">
	myTable = $('#tabel-schedule').DataTable({
				ajax: {		            
		            "url": "datatabel_schedule",
		            "type": "GET",
		            "data":{'eventid': 0},
		        },
		       	"order": [[ 1, "asc" ]],
				"bPaginate": true,
				
				"oLanguage": {
					"oPaginate": {
						"sFirst": "<<", 
						"sPrevious": "<",
						"sNext": ">",
						"sLast": ">>"
					}
				},
				"destroy": true,
				"initComplete": function(settings, json) {
					$("#tabel-schedule").css('width','100%');
				}
		    });

	$('.btn-shift').on('click', function (event) {
		myTable = $('#tabel-shift-name').DataTable({
				ajax: {		            
		            "url": "datatabel_shift",
		            "type": "GET",
		            "data":{'eventid': $(this).data("id")},
		        },
		        pageLength : 5,
    			lengthMenu: [[5, 10, 20], [5, 10, 20]],
				"bPaginate": true,
				"bLengthChange" : false,
				"searching": false,
				"oLanguage": {
					"oPaginate": {
						"sFirst": "<<", 
						"sPrevious": "<",
						"sNext": ">",
						"sLast": ">>"
					}
				},
				"destroy": true,
				"initComplete": function(settings, json) {
					$("#tabel-shift-name_wrapper").children().first().remove();
				}
		    });
		
	});

	function editmodal(val){
		showloader('body');
		$.get('ScheduleGroup/edit', { id: $(val).data('id') }, function(data){ 
         		$("#lbl-title-pattern").text('Edit');
           		$("#pattern_code").val(data[0]['Code']);
           		$("#pattern_name").val(data[0]['IsDesc']);
           		if(data[0]['StartDate'] != null){
	            	$("#start_date").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
	            }
	            if(data[0]['EndDate'] != null){
	            	$("#end_date").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
	            }
	            $("#pattern1").val(data[0]['RecnumShift1']).trigger('chosen:updated');
	            $("#pattern2").val(data[0]['RecnumShift2']).trigger('chosen:updated');
	            $("#pattern3").val(data[0]['RecnumShift3']).trigger('chosen:updated');
	            $("#pattern4").val(data[0]['RecnumShift4']).trigger('chosen:updated');
	            $("#pattern5").val(data[0]['RecnumShift5']).trigger('chosen:updated');
	            $("#pattern6").val(data[0]['RecnumShift6']).trigger('chosen:updated');
	            $("#pattern7").val(data[0]['RecnumShift7']).trigger('chosen:updated');
	            $("#pattern8").val(data[0]['RecnumShift8']).trigger('chosen:updated');
	            $("#total1").val(data[0]['Formation1']);
	            $("#total2").val(data[0]['Formation2']);
	            $("#total3").val(data[0]['Formation3']);
	            $("#total4").val(data[0]['Formation4']);
	            $("#total5").val(data[0]['Formation5']);
	            $("#total6").val(data[0]['Formation6']);
	            $("#total7").val(data[0]['Formation7']);
	            $("#total8").val(data[0]['Formation8']);
	            $("#id_schedule").val(data[0]['Recnum']);
           		$('#ModalSchedule').modal({backdrop: 'static', keyboard: false}) ;
           
        });
		
		hideloader();
	}
	$('#btnAddGroup').on('click', function (event) {
		$("#lbl-title-group").text('Add');
		$("#name").val('');
		$("#id_group").val('');
		$('#ModalGroupShift').modal({backdrop: 'static', keyboard: false}) ;
	});
	$('#btnDelete').on('click', function (event) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			$.get('ScheduleGroup/delete', { id: $("#id_schedule").val() }, function(data){ 
				if(!data.error){
					window.location.reload();
				}else{
					alert(data);
				}
			});
		}
	});
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	});

	$(document).ready(function(){ 
		var d = new Date();
       	var currMonth = d.getMonth();
       	var currYear = d.getFullYear();
       	var startDate = new Date(currYear, currMonth, 1);
       	var strtdate = new Date(startDate.getTime() - (startDate.getTimezoneOffset() * 60000 ))
                    .toISOString()
                    .split("T")[0];

       $("#periode_start").datepicker("setDate", startDate);

       	var date = new Date();
		var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
		var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

		var lastDayWithSlashes = (lastDay.getDate()) + '-' + (lastDay.getMonth() + 1) + '-' + lastDay.getFullYear();
		var enddate = lastDay.getFullYear() + '-' + (lastDay.getMonth() + 1) + '-' + (lastDay.getDate());
		$("#periode_end").datepicker("setDate", lastDayWithSlashes);

		$(this).find('iframe').attr('src','Iframe?group=0&start=' + strtdate + '&end=' + enddate );
		$(this).find('iframe').attr('frameBorder','0');
		$(this).find('iframe').attr('marginHeight','0px');
		$(this).find('iframe').attr('marginWidth','0px');
		$(this).find('iframe').attr('width','100%');
		$(this).find('iframe').attr('style','width:100%; height: 400px; display:block !important');
	});

	$('#btnGo').on('click', function (event) {
		showloader('#box-iframe');
		var start = $("#periode_start").val();
		var end = $("#periode_end").val();
		var action = $("#rAction input[type='radio']:checked").val();
		var replace = $("#replace").prop('checked');
		if(action==0)
			$("#iframe").attr('src','Iframe?start=' + start + '&end=' + end + '&group=' + $("#group").val() );
		else
			$("#iframe").attr('src','Iframe?start=' + start + '&end=' + end + '&group=' + $("#group").val() + '&replace=' + replace );

		hideloader();
	});

	

	$('#btnAdd').on('click', function (event) {
		$("#lbl-title-pattern").text('Add');
		$("#pattern_code").val('');
        $("#pattern_name").val('');
		$("#pattern1").val(0).trigger('chosen:updated');
        $("#pattern2").val(0).trigger('chosen:updated');
        $("#pattern3").val(0).trigger('chosen:updated');
        $("#pattern4").val(0).trigger('chosen:updated');
        $("#pattern5").val(0).trigger('chosen:updated');
        $("#pattern6").val(0).trigger('chosen:updated');
        $("#pattern7").val(0).trigger('chosen:updated');
        $("#pattern8").val(0).trigger('chosen:updated');
        $("#total1").val(0);
        $("#total2").val(0);
        $("#total3").val(0);
        $("#total4").val(0);
        $("#total5").val(0);
        $("#total6").val(0);
        $("#total7").val(0);
        $("#total8").val(0);
        $("#id_schedule").val('');
		$('#ModalSchedule').modal({backdrop: 'static', keyboard: false}) ;
	});
	$('.pattern-form').on('click', function (event) {
		alert('');
	});
</script>
