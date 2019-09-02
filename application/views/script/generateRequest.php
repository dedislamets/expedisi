<script type="text/javascript">

	$(document).ready(function(){ 
	    showloader('body');
	    myTable = $('#tabel-request').DataTable({    
	                "bPaginate": true,  
	                dataSrc: "original.data",
	                "destroy": true,                  
	                "initComplete": function(settings, json) {
	                    hideloader();
	                }   
	            });
    });

    $('#btnAdd').on('click', function () {
    	$(".modal-body").html('');
    	var f = $("#recnumForm").val();
    	$("#lbl-title").text('Add Form ' + $("#judul").text());
    	showloader('body');
    	$.get("<?php echo base_url(); ?>ListRequest/create",{f: f }, function(data){ 
    		$(data).appendTo(".modal-body");
    		$('.date-picker').datepicker({
				autoclose: true,
				todayHighlight: true
			});
			$('.waktu').timepicker({
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
    		hideloader();
    	});
	   	$('#ModalGenerate').modal({backdrop: 'static', keyboard: false});
	});
</script>