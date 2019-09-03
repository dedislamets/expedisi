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
    		$("#recnum_page").val(f);
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

	$('#form1').on('submit', function (event) {
		event.preventDefault();
		var form = $("#form1");
		var formData = new FormData($("#form1")[0]);
		if ($(form).valid()) {
	        $.ajax({
	            type: "POST",
	            url: $(form).prop("action"),
	            //dataType: 'json', //not sure but works for me without this
	            data: formData,
	            contentType: false, //this is requireded please see answers above
	            processData: false, //this is requireded please see answers above
	            //cache: false, //not sure but works for me without this
	            //error   : ErrorHandler,
			    success: function (data) {
		            alert(data)
		        },
	        });
	    }
		// $.post('ListRequest/save',formData, function(data){
  //               if(data.error==false){                                  
  //                   alert('Berhasil disimpan..');
  //                   //$("#ModalOvertime").modal('hide');
  //                   //showDialog();
  //               }else{  
  //                   $("#lblMessage").remove();
  //                   $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                    
  //               }
  //           },'json');
	});
</script>