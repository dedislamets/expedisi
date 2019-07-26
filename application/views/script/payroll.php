
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

        $('#btnFind').on('click', function (event) {
            var checked_courses = $('#iframe').contents().find('input[name="selected_courses[]"]:checked').length;
            if (checked_courses != 0) {
                CheckedTrue();
            } else {
                alert("Silahkan pilih terlebih dahulu");
            }
        });
    });

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
        var action = $("#rAction input[type='radio']:checked").val();
        myTable.ajax.url("Payroll/datatabel?action=" + action + "&periode=" + $("#periode").val() + "&advance=" + str).load();  
    }

    function showattendance(val){
        $('#ModalAttendance').modal({backdrop: 'static', keyboard: false}) ;
    }
</script>