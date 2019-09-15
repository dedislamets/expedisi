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

	$('#btnRefresh').on('click', function () {
		showloader('body');
		$.get("<?php echo base_url(); ?>ListRequest/refresh",{f: $("#recnumForm").val() }, function(data){ 

			$("#isi-tabel").html('');
			$("#isi-tabel").html(data);
			$('#tabel-request').DataTable({    
                "bPaginate": true,  
                dataSrc: "original.data",
                "destroy": true,                  
                "initComplete": function(settings, json) {
                    hideloader();
                }   
            });
		});
	  
	});
    $('#btnAdd').on('click', function () {
    	$(".modal-body").html('');
    	$("#submit_remove").before('<button type="submit" id="submit_button" class="btn btn-primary">Submit</button>');
    	$("#submit_remove").remove();
    	$("#warning-del").remove();
    	$("#Recnumid").val();
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

		    $('.number').priceFormat({
		        prefix: '',
		        centsSeparator: '.',
		        centsLimit: 2,
		        thousandsSeparator: ','
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
			    	if(data.length==0){
			    		alert('Sukses tersimpan..');
			    		window.location.reload();
			    	}else{
			    		alert(data);
			    	}
		            
		        },
	        });
	    }

	});

	function removeList(val){
		$(".modal-body").html('');
    	var f = $("#recnumForm").val();
    	$("#Recnumid").val(val);
    	$("#lbl-title").text('Remove Form ' + $("#judul").text());
    	showloader('body');
    	$.get("<?php echo base_url(); ?>ListRequest/edit",{f: f,Recnum: val }, function(data){ 
    		$("#recnum_page").val(f);
    		$(data).appendTo(".modal-body");
    		$.each($('#form1').serializeArray(), function(index, value){
			    $('[name="' + value.name + '"]').attr('disabled', 'disabled');
			});
			
			$("#submit_button").before('<input type="button" id="submit_remove" onclick="deleteData()" class="btn btn-danger">Remove</button>');
			$("#submit_button").remove();
			$(".modal-body").before('<h3 id="warning-del" style="text-align:center;color: red">Are you sure want to remove this?</h3>');
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
		
	}

	 function deleteData() {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			$("input, select, button, textarea").prop("disabled", false);
			var form = $("#form1");
			var formData = new FormData($("#form1")[0]);

			$.ajax({
	            type: "POST",
	            url: 'ListRequest/delete',
	            //dataType: 'json', //not sure but works for me without this
	            data: formData,
	            contentType: false,
	            processData: false, 
	           	beforeSend: function(){
					$("input, select, button, textarea").prop("disabled", true);
				},
				done: function(data){					
					
				},
			    success: function (data) {
			    	if(data.length==0){
			    		alert('Sukses terhapus..');
			    		window.location.reload();
			    	}else{
			    		alert(data);
			    	}
		            
		        },
	        });
		}
	}
	function editList(val){
		$(".modal-body").html('');
    	var f = $("#recnumForm").val();
    	$("#Recnumid").val(val);
    	$("#lbl-title").text('Edit Form ' + $("#judul").text());
    	$("#Recnumid").val(val);
    	showloader('body');
    	$.get("<?php echo base_url(); ?>ListRequest/edit",{f: f,Recnum: val }, function(data){ 
    		$("#recnum_page").val(f);
    		$(data).appendTo(".modal-body");
			$("#submit_remove").before('<button type="submit" id="submit_button" class="btn btn-primary">Submit</button>');
    		$("#submit_remove").remove();
    		$("#warning-del").remove();
		
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
		
	}
</script>