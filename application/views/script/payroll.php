
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

        showloader('body');
        var action = $("#rAction input[type='radio']:checked").val();
        myTable = $('#ViewTable').DataTable({
                    ajax: {                 
                        "url": "Payroll/datatabel",
                        "type": "GET",
                        //"data":{'action': action,'periode': $("#periode").val()},
                    },          
                    "bPaginate": true,  
                    dataSrc: "original.data",
                    "destroy": true,
                    columnDefs: [
                        { targets: [3, 4], className: "rata-kanan" },
                    ],                   
                    "initComplete": function(settings, json) {
                        hideloader();
                    }   
                });

        $('#btnGo').on('click', function (event) {
            showloader('body');
            var action = $("#rAction input[type='radio']:checked").val();
            if(action==1){
                myTable.ajax.url("Payroll/datatabel?action=" + action + "&periode=" + $("#periode").val()).load();    
            }else{
                alert('Sedang dalam pengembangan.');
            }
            
            hideloader();
        });
    });

    function showattendance(val){
        $('#ModalAttendance').modal({backdrop: 'static', keyboard: false}) ;
    }
</script>