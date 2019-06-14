<script type="text/javascript">
	$("#panel-working").toggle();
	myTable = $('#tabel-shift-name').DataTable({
				ajax: {		            
		            "url": "datatabel_shift",
		            "type": "GET",
		            "data":{'eventid': 0},
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
	myTable2 = $('#tabel-standart-working').DataTable({
				ajax: {		            
		            "url": "datatabel_standard_working",
		            "type": "GET",
		            "data":{'shift': 0},
		        },
		        pageLength : 5,
    			lengthMenu: [[5, 10, 20], [5, 10, 20]],
				"bPaginate": true,
				"bLengthChange" : false,
				"searching": false,
				"destroy": true,
				"oLanguage": {
					"oPaginate": {
						"sFirst": "<<", 
						"sPrevious": "<",
						"sNext": ">",
						"sLast": ">>"
					}
				},
				"columnDefs": [
		            {
		                "targets": [ 8 ],
		                "visible": false
		            }
		        ],
				"initComplete": function(settings, json) {
					$("#tabel-standart-working_wrapper").children().first().remove();
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

	function working_sch(val){
		$("#panel-working").removeClass('hidden');
		$('html, body').animate({
						scrollTop: $("#panel-working").offset().top
				},1000);
		$('#tabel-standart-working').DataTable({
				ajax: {		            
		            "url": "datatabel_standard_working",
		            "type": "GET",
		            "data":{'shift': $(val).data("id")},
		        },
		        pageLength : 5,
    			lengthMenu: [[5, 10, 20], [5, 10, 20]],
				"bPaginate": true,
				"bLengthChange" : false,
				"order": [[ 8, "asc" ]],
				"searching": false,
				"destroy": true,
				"oLanguage": {
					"oPaginate": {
						"sFirst": "<<", 
						"sPrevious": "<",
						"sNext": ">",
						"sLast": ">>"
					}
				},
				"columnDefs": [
		            {
		                "targets": [ 8 ],
		                "visible": false
		            }
		        ],
				"initComplete": function(settings, json) {
					$("#tabel-standart-working_wrapper").children().first().remove();
				}
		    });
	}

	function showrest(val){
		$('#ViewTable').DataTable({
				ajax: {		            
		            "url": "datatabel_rest",
		            "type": "GET",
		            "data":{'time': $(val).data("id")},
		        },
		        pageLength : 5,
    			lengthMenu: [[5, 10, 20], [5, 10, 20]],
				"bPaginate": true,
				"bLengthChange" : false,
				"searching": false,
				"destroy": true,
				"oLanguage": {
					"oPaginate": {
						"sFirst": "<<", 
						"sPrevious": "<",
						"sNext": ">",
						"sLast": ">>"
					}
				},
				"initComplete": function(settings, json) {
					$("#ViewTable_wrapper").children().first().remove();
				}
		    });
		$('#addModal').modal({backdrop: 'static', keyboard: false}) ;
	}

	function showDialog(){
		$('#tabel-attendence-allowance').DataTable({
			ajax: {		            
	            "url": "MasterShiftTime/getdata_attendance_allowance",
	            "type": "GET",
	            "data":{'class': $("#class_allow").val()},
	        },
	        pageLength : 5,
			lengthMenu: [[5, 10, 20], [5, 10, 20]],
			"bPaginate": true,
			"bLengthChange" : false,
			"searching": false,
			"destroy": true,
			"oLanguage": {
				"oPaginate": {
					"sFirst": "<<", 
					"sPrevious": "<",
					"sNext": ">",
					"sLast": ">>"
				}
			},
			"initComplete": function(settings, json) {
				$("#tabel-attendence-allowance").css('width','100%');
				$("#tabel-attendence-allowance_wrapper").children().first().remove();
			}
	    });

	    $('#tabel-class-allowance').DataTable({
			ajax: {		            
	            "url": "MasterShiftTime/getdata_class_allowance",
	            "type": "GET",
	            "data":{'class': $("#class_allow_2").val()},
	        },
	        pageLength : 5,
			lengthMenu: [[5, 10, 20], [5, 10, 20]],
			"bPaginate": true,
			"bLengthChange" : false,
			"searching": false,
			"destroy": true,
			"oLanguage": {
				"oPaginate": {
					"sFirst": "<<", 
					"sPrevious": "<",
					"sNext": ">",
					"sLast": ">>"
				}
			},
			"initComplete": function(settings, json) {
				$("#tabel-class-allowance").css('width','100%');
				$("#tabel-class-allowance_wrapper").children().first().remove();
			}
	    });

	    $('#tbl-working_status').DataTable({
			ajax: {		            
	            "url": "MasterShiftTime/getdata_working_status",
	            "type": "GET",
	            "data":{'class': $("#class_allow_2").val()},
	        },
	        pageLength : 5,
			lengthMenu: [[5, 10, 20], [5, 10, 20]],
			"bPaginate": true,
			"bLengthChange" : false,
			"searching": false,
			"destroy": true,
			"oLanguage": {
				"oPaginate": {
					"sFirst": "<<", 
					"sPrevious": "<",
					"sNext": ">",
					"sLast": ">>"
				}
			},
			"initComplete": function(settings, json) {
				$("#tbl-working_status").css('width','100%');
				$("#tbl-working_status_wrapper").children().first().remove();
			}
	    });
	}
	
	$('#btnAddGroup').on('click', function (event) {
		$("#lbl-title-group").text('Add');
		$("#name").val('');
		$("#id_group").val('');
		$('#ModalGroupShift').modal({backdrop: 'static', keyboard: false}) ;
	});
	$('#btnAddShift').on('click', function (event) {
		$("#lbl-title-shift").text('Add');
		$("#id_shift").val('');
		$('#ModalShift').modal({backdrop: 'static', keyboard: false}) ;
	});
	$('#btnAllowance').on('click', function (event) {
		$("#lbl-title-working").text('Add');
		
		$("#id_working").val('');

		showDialog();
		$('#ModalWorkingHour').modal({backdrop: 'static', keyboard: false}) ;
	});

	

	$('.btn-shift-edit').on('click', function (event) {
		$("#lbl-title-group").text('Edit');
		$("#name").val($(this).prev().text());
		$("#id_group").val($(this).prev().data('id'));
		$('#ModalGroupShift').modal({backdrop: 'static', keyboard: false}) ;
	});

	$('.btn-shift-delete').on('click', function (event) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			var id= $(this).prev().prev().data('id'); 
		    $.get('MasterShiftTime/del_group_shift', { id:id }, function(data){  			 				
 				window.location.reload();
            });
		} 
	});
	$('#class_allow').on('change', function() {
		showDialog();
	});
	$('#class_allow_2').on('change', function() {
		showDialog();
	});
	$('#working_status').on('change', function() {
		showDialog();
	});

	function modalshift(val){
		showloader('body');
		$("#lbl-title-shift").text('Edit');
		$.get('MasterShiftTime/editshift', { id: $(val).data('id') }, function(data){ 
         		$("#lbl-title-pattern").text('Edit');
           		$("#shift_code").val(data[0]['Code']);
           		$("#shift_name").val(data[0]['IsDesc']);
           		$("#OTAuto").val(data[0]['OTAuto']);
	            $("#shift").val(data[0]['RecnumGroupShift']).trigger('chosen:updated');
	            $("#shift_type").val(data[0]['RecnumShiftType']).trigger('chosen:updated');
	            $("#day_type").val(data[0]['RecnumDayType']).trigger('chosen:updated');
	            $("#otVal").val(data[0]['RecnumOTValidation']).trigger('chosen:updated');
	            var checked = data[0]["StatusHoliday"] == 1 ? true: false;
            	if(checked){ $("#isHoliday").attr('checked','checked')}else{ $("#isHoliday").removeAttr('checked')}

            	var checked_late = data[0]["LateMinusOT"] == 1 ? true: false;
            	if(checked_late){ $("#LMO").attr('checked','checked')}else{ $("#LMO").removeAttr('checked')}

            	var checked_early = data[0]["EarlyOutMinusOT"] == 1 ? true: false;
            	if(checked_early){ $("#EOMO").attr('checked','checked')}else{ $("#EOMO").removeAttr('checked')}

	            $("#id_shift").val(data[0]['Recnum']);
           		$('#ModalShift').modal({backdrop: 'static', keyboard: false}) ;
           		hideloader();
        });
	$('#btnDelete').on('click', function (event) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			$.get('MasterShiftTime/deleteshift', { id: $("#id_shift").val() }, function(data){ 
				if(!data.error){
					window.location.reload();
				}else{
					alert(data);
				}
			});
		}
	});
	}
</script>
